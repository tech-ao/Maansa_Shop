<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Order,
    Models\PromoCode,
    Models\TrackOrder,
    Http\Controllers\Controller
};
use App\Helpers\EmailHelper;
use App\Helpers\SmsHelper;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Order::latest('id');

        if ($request->type) {
            if (in_array($request->type, ['Pending', 'In Progress', 'Shipped', 'Delivered', 'Canceled'])) {
                $query->whereOrderStatus($request->type);
            }
        }

        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }

        $datas = $query->get();
        return view('back.order.index', compact('datas'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = Order::findOrfail($id);
        return view('back.order.edit', compact('data'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        if($request->transaction_number){
            if (Order::where('transaction_number', $request->transaction_number)->where('id', '!=', $id)->exists()) {
                return redirect()->back()->withErrors(__('Order Transaction number already exists.'));
            }
        }

        $order->update($request->all());
        return redirect()->route('back.order.index')->withSuccess(__('Order Updated Successfully.'));
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('back.order.invoice',compact('order','cart'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printOrder($id)
    {
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('back.order.print',compact('order','cart'));
    }


    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  string  $field
     * @param  string  $value
     * @return \Illuminate\Http\Response
     */
    public function status($id,$field,$value)
    {

        $order = Order::find($id);
        if($field == 'payment_status'){
            if($order['payment_status'] == 'Paid'){
                return redirect()->route('back.order.index')->withErrors(__('Order is already paid.'));
            }
        }
        if($field == 'order_status'){
            if($order['order_status'] == 'Delivered'){
                return redirect()->route('back.order.index')->withErrors(__('Order is already Delivered.'));
            }
        }
        $order->update([$field => $value]);
        if($order->payment_status == 'Paid'){
            $this->setPromoCode($order);
        }
        $this->setTrackOrder($order);
        
        if ($field == 'order_status' && $value == 'Shipped') {
            $email = new EmailHelper();
            $email->sendOrderShippedMail($order);
        }

        $sms = new SmsHelper();
        $user_number = $order->user ? $order->user->phone : null;
        if($user_number){
            $sms->SendSms($user_number,"'order_status'",$order->transaction_number);
        }
       
        return redirect()->route('back.order.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Update order to Shipped with courier details & dispatch notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shippingStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'courier_name'    => 'nullable|string|max:191',
            'tracking_number' => 'nullable|string|max:191',
            'tracking_link'   => 'nullable|string',
        ]);

        $order->update([
            'order_status'    => 'Shipped',
            'courier_name'    => $request->courier_name,
            'tracking_number' => $request->tracking_number,
            'tracking_link'   => $request->tracking_link,
        ]);

        $this->setTrackOrder($order);

        // Send shipping notification email to customer
        if ($request->has('send_email') && $request->send_email == '1') {
            $email = new EmailHelper();
            $email->sendOrderShippedMail($order);
        }

        // Send SMS if enabled
        if ($order->user && $order->user->phone) {
            $sms = new SmsHelper();
            $sms->SendSms($order->user->phone, "'order_status'", $order->transaction_number);
        }

        return redirect()->back()->withSuccess(__('Order status updated to Shipped and tracking details saved successfully.'));
    }

    /**
     * Custom Function
     */
    public function setTrackOrder($order)
    {

        if($order->order_status == 'In Progress'){
            if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                TrackOrder::create([
                    'title' => 'In Progress',
                    'order_id' => $order->id
                ]);
            }
        }

        if($order->order_status == 'Shipped'){
            if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                TrackOrder::create([
                    'title' => 'In Progress',
                    'order_id' => $order->id
                ]);
            }
            if(!TrackOrder::whereOrderId($order->id)->whereTitle('Shipped')->exists()){
                TrackOrder::create([
                    'title' => 'Shipped',
                    'order_id' => $order->id
                ]);
            }
        }

        if($order->order_status == 'Canceled'){
            if(!TrackOrder::whereOrderId($order->id)->whereTitle('Canceled')->exists()){

                if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                    TrackOrder::create([
                        'title' => 'In Progress',
                        'order_id' => $order->id
                    ]);
                }
                if(!TrackOrder::whereOrderId($order->id)->whereTitle('Shipped')->exists()){
                    TrackOrder::create([
                        'title' => 'Shipped',
                        'order_id' => $order->id
                    ]);
                }
                if(!TrackOrder::whereOrderId($order->id)->whereTitle('Delivered')->exists()){
                    TrackOrder::create([
                        'title' => 'Delivered',
                        'order_id' => $order->id
                    ]);
                }

                if(!TrackOrder::whereOrderId($order->id)->whereTitle('Canceled')->exists()){
                    TrackOrder::create([
                        'title' => 'Canceled',
                        'order_id' => $order->id
                    ]);
                }


            }
        }

        if($order->order_status == 'Delivered'){

            if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                TrackOrder::create([
                    'title' => 'In Progress',
                    'order_id' => $order->id
                ]);
            }

            if(!TrackOrder::whereOrderId($order->id)->whereTitle('Shipped')->exists()){
                TrackOrder::create([
                    'title' => 'Shipped',
                    'order_id' => $order->id
                ]);
            }

            if(!TrackOrder::whereOrderId($order->id)->whereTitle('Delivered')->exists()){
                TrackOrder::create([
                    'title' => 'Delivered',
                    'order_id' => $order->id
                ]);
            }
        }
    }


    public function setPromoCode($order)
    {

        $discount = json_decode($order->discount, true);
        if($discount != null){
            $code = PromoCode::find($discount['code']['id']);
            $code->no_of_times--;
            $code->update();
        }
    }


    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->tranaction->delete();
        if(Notification::where('order_id',$id)->exists()){
            Notification::where('order_id',$id)->delete();
        }
        if(count($order->tracks_data)>0){
            foreach($order->tracks_data as $track){
                $track->delete();
            }
        }
        $order->delete();
        return redirect()->back()->withSuccess(__('Order Deleted Successfully.'));
    }

}

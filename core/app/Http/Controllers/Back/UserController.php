<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\User,
    Models\GuestUser,
    Http\Controllers\Controller
};
use App\Helpers\ImageHelper;
use App\Http\Requests\UserRequest;
use App\Models\Subscriber;
use App\Repositories\Front\UserRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{

       /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\UserRepository $repository
     *
     */
    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('back.user.index',[
            'datas' => User::latest()->get()
        ]);
    }

    /**
     * Display a listing of guest customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function guest()
    {
        GuestUser::ensureTableExists();

        $totalGuestCount = GuestUser::count();
        $totalGuestOrders = \App\Models\Order::where(function($q) {
            $q->where('user_id', 0)->orWhereNull('user_id');
        })->count();

        return view('back.user.guest', [
            'datas' => GuestUser::latest()->get(),
            'totalGuestCount' => $totalGuestCount,
            'totalGuestOrders' => $totalGuestOrders
        ]);
    }

    /**
     * Display the specified guest customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guestShow($id)
    {
        GuestUser::ensureTableExists();
        $guest = GuestUser::findOrFail($id);
        $orders = $guest->getOrders();

        return view('back.user.guest_show', compact('guest', 'orders'));
    }

    /**
     * Remove the specified guest customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guestDestroy($id)
    {
        GuestUser::ensureTableExists();
        $guest = GuestUser::findOrFail($id);

        // Delete associated guest orders to prevent orphan records
        $orders = $guest->getOrders();
        foreach ($orders as $order) {
            $order->tracks()->delete();
            $order->notifications()->delete();
            $order->delete();
        }

        $guest->delete();
        return redirect()->route('back.user.guest')->withSuccess(__('Guest Customer Deleted Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('back.user.show',compact('user'));
    }


    public function update(UserRequest $request)
    {
        $request->validate([
            'password' => 'min:6|max:16|nullable'
        ]);
        $this->repository->profileUpdate($request);
        return redirect()->back()->withSuccess(__('Profile Updated Successfully.'));
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        ImageHelper::handleDeletedImage($user, 'photo', 'images');

        // Delete user's notifications, tickets, reviews, and orders
        $user->notifications()->delete();
        \App\Models\Ticket::where('user_id', $user->id)->delete();
        \App\Models\Review::where('user_id', $user->id)->delete();
        foreach ($user->orders as $order) {
            $order->tracks()->delete();
            $order->notifications()->delete();
            $order->delete();
        }

        $user->delete();
        return redirect()->route('back.user.index')->withSuccess(__('Customer Deleted Successfully.'));
    }
}

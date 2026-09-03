<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;

class TranactionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }

    // ------- Index -------//
    public function index(Request $request)
    {
        $type = strtolower($request->input('type', 'payment'));
        if ($type === 'failed') {
            return $this->failed();
        }
        return $this->payment();
    }

    // ------- Payment Transactions (Successful) -------//
    public function payment()
    {
        $datas = Transaction::with(['order', 'user'])
            ->where(function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->where('payment_status', 'Paid');
                })->orWhereDoesntHave('order');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('back.transactions.index', [
            'datas' => $datas,
            'title' => __('Payment Transactions'),
            'subtitle' => __('Monitor customer gateway payments, transaction identifiers, invoice billing, and settlement logs.'),
            'activeType' => 'payment'
        ]);
    }

    // ------- Failed Transactions -------//
    public function failed()
    {
        $datas = Transaction::with(['order', 'user'])
            ->whereHas('order', function ($q) {
                $q->where('payment_status', '!=', 'Paid');
            })
            ->orderBy('id', 'desc')
            ->get();

        $existingOrderIds = Transaction::pluck('order_id')->filter()->toArray();
        $failedOrders = Order::with('user')
            ->where('payment_status', '!=', 'Paid')
            ->whereNotIn('id', $existingOrderIds)
            ->orderBy('id', 'desc')
            ->get();

        return view('back.transactions.index', [
            'datas' => $datas,
            'failedOrders' => $failedOrders,
            'title' => __('Failed Transactions'),
            'subtitle' => __('Review rejected, cancelled, unpaid, or unsuccessful payment attempts and gateway failures.'),
            'activeType' => 'failed'
        ]);
    }

    // ------- Delete -------//
    public function Delete($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->back()->withSuccess(__('Transaction Deleted Successfully.'));
    }
}


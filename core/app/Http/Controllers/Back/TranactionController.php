<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\FailedTransaction;

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

    // ------- Payment Transactions (All Placed Orders & Gateways) -------//
    public function payment()
    {
        $datas = Transaction::with(['order', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        return view('back.transactions.index', [
            'datas' => $datas,
            'title' => __('Payment Transactions'),
            'subtitle' => __('Monitor customer gateway payments, transaction identifiers, Cash on Delivery bookings, and settlement logs.'),
            'activeType' => 'payment'
        ]);
    }

    // ------- Failed Transactions (Gateway Errors & Failed Attempts) -------//
    public function failed()
    {
        $datas = FailedTransaction::with('user')
            ->orderBy('attempts', 'desc')
            ->orderBy('last_attempt_at', 'desc')
            ->get();

        return view('back.transactions.index', [
            'datas' => $datas,
            'title' => __('Failed Transactions'),
            'subtitle' => __('Review rejected, cancelled, or unsuccessful payment gateway attempts, error messages, and customer frequency.'),
            'activeType' => 'failed'
        ]);
    }

    // ------- Delete Payment Transaction -------//
    public function delete($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->back()->withSuccess(__('Transaction Deleted Successfully.'));
    }

    // ------- Delete Failed Transaction -------//
    public function deleteFailed($id)
    {
        FailedTransaction::findOrFail($id)->delete();
        return redirect()->back()->withSuccess(__('Failed Transaction Record Deleted Successfully.'));
    }
}


<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Notification,
    Http\Controllers\Controller
};
use DB;

class NotificationController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
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
    public function notifications(){
        return view('back.notification.index');
    }


    public function view_notification()
    {
        Notification::where('is_read', 0)->update(['is_read' => 1]);
        return view('back.notification.notification',[
            'data'=>Notification::orderby('id','desc')->get()
        ]);
    }

    public function mark_as_read()
    {
        Notification::where('is_read', 0)->update(['is_read' => 1]);
        if (request()->ajax()) {
            return response()->json(['status' => 'success']);
        }
        return back()->withSuccess(__('All notifications marked as read.'));
    }

    public function delete($id)
    {
        Notification::findOrFail($id)->delete();
        return back()->withSuccess(__('Notification Delete Successfully.'));
    }


    /**
     * Clear a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear_notf(){
        try {
            Notification::truncate();
        } catch (\Throwable $e) {
            Notification::query()->delete();
        }
        if (request()->ajax()) {
            return response()->json(['status' => 'success']);
        }
        return back()->withSuccess(__('All notifications cleared successfully.'));
    }
}

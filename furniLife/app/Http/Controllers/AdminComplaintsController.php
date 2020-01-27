<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminComplaintsController extends Controller
{
    public function all_complaints(){
        $all_complaints = DB::select('SELECT * FROM users INNER JOIN complaints on users.id = complaints.user_id');
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $total_undeliver = DB::select('SELECT * FROM requests where status = :status', ['status' => 'requested']);
        $undelivered_orders = DB::select('SELECT * FROM requests INNER JOIN products on products.id = requests.product_id where status = :status limit 4', ['status'=>'requested'] );
        $total_users = User::all();
        $data = array(
            'user' => Auth::user(),
            'active' => 'complaints_box',
            'all_complaints' => $all_complaints,
            'unread_complaints' => $unread_complaints,
            'total_users' => $total_users,
            'undelivered' => $undelivered_orders,
            'total_undelivered' => $total_undeliver,
        );
        return view('admin.complaints_box')->with($data);
    }

    public function complaint_read($id){
        $complaint = Complaint::find($id);
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $complaint->status = 'seen';
        $complaint->save();
        $data = array(
            'flash_info' => 'Complaint Have Been Seen',
            'unread_complaints' => $unread_complaints,
        );
        return redirect(route('complaints_box'))->with($data);
    }

    public function complaint_destroy($id){
        $complaint = Complaint::find($id);
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $complaint->delete();
        $data = array(
            'flash_danger' => 'Complaint Have Been Deleted',
            'unread_complaints' => $unread_complaints,
        );
        return redirect(route('complaints_box'))->with($data);

    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminManageOrdersController extends Controller
{

    public function orders(){
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $all_orders = DB::select('SELECT * FROM requests  INNER JOIN products on requests.product_id = products.id JOIN users on users.id = requests.user_id ORDER BY requests.id DESC');
        $total_undeliver = DB::select('SELECT * FROM requests where status = :status', ['status' => 'requested']);
        $undelivered_orders = DB::select('SELECT * FROM requests INNER JOIN products on products.id = requests.product_id where status = :status limit 4', ['status'=>'requested'] );
        $total_users = User::all();
        $data = array(
            'active' => 'manage_orders',
            'user' => Auth::user(),
            'all_orders' => $all_orders,
            'unread_complaints' => $unread_complaints,
            'total_users' => $total_users,
            'undelivered' => $undelivered_orders,
            'total_undelivered' => $total_undeliver,
        );
        return view('admin.orders')->with($data);
    }

    public function product_delivered($order_id){
        $get_order = [];
        $orders = DB::select('select * from requests where order_id = :order_id', ['order_id' => $order_id]);
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        foreach ($orders as $order){
            $get_order = $order;
            break;
        }

        $update_order = \App\Request::find($get_order->id);
        $update_order->status = 'delivered';
        $update_order->save();

        $data = array(
            'flash_info' => 'Order Status Updated',
            'unread_complaints' => $unread_complaints,
        );
        return redirect(route('manage_orders'))->with($data);
    }
}

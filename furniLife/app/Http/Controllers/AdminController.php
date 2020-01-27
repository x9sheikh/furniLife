<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $user = Auth::user();
        $total_users = User::all();
        $total_complaints = count(Complaint::all());
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $all_products = count(Product::all());
        $total_undeliver = DB::select('SELECT * FROM requests where status = :status', ['status' => 'requested']);
        $undelivered_orders = DB::select('SELECT * FROM requests INNER JOIN products on products.id = requests.product_id where status = :status limit 4', ['status'=>'requested'] );
        $total_earning = 0;
        $total_earning_arrays = DB::select('SELECT * FROM products INNER JOIN requests on requests.product_id = products.id');
        foreach ($total_earning_arrays as $total_earning_array){
            $total_earning = $total_earning + ($total_earning_array->price*$total_earning_array->quantity);
        }

        $data = array(
            'user' => $user,
            'total_users' => $total_users,
            'active' => 'default',
            'all_products' => $all_products,
            'total_earning' => $total_earning,
            'total_complaints' => $total_complaints,
            'unread_complaints' =>$unread_complaints,
            'undelivered' => $undelivered_orders,
            'total_undelivered' => $total_undeliver,
        );
        return view('admin.index')->with($data);
    }

}

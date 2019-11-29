<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Http\Requests\AccountsChangingRequest;
use App\Http\Requests\ComplaintBoxSubmitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $user = Auth::user();
        $total_price = 0;
        if (Auth::user()){
            $auth_user_id = Auth::user()->id;
            $mycart_products = DB::select('SELECT  products.id, products.title, products.price, products.description, products.profile, carts.quantity, carts.updated_at, carts.status FROM products  LEFT JOIN carts  ON carts.product_id = products.id where carts.user_id = :user_id', ['user_id' => $auth_user_id]);
            // Here, we calculate the total price
            foreach ($mycart_products as $mycart_product){
                $total_price = $total_price + ($mycart_product->quantity * $mycart_product->price);
            }
        }
        else{
            $mycart_products = [];
        }
        $data = array(
            'user' => $user,
            'mycart_products' => $mycart_products,
            'total_price' => $total_price,
            'quick_view' => false,
        );


        return view('dashboard.index')->with($data);
    }

    public function accounts_changing(AccountsChangingRequest $request){
        $name = $request->input('name');
        $phoneNo = $request->input('phoneNo');
        $zip_code = $request->input('zip_code');
        $password = $request->input('password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');
        $user = Auth::user();
        if (!password_verify($password, $user->password)){
            $data = array(
              'flash_danger' => 'Password is Incorrect'
            );
            return redirect('/dashboard/show')->with($data);
        }
        elseif ($new_password != $confirm_password){
            $data = array(
                'flash_danger' => "NewPassword Don't Match with ConfirmPassword",
            );
            return redirect('/dashboard/show')->with($data);
        }
        else{
            $user->name = $name;
            $user->phoneNo = $phoneNo;
            $user->zip_code = $zip_code;
            $user->password = Hash::make($new_password);
            $user->save();
            $data = array(
                'flash_success' => 'Accounts Detail Changing Successfully!'
            );
            return redirect('/dashboard/show')->with($data);
        }

    }

    public function complaint_submit(ComplaintBoxSubmitRequest $request){
        $title = $request->input('title');
        $complaint = $request->input('complaint');

        $complaint_object = new Complaint();
        $complaint_object->user_id = Auth::user()->id;
        $complaint_object->title = $title;
        $complaint_object->complaint = $complaint;
        $complaint_object->save();

        $data = array(
            'flash_success' => 'Your Complaint Submit Successfully!'
        );
        return redirect('/dashboard/show')->with($data);

    }
}

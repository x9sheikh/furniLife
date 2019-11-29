<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormValidation;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $total_price = 0;
        if (Auth::user()){
            $auth_user_id = Auth::user()->id;
            $mycart_products = DB::select('SELECT  products.id, products.title, products.price, products.description, products.profile, carts.quantity  FROM products  LEFT JOIN carts  ON carts.product_id = products.id where carts.user_id = :user_id', ['user_id' => $auth_user_id]);
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

        return view('checkout.index')->with($data);
    }

    public function continue(ProfileFormValidation $request){
        $user = Auth::user();
        $user->phoneNo = $request->input('phoneNo');
        $user->address_1 = $request->input('address_1');
        $user->address_2 = $request->input('address_2');
        $user->city = $request->input('city');
        $user->zip_code = $request->input('zip_code');
        $user->save();

        return $user;

    }
}

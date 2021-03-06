<?php

namespace App\Http\Controllers;

use App\Cart;
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

        if ($request->has('cash_on_delivery'))
        {

            $user = Auth::user();
            $user_id = $user->id;
            $cart_products = DB::select('select * from carts where user_id = :user_id', ['user_id' => $user_id]);

            foreach ($cart_products as $cart_product){
                $product_id = $cart_product->product_id;
                $quantity = $cart_product->quantity;

                $req = new \App\Request();
                $req->user_id = $user_id;
                $req->product_id = $product_id;
                $req->quantity = $quantity;
                $req->order_id = crc32(uniqid());
                $req->status = 'requested';
                $req->save();
            }

            foreach ($cart_products as $cart_product){
                $remove_cart_product = Cart::find($cart_product->id);
                $remove_cart_product->delete();
            }
            $data = array(
                'cash_on_delivery' => 'Thankx! for Shopping',
            );
            return redirect('/')->with($data);
        }
        else if ($request->has('credit_debit'))
        {
            //return "llll";
            //$data = array();
            //return view('payments.card');
            return redirect('/payment/method/card');
        }


    }
}

<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentMethodTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        //return view('payments.card');
        $user = Auth::user();
        $totalprice = 0;
        $cart_products = DB::select('select * from carts where user_id = :user_id', ['user_id' => $user->id]);
        foreach ($cart_products as $cart_product){
            $product_quantity = $cart_product->quantity;
            $product_price = Product::find($cart_product->product_id)->price;
            $totalprice = $totalprice + ($product_quantity*$product_price);
        }
        $data = array(
          'totalprice' => $totalprice,
        );
        return view('payments.card')->with($data);
    }

    public function deduction(Request $request){
        \Stripe\Stripe::setApiKey("sk_test_P7NfsLwNVSQGM1Rla8TTXsnE00PrGeyro9");

        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $request->total_price*100,
            'currency' => 'pkr',
            'description' => 'FurniLife',
            'source' => $token,
        ]);

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
            $req->order_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 11);;
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
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use PhpOption\None;

class IndexController extends Controller
{
    public function index(Request $request){

        $best = DB::select('select * from products where is_best = :is_best', ['is_best' => 1]);
        $categories = Category::all();
        $products = Product::all();
        $reviews = Review::all();
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
            'reviews' => $reviews,
            'bests' => $best,
            'categories' => $categories,
            'products' => $products,
            'mycart_products' => $mycart_products,
            'total_price' => $total_price,
        );
        return view('index')->with($data);

    }
}

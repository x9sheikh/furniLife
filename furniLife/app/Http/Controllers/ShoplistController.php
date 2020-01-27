<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoplistController extends Controller
{
    public function show($category_id){
        $product = Product::find($category_id);
        $product_category = $product->category_id;
        $related_products = DB::select('select * from products where category_id = :category_id', ['category_id' => $product_category]);
        $categories = Category::all();
        $category_products = DB::select('select * from products where category_id = :category_id', ['category_id' => $category_id]);
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
            'categories' => $categories,
            'category_products' => $category_products,
            'mycart_products' => $mycart_products,
            'total_price' => $total_price,
            'quick_view' => true,
            'related_products' => $related_products,
        );

        return view('shop_list.index')->with($data);
    }
}

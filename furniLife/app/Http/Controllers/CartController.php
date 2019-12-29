<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|between: 1,9'
        ]);
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart = new Cart();
        $cart->product_id = $product_id ;
        $cart->user_id = Auth::user()->id;
        $cart->quantity = $quantity;
        $cart->save();
        $data = array(
            'flash_success' => 'Product added Successfully!'
        );
        return redirect("/{$product_id}")->with($data);
    }

    public function store_home(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|between: 1,9'
        ]);
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart = new Cart();
        $cart->product_id = $product_id ;
        $cart->user_id = Auth::user()->id;
        $cart->quantity = $quantity;
        $cart->save();
        $data = array(
            'flash_success_home' => 'Product added Successfully!'
        );
        return redirect("/")->with($data);
    }

    public function store_quickly(Request $request, $product_id)
    {
        $quantity = 1;
        $cart = new Cart();
        $cart->product_id = $product_id ;
        $cart->user_id = Auth::user()->id;
        $cart->quantity = $quantity;
        $cart->save();
        $data = array(
            'flash_success_home' => 'Product added Successfully!'
        );
        return back()->with($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function remove_quickly($product_id){

        $carts = DB::select('select * from carts where product_id = :product_id', ['product_id' => $product_id]);
        $cart_id = json_encode($carts[0]->id);

        Cart::destroy($cart_id);

        $data = array(
            'remove_product' => 'Product Deleted Successfully!'
        );
        return back()->with($data);

    }

    public function my_cart(){
        //$category_products = DB::select('select * from products where category_id = :category_id', ['category_id' => $category_id]);
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
            'mycart_products' => $mycart_products,
            'total_price' => $total_price,
            'quick_view' => false,
        );

        return view("cart.index")->with($data);
    }

    public function cart_show_edit($id, Request $request){

        $this->validate($request, [
           'quantity' => 'required|integer|between: 1,9'
        ]);

        $cart_id = 0;
        $cart_id_finder = DB::select('SELECT id FROM carts WHERE product_id=:product_id', ['product_id' => $id]);
        foreach ($cart_id_finder[0] as $cart_id_finder)
            $cart_id = $cart_id_finder;

        $cart_edit = Cart::find($cart_id);
        $new_quantity = $request->input('quantity');
        $cart_edit->quantity = $new_quantity;
        $cart_edit->save();

        $data = array(
            'flash_message' => 'Product Quantity edited Successfully!'
        );
        return redirect('/my_cart/show')->with($data);
    }

    public function cart_show_delete($id){
        $cart_id = 0;
        $cart_id_finder = DB::select('SELECT id FROM carts WHERE product_id=:product_id', ['product_id' => $id]);
        foreach ($cart_id_finder[0] as $cart_id_finder)
            $cart_id = $cart_id_finder;

        $cart_delete = Cart::find($cart_id);
        $cart_delete->delete();

        $data = array(
            'flash_message' => 'Product delete Successfully!'
        );
        return redirect('/my_cart/show')->with($data);
    }
}

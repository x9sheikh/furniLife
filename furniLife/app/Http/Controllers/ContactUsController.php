<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactUsFormSubmitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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
            'user' => Auth::user(),
            'mycart_products' => $mycart_products,
            'total_price' => $total_price,
            'quick_view' => false,
        );

        return view('contactus.index')->with($data);
    }

    public function submit(ContactUsFormSubmitRequest $request){
        $title = $request->input('title');
        $message = $request->input('message');

        $contact = new  Contact();
        $contact->title = $title;
        $contact->message = $message;
        $contact->user_id = Auth::user()->id;
        $contact->save();

        $data = array(
            'flash_success' => 'Message Send Successfully!'
        );
        return redirect('/contactus/show')->with($data);

    }
}

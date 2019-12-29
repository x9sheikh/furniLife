<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MineController extends Controller
{
    public function mine(){
        $products = Product::all();
        foreach ($products as $product){
            $p = Product::find(1);
            //$p->description = "This product is really Awesome and comfortable to use. As you many of people nowadays are using this product. This product is very cheap. So, that eveyone coluld afford it. Now, It can be poosible to reach and buy for everyone due to its cheaper price as compare tp other Brand. Now, Hit the buy button to purchase quickly";
            $p->title = "abc";
            $p->save;
            print_r('Success '.$p->id);
        }
        return "";
    }
}

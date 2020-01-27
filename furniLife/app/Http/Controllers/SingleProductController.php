<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ReviewSubmitFormRequest;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SingleProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($product_id)
    {
        $product = Product::find($product_id);
        $product_category = $product->category_id;
        $related_products = DB::select('select * from products where category_id = :category_id', ['category_id' => $product_category]);

        $product = Product::find($product_id);

        $star_one = DB::select('select star from reviews where star=:star and product_id=:product_id', ['star' => 1, 'product_id' => $product_id]);
        $count_star_one = count($star_one);
        $star_two = DB::select('select star from reviews where star=:star and product_id=:product_id', ['star' => 2, 'product_id' => $product_id]);
        $count_star_two = count($star_two);
        $star_three = DB::select('select star from reviews where star=:star and product_id=:product_id', ['star' => 3, 'product_id' => $product_id]);
        $count_star_three = count($star_three);
        $star_four = DB::select('select star from reviews where star=:star and product_id=:product_id', ['star' => 4, 'product_id' => $product_id]);
        $count_star_four = count($star_four);
        $star_five = DB::select('select star from reviews where star=:star and product_id=:product_id', ['star' => 5, 'product_id' => $product_id]);
        $count_star_five = count($star_five);

        $average_star = ($count_star_one+$count_star_two+$count_star_three+$count_star_four+$count_star_five)/5;


        $reviews = DB::select('SELECT reviews.id, reviews.product_id, reviews.review, reviews.star, users.name FROM reviews
                        LEFT JOIN users ON users.id = reviews.user_id where reviews.product_id = :product_id', ['product_id' => $product_id]);

        $all_reviews = $reviews;
        $total_review = count($reviews);


        if ($product){
            // Here, we return everything, if the condition True
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
                'categories' => Category::all(),
                'reviews' => $all_reviews,
                'total_review' => $total_review,
                'average_star' => $average_star,
                'star_one' => $count_star_one,
                'star_two' => $count_star_two,
                'star_three' => $count_star_three,
                'star_four' => $count_star_four,
                'star_five' => $count_star_five,
                'user' => Auth::user(),
                'product' => $product,
                'mycart_products' => $mycart_products,
                'total_price' => $total_price,
                'quick_view' => true,
                'related_products' => $related_products,
            );
            return view('single_product.index')->with($data);
        }
        else{
            return view('errors.404');
        }

    }

    public function review(ReviewSubmitFormRequest $request, $id){
        $star = $request->input('star');
        $review_des = $request->input('review');
        $product_id = $id;
        $user = Auth::user();

        $review = new Review();
        $review->user_id = $user->id;
        $review->product_id = $product_id;
        $review->star = $star;
        $review->review = $review_des;
        $review->save();
        $data = array(
            'flash_success' => 'Review Created Successfully!'
        );
        return redirect("/$product_id")->with($data);
    }
}

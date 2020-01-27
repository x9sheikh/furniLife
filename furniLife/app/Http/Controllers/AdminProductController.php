<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminAddProductFormValidation;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $total_users = User::all();
        $user = Auth::user();
        $total_undeliver = DB::select('SELECT * FROM requests where status = :status', ['status' => 'requested']);
        $undelivered_orders = DB::select('SELECT * FROM requests INNER JOIN products on products.id = requests.product_id where status = :status limit 4', ['status'=>'requested'] );
        $data = array(
            'categories' => $categories,
            'user' => $user,
            'active' => 'add_products',
            'unread_complaints' => $unread_complaints,
            'total_users' => $total_users,
            'undelivered' => $undelivered_orders,
            'total_undelivered' => $total_undeliver,
        );
        return view('admin.add_products')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminAddProductFormValidation $request)
    {
        $title = $request->title;
        $price = $request->price;
        $description = $request->description;
        $is_best = $request->is_best;
        $category = $request->category;
        $profile = $request->product_file;
        if ($category == 0){
            $data = array(
                'flash_danger' => 'Please Select Any Category',
            );
            return redirect()->back()->with($data);
        }
        // GET FILE NAME WITH EXTENSION
        $file_name_with_ext = $request->file('product_file')->getClientOriginalName();
        // GET JUST FILE NAME
        $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
        // GET JUST FILE EXTENSION
        $extension = $request->file('product_file')->getClientOriginalExtension();
        // MAKING NEW FILE NAME WITH EXTENSION
        $new_file_name_with_ext = $file_name.'_'.time().'.'.$extension;
        // UPLOAD/SAVE FILE IN PUBLIC FOLDER
        $request->file('product_file')->storeAs('public/product_images', $new_file_name_with_ext);
        $request->file('product_file')->move(public_path('/uploaded_files'), $new_file_name_with_ext);


        $product = new Product();
        $product->title = $title;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category;
        if ($is_best == 'on'){
            $product->is_best = 1;
        }else{
            $product->is_best = 0;
        }
        $product->profile = $new_file_name_with_ext;
        $product->save();

        $data = array(
            'flash_info' => 'Product Created Successful',
        );
        return redirect(route('admin.home'))->with($data);
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
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $total_users = User::all();
        $product = Product::find($id);
        $product_category = Category::find($product->category_id);
        $categories = Category::all();
        $total_undeliver = DB::select('SELECT * FROM requests where status = :status', ['status' => 'requested']);
        $undelivered_orders = DB::select('SELECT * FROM requests INNER JOIN products on products.id = requests.product_id where status = :status limit 4', ['status'=>'requested'] );
        $data = array(
            'product' => $product,
            'product_category' => $product_category,
            'categories' => $categories,
            'active' => 'show_all_products',
            'user' => Auth::user(),
            'unread_complaints' => $unread_complaints,
            'total_users' => $total_users,
            'undelivered' => $undelivered_orders,
            'total_undelivered' => $total_undeliver,
        );
        return view('admin.edit_product')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminAddProductFormValidation $request, $id)
    {
        if ($request->file('product_file')){
            // GET FILE NAME WITH EXTENSION
            $file_name_with_ext = $request->file('product_file')->getClientOriginalName();
            // GET JUST FILE NAME
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            // GET JUST FILE EXTENSION
            $extension = $request->file('product_file')->getClientOriginalExtension();
            // MAKING NEW FILE NAME WITH EXTENSION
            $new_file_name_with_ext = $file_name.'_'.time().'.'.$extension;
            // UPLOAD/SAVE FILE IN PUBLIC FOLDER
            $request->file('product_file')->storeAs('public/product_images', $new_file_name_with_ext);
            $request->file('product_file')->move(public_path('/uploaded_files'), $new_file_name_with_ext);
            $product = Product::find($id);
            $product->title = $request->title;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->profile = $new_file_name_with_ext;
            if ($request->is_best == 'on'){
                $product->is_best = 1;
            }
            else{
                $product->is_best = 0;
            }
            $product->category_id = $request->category;
            $product->save();
            $data = array(
                'flash_info' => 'Product Updated Successful',
            );
            return redirect(route('product.show_all_products'))->with($data);
        }
        else{
            $product = Product::find($id);
            $product->title = $request->title;
            $product->price = $request->price;
            $product->description = $request->description;
            if ($request->is_best == 'on'){
                $product->is_best = 1;
            }
            else{
                $product->is_best = 0;
            }
            $product->category_id = $request->category;
            $product->save();
            $data = array(
                'flash_info' => 'Product Updated Successful',
            );
            return redirect(route('product.show_all_products'))->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $product = Product::find($id);
       $product->delete();
       $data = array(
         'flash_danger' => 'Product Deleted'
       );
       return redirect(route('product.show_all_products'))->with($data);
    }

    public function show_all_products(){
        $user = Auth::user();
        $total_users = User::all();
        $unread_complaints = DB::select('SELECT * FROM complaints where status = :status', ['status'=> 'unread']);
        $products = Product::all();
        $total_undeliver = DB::select('SELECT * FROM requests where status = :status', ['status' => 'requested']);
        $undelivered_orders = DB::select('SELECT * FROM requests INNER JOIN products on products.id = requests.product_id where status = :status limit 4', ['status'=>'requested'] );
        $data = array(
            'products' => $products,
            'user' => $user,
            'active' => 'show_all_products',
            'unread_complaints' => $unread_complaints,
            'total_users' => $total_users,
            'undelivered' => $undelivered_orders,
            'total_undelivered' => $total_undeliver,
        );
        return view('admin.show_all_products')->with($data);
    }

}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $user = Auth::user();
        $total_users = User::all();
        $data = array(
            'user' => $user,
            'total_users' => $total_users,
        );
        return view('admin.index')->with($data);
    }
}

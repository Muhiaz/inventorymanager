<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $suppliers = \DB::table('suppliers')->count();
       $orders = \DB::table('orders')->count();
       $products = \DB::table('products')->count();
        return view('home')
        ->with('suppliers',$suppliers)
        ->with('orders',$orders)
        ->with('products',$products);
    }
}

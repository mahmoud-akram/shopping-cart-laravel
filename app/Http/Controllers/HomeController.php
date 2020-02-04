<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')-> except ('store');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

     public function store()
    {

       Alert::success('Success Title', 'Success Message');

        $latestProducts = Product::latest()-> take(3)->get();
        return view('store' ,compact ('latestProducts') );
    }



    






}

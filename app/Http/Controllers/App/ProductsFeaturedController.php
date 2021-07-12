<?php

namespace App\Http\Controllers\App;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductsFeaturedController extends Controller
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
    public function productFeatured()
    {
    	$current = 'catalogo_background';
    	return view('app.products-featured')->with('current', $current);
    }

    public function catalog()
    {
    	$current = 'catalogo_background';
    	return view('app.catalog')->with('current', $current);
    }

    public function getUserAuth()
    {
	    	return Auth::user();
    }

    public function getProducts()
    {
	    	return Product::where('is_active', 1)->get();
    }
}

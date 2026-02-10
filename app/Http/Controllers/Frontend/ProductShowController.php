<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductShowController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function products()
    {
        return Product::with('category')->get();
    }

    public function show($id)
    {
        return Product::with('category')->findOrFail($id);
    }
}

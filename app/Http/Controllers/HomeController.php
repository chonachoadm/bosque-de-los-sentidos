<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::all();
        $products = Product::latest()->take(5)->get();
        $tags = Tag::all();
        return view('home', compact('products', 'tags', 'featuredProducts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class GameController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $products = Product::all();
        return view('public-area.games.index', compact('products', 'tags'));
    }

    public function show(Product $product)
    {
        $tags = Tag::all();
        $products = Product::all();
        return view('public-area.games.show', compact('product'));
    }
}

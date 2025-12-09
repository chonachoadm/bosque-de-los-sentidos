<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ContactController extends Controller
{
    public function __invoke()
    {
        $products = Product::all();
        return view('public-area.contact', compact('products'));
    }
}

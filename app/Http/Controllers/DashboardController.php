<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
        $users = User::all();
        $tags = Tag::all();
        $products = Product::all();
        return view('dashboard', compact('users', 'tags', 'products', 'purchases'));
    }
}

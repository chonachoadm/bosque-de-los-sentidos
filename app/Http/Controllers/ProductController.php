<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedInputs = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:5000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'integer|min:0',
            'image' => 'image|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'description.string' => 'La descripción debe ser un texto válido',
            'description.max' => 'La descripción no puede superar los 5000 caracteres',
            'price.required' => 'El precio es obligatorio',
            'price.numeric' => 'El precio debe ser un número',
            'price.min' => 'El precio debe estar entre 0 y 999999,99',
            'price.max' => 'El precio debe estar entre 0 y 999999,99',
            'stock.integer' => 'El stock debe ser un número',
            'stock.min' => 'El stock mínimo permitido es de 0',
            'image.image' => 'El archivo debe ser una imagen',
            'image.max' => 'La imagen no puede superar los 2MB',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('/images');
            $validatedInputs['image'] = basename($imagePath);
        }
        Product::create($validatedInputs);
        return redirect()->route('products.index')->with('success', 'Producto creado exitósamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $products = Product::all();
        $tags = Tag::all();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedInputs = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:5000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'integer|min:0',
            'image' => 'image|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'description.string' => 'La descripción debe ser un texto válido',
            'description.max' => 'La descripción no puede superar los 5000 caracteres',
            'price.required' => 'El precio es obligatorio',
            'price.numeric' => 'El precio debe ser un número',
            'price.min' => 'El precio debe estar entre 0 y 999999,99',
            'price.max' => 'El precio debe estar entre 0 y 999999,99',
            'stock.integer' => 'El stock debe ser un número',
            'stock.min' => 'El stock mínimo permitido es de 0',
            'image.image' => 'El archivo debe ser una imagen',
            'image.max' => 'La imagen no puede superar los 2MB',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('/images');
            $validatedInputs['image'] = basename($imagePath);
        }
        $product->update($validatedInputs);
        return redirect()->route('products.index')->with('success', 'Producto actualizado exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado');
    }
}

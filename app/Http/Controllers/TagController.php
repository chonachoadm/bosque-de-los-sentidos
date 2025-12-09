<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedInputs = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
        ]);
        Tag::create($validatedInputs);
        return redirect()->route('tags.index')->with('success', 'Categoría creada exitósamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tags = Tag::all();
        $products = Product::all();
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validatedInputs = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
        ]);
        $tag->update($validatedInputs);
        return redirect()->route('tags.index')->with('success', 'Categoría actualizada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Categoría eliminada');
    }
}

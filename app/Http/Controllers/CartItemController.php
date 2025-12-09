<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return view('public-area.cart', compact('cartItems'));
        }
        $data = [];
        foreach ($cartItems as $item) {
            $data[] = [
                'title' => $item->product->name,
                'quantity' => $item->quantity,
                'unit_price' => (float) $item->product->price,
            ];
        }
        $client = new PreferenceClient();
        $purchaseOrder = $client->create([
            'items' => $data,
            'back_urls' => [
                // Rutas reales (En el controlador se definen las distintas respuestas en base al estado de la compra)
                'success' => 'localhost:8000/purchases/callback',
                'failure' => 'localhost:8000/purchases/callback',
                'pending' => 'localhost:8000/purchases/callback',

                // Rutas de prueba
                // 'success' => 'www.google.com/search?q=success',
                // 'failure' => 'www.google.com/search?q=failure',
                // 'pending' => 'www.google.com/search?q=pending',
            ],
            'auto_return' => 'approved',
            'statement_descriptor' => 'El Bosque de los Sentidos',
            'external_reference' => Auth::id() . '-' . time(),
        ]);
        return view('public-area.cart', compact('cartItems', 'purchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);
        $userId = Auth::id();
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $validated['product_id'])
            ->first();
        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }
        return redirect()->route('games')->with('success', 'Producto añadido al carrito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'action' => 'required|in:increment,decrement',
        ]);
        $item = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        if ($validated['action'] === 'increment') {
            $item->increment('quantity');
        } else {
            if ($item->quantity > 1) {
                $item->decrement('quantity');
            } else {
                $item->delete();
                return redirect()->back()->with('success', 'Producto eliminado del carrito');
            }
        }
        return redirect()->back()->with('success', 'Cantidad actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $item->delete();
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Remove all items from the authenticated user's cart.
     */
    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Carrito vaciado');
    }
}

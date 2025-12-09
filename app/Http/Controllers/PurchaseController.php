<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statuses = Status::all();

        $query = Purchase::query();
        if ($request->has('status_id') && $request->status_id != '0') {
            $query->where('status_id', $request->status_id);
        }
        $purchases = $query->paginate(20);
        return view('purchases.index', compact('purchases', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
        $products = Product::all();
        $users = User::all();
        return view('purchases.create', compact('users', 'products', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'products' => 'required|array|min:1',
            'status_id' => 'required',
        ], [
            'user_id.required' => 'El usuario es obligatorio',
            'products.required' => 'Debe haber como mínimo 1 producto seleccionado',
            'status_id.required' => 'El estado de pago es obligatorio',
        ]);
        $totalAmount = 0;
        $selectedProductIds = $request->input('products', []);
        foreach ($selectedProductIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $totalAmount += $product->price;
            }
        }
        $preferenceId = $request->user_id . '-' . time();
        $purchase = Purchase::create([
            'user_id' => $validated['user_id'],
            'status_id' => $validated['status_id'],
            'total_amount' => $totalAmount,
            'preference_id' => $preferenceId,
        ]);
        foreach ($selectedProductIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                PurchaseProduct::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'unit_price' => $product->price,
                    'subtotal' => $product->price * 1,
                ]);
            }
        }
        return redirect()->route('purchases.index')->with('success', 'Compra creada exitósamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $orders = PurchaseProduct::where('purchase_id', $purchase->id)->get();
        return view('purchases.show', compact('purchase', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $statuses = Status::all();
        $products = Product::all();
        $users = User::all();
        return view('purchases.edit', compact('purchase', 'statuses', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'products' => 'required|array|min:1',
            'status_id' => 'required',
        ], [
            'user_id.required' => 'El usuario es obligatorio',
            'products.required' => 'Debe haber como mínimo 1 producto seleccionado',
            'status_id.required' => 'El estado de pago es obligatorio',
        ]);
        $totalAmount = 0;
        $selectedProductIds = $request->input('products', []);
        foreach ($selectedProductIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $totalAmount += $product->price;
            }
        }
        $preferenceId = $request->user_id . '-' . time();
        $purchase->update([
            'user_id' => $validated['user_id'],
            'status_id' => $validated['status_id'],
            'total_amount' => $totalAmount,
            'preference_id' => $preferenceId,
        ]);
        PurchaseProduct::where('purchase_id', $purchase->id)->delete();
        foreach ($selectedProductIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                PurchaseProduct::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'unit_price' => $product->price,
                    'subtotal' => $product->price * 1,
                ]);
            }
        }
        return redirect()->route('purchases.index')->with('success', 'Compra actualizada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Compra eliminada exitósamente');
    }

    public function storePurchase(Request $request)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        $statusId = null;
        $paymentStatus = $request->query('status');

        if ($paymentStatus === 'approved') {
            $statusName = 'success';
        } elseif ($paymentStatus === 'rejected') {
            $statusName = 'failure';
        } else {
            $statusName = 'pending';
        }

        foreach (Status::all() as $state) {
            if ($state->status_name === $statusName) {
                $statusId = $state->id;
                break;
            }
        }

        $preferenceId = $request->query('preference_id');

        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'preference_id' => $preferenceId,
            'status_id' => $statusId,
            'total_amount' => $totalAmount,
        ]);
        return redirect()->route('purchase.response', ['id' => $purchase->id, 'statusName' => $statusName]);
    }

    public function storePurchaseProducts($id, $statusName)
    {
        $purchaseId = $id;
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            PurchaseProduct::create([
                'purchase_id' => $purchaseId,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'unit_price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity,
            ]);
        };
        if ($statusName !== 'failure') {
            CartItem::where('user_id', Auth::id())->delete();
        }

        if ($statusName === 'success') {
            return redirect()->route('home')->with('success', '¡Compra realizada exitosamente!');
        } else if ($statusName === 'failure') {
            return redirect()->route('cart.index')->with('error', 'La compra no se logró completar. Por favor, intentalo de nuevo.');
        } else {
            return redirect()->route('games')->with('info', 'La compra está pendiente de confirmación. Te notificaremos una vez se haya completado.');
        }
    }
}

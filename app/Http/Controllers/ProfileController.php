<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $purchases = Purchase::where('user_id', $userId)->get();

        return view('public-area.profile.index', compact('purchases'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('public-area.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->profile) {
            $user->profile()->create([]);
        }
        $profile = $user->profile;
        $data = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'integer|min:1000000000|max:999999999999',
                'address' => 'string|max:500',
                'birth_date' => 'date|before:today',
            ],
            [
                'name.required' => 'El nombre es obligatorio',
                'name.string' => 'El nombre debe ser un texto válido',
                'name.max' => 'El nombre no puede exceder los 255 caracteres',
                'email.required' => 'El email es obligatorio',
                'email.email' => 'El email debe tener un formato válido',
                'phone.integer' => 'Debe ser un número válido',
                'phone.min' => 'El número debe tener como mínimo 10 dígitos',
                'phone.max' => 'El número debe tener como máximo 12 dígitos',
                'address.string' => 'La dirección debe ser un texto válido',
                'address.max' => 'La dirección no puede exceder los 500 caracteres',
                'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida',
                'birth_date.before' => 'La fecha de nacimiento debe ser previa a la fecha actual',
            ]
        );
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        $profileData = [
            'phone' => $data['phone'],
            'address' => $data['address'],
            'birth_date' => $data['birth_date'],
        ];
        $user->update($userData);
        $profile->update($profileData);
        return redirect()->route('profile', $user->id)->with('success', 'Perfil actualizado exitósamente');
    }

    public function showPurchase(Purchase $purchase)
    {
        $orders = PurchaseProduct::where('purchase_id', $purchase->id)->get();
        return view('public-area.profile.purchase-data', compact('purchase', 'orders'));
    }
}

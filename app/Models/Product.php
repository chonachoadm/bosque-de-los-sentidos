<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)->using(PurchaseProduct::class)->withPivot('quantity', 'unit_price', 'subtotal')->withTimestamps();;
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

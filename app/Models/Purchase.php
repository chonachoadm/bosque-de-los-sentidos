<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [
        'user_id',
        'total_amount',
        'preference_id',
        'status_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_product')->using(PurchaseProduct::class)->withPivot('quantity', 'unit_price', 'subtotal')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

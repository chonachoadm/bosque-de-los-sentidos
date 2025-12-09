<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PurchaseProduct extends Pivot
{
    protected $table = 'purchase_product';

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function getSubtotal()
    {
        return $this->quantity * $this->unit_price;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

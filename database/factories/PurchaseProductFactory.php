<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Purchase;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PurchaseProductFactory extends Factory
{

    protected $model = \App\Models\PurchaseProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 3);
        $productId = $this->attributes['product_id'] ?? null;
        if ($productId) {
            $product = Product::find($productId);
            $unitPrice = $product ? $product->price : fake()->randomFloat(2, 15000, 70000);
        } else {
            $unitPrice = fake()->randomFloat(2, 15000, 70000);
        }
        return [
            'purchase_id' => Purchase::inRandomOrder()->value('id'),
            'product_id' => $productId ?? Product::inRandomOrder()->value('id'),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $unitPrice * $quantity,
        ];
    }
}

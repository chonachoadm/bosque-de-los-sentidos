<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $userId = User::inRandomOrder()->value('id');
        return [
            'user_id' => $userId,
            'preference_id' => $userId . '-' . fake()->unique()->randomNumber(8),
            'status_id' => Status::inRandomOrder()->value('id'),
            'total_amount' => 0,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Purchase $purchase) {
            $products = Product::inRandomOrder()->take(rand(1, 4))->get();
            $total = 0;
            foreach ($products as $product) {
                $quantity = fake()->numberBetween(1, 3);
                $unitPrice = $product->price;
                $subtotal = $quantity * $unitPrice;
                $purchase->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }
            $purchase->update(['total_amount' => $total]);
        });
    }
}

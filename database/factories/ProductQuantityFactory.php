<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductQuantity;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductQuantity>
 */
class ProductQuantityFactory extends Factory
{
    protected $model = ProductQuantity::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'warehouse_id' => \App\Models\Warehouse::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}

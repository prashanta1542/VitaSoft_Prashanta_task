<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Warehouse;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehous>
 */
class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}

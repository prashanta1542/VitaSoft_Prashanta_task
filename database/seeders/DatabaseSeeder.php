<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Tax;
use App\Models\Warehouse;
use App\Models\ProductQuantity;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Brand::factory(10)->create();
        Category::factory(10)->create();
        Unit::factory(10)->create();
        Tax::factory(10)->create();
        Warehouse::factory(10)->create();
        Product::factory(50)->create();
        ProductQuantity::factory(100)->create();
    }
}

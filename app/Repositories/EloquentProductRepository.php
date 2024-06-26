<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepository
{
    public function findById($id): ?Product
    {
        return Product::find($id);
    }

    public function findAll(): Collection
    {
        return Product::all();
    }

    public function create(array $attributes): Product
    {
        return Product::create($attributes);
    }

    public function update(Product $product, array $attributes): bool
    {
        return $product->update($attributes);
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    public function findByCategory($categoryId): Collection
    {
        return Product::where('category_id', $categoryId)->get();
    }

    public function findByBrand($brandId): Collection
    {
        return Product::where('brand_id', $brandId)->get();
    }
}

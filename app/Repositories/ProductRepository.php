<?php
namespace App\Repositories;

use App\Models\Product;

interface ProductRepository
{
    public function findById($id);

    public function findAll();

    public function create(array $attributes);

    public function update(Product $product, array $attributes);

    public function delete(Product $product);

    public function findByCategory($categoryId);

    public function findByBrand($brandId);
}

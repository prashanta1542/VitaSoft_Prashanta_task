<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index():JsonResponse
    {
        $products = $this->productRepository->findAll();
        return response()->json(['data' => $products, 'message' => 'Products retrieved successfully'], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'unit_id' => 'required|integer|exists:units,id',
            'tax_id' => 'required|integer|exists:taxes,id',
        ]);

        $product = $this->productRepository->create($validated);
        return response()->json(['data' => $product, 'message' => 'Product created successfully'], 201);
    }

    public function show($id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(['data' => $product, 'message' => 'Product retrieved successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'unit_id' => 'required|integer|exists:units,id',
            'tax_id' => 'required|integer|exists:taxes,id',
        ]);

        $product->update($validated);
        return response()->json(['data' => $product, 'message' => 'Product updated successfully'], 200);
    }

    public function destroy($id)
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function findByCategory($categoryId)
    {
        $products = $this->productRepository->findByCategory($categoryId);
        return response()->json(['data' => $products, 'message' => 'Products retrieved successfully'], 200);
    }

    public function findByBrand($brandId)
    {
        $products = $this->productRepository->findByBrand($brandId);
        return response()->json(['data' => $products, 'message' => 'Products retrieved successfully'], 200);
    }

}

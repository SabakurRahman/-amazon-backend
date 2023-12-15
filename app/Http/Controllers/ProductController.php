<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = Product::all();

        return response()->json(
            $data = $product,
            $status = 200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return response()->json(
            $data = $product,
            $status = 200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getProductBySlug($slug)
    {
        try {
            // Attempt to retrieve the product by slug
            $product = Product::query()->where('slug', $slug)->firstOrFail();

            // Product found, return a success response
            return response()->json($product, 200);
        } catch (\Exception $e) {
            // Product not found, return an error response
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}

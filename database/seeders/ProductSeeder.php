<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Product 1',
                'price' => 100,
                'image' => '/images/p1.jpg',
                'slug' => 'product-1',
                'category' => 'category-1',
                'countInStoke' => 10,
                'brand' => 'Brand 1',
                'rating' => 4.5,
                'numReviews' => 10,
                'description' => 'Description 1',
            ],
            [
                'name' => 'Product 2',
                'price' => 200,
                'image' => '/images/p2.jpg',
                'slug' => 'product-2',
                'category' => 'category-2',
                'countInStoke' => 20,
                'brand' => 'Brand 2',
                'rating' => 4.0,
                'numReviews' => 10,
                'description' => 'Description 2',
            ],
            [
                'name' => 'Product 3',
                'price' => 300,
                'image' => '/images/p3.jpg',
                'slug' => 'product-3',
                'category' => 'category-3',
                'countInStoke' => 30,
                'brand' => 'Brand 3',
                'rating' => 3.5,
                'numReviews' => 10,
                'description' => 'Description 3',
            ],
            [
                'name' => 'Product 4',
                'price' => 400,
                'image' => '/images/p4.jpg',
                'slug' => 'product-4',
                'category' => 'category-4',
                'countInStoke' => 40,
                'brand' => 'Brand 4',
                'rating' => 3.0,
                'numReviews' => 10,
                'description' => 'Description 4',
            ],
        ];

        // Insert the data into the 'products' table
        DB::table('products')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'This is the first product.',
            'price' => 10.99,
            'image' => 'product1.jpg',
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'This is the second product.',
            'price' => 15.49,
            'image' => 'product2.jpg',
        ]);

        Product::create([
            'name' => 'Product 3',
            'description' => 'This is the third product.',
            'price' => 7.99,
            'image' => 'product3.jpg',
        ]);
    }
}

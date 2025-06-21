<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Product::insert([
            [
                'name' => 'Laptop',
                'sku' => 'PROD-001',
                'price' => 75000,
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mouse',
                'sku' => 'PROD-002',
                'price' => 499,
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard',
                'sku' => 'PROD-003',
                'price' => 899,
                'quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Monitor',
                'sku' => 'PROD-004',
                'price' => 12000,
                'quantity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

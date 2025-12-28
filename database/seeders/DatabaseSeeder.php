<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a default Admin User (So you don't have to register every time)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Define Realistic Inventory Items
        $inventory = [
            'Electronics' => [
                ['name' => 'MacBook Pro M3', 'sku' => 'LAP-MBP-001', 'price' => 1999.99],
                ['name' => 'iPhone 15 Pro', 'sku' => 'PHN-IP15-02', 'price' => 999.00],
                ['name' => 'Logitech MX Master 3S', 'sku' => 'ACC-LOG-03', 'price' => 99.50],
                ['name' => 'Dell 27-inch 4K Monitor', 'sku' => 'MON-DEL-04', 'price' => 450.00],
                ['name' => 'Sony WH-1000XM5 Headphones', 'sku' => 'AUD-SON-05', 'price' => 349.99],
            ],
            'Furniture' => [
                ['name' => 'Ergonomic Office Chair', 'sku' => 'FUR-CHR-01', 'price' => 299.00],
                ['name' => 'Standing Desk (Electric)', 'sku' => 'FUR-DSK-02', 'price' => 499.00],
                ['name' => 'LED Desk Lamp', 'sku' => 'FUR-LMP-03', 'price' => 45.00],
            ],
            'Office Supplies' => [
                ['name' => 'Heavy Duty Stapler', 'sku' => 'OFF-STP-01', 'price' => 15.00],
                ['name' => 'A4 Printer Paper', 'sku' => 'OFF-PPR-03', 'price' => 12.00],
            ]
        ];

        // 3. Loop through the data to create Categories and Products
        foreach ($inventory as $categoryName => $products) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($products as $item) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'sku' => $item['sku'],
                    'price' => $item['price'],
                    'quantity' => rand(2, 50), // Gives each item a random starting stock
                    'alert_level' => 10,       // Standard alert level
                ]);
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmaProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Product Status
        DB::table('sma_product_status')->insert([
            [
                'id' => 1,
                'status_name' => 'Available',
                'status' => 1,
                'color_code' => '#28a745'
            ],
            [
                'id' => 2,
                'status_name' => 'Out of Stock',
                'status' => 0,
                'color_code' => '#dc3545'
            ],
            [
                'id' => 3,
                'status_name' => 'Discontinued',
                'status' => 0,
                'color_code' => '#6c757d'
            ]
        ]);

        // Seed Categories
        DB::table('sma_categories')->insert([
            [
                'id' => 1,
                'code' => 'CAT-COMP',
                'name' => 'Computers',
                'parent_id' => null,
                'slug' => 'computers',
                'image' => 'computer.png',
                'description' => 'All computer products'
            ],
            [
                'id' => 2,
                'code' => 'CAT-LAPTOP',
                'name' => 'Laptops',
                'parent_id' => 1,
                'slug' => 'laptops',
                'image' => 'laptop.png',
                'description' => 'Laptop computers'
            ],
            [
                'id' => 3,
                'code' => 'CAT-DESKTOP',
                'name' => 'Desktops',
                'parent_id' => 1,
                'slug' => 'desktops',
                'image' => 'desktop.png',
                'description' => 'Desktop computers'
            ]
        ]);

        // Seed Brands
        DB::table('sma_brands')->insert([
            [
                'id' => 1,
                'code' => 'BR-DELL',
                'name' => 'Dell',
                'image' => 'dell.png',
                'slug' => 'dell',
                'description' => 'Dell Computer Products'
            ],
            [
                'id' => 2,
                'code' => 'BR-HP',
                'name' => 'HP',
                'image' => 'hp.png',
                'slug' => 'hp',
                'description' => 'HP Computer Products'
            ],
            [
                'id' => 3,
                'code' => 'BR-LENOVO',
                'name' => 'Lenovo',
                'image' => 'lenovo.png',
                'slug' => 'lenovo',
                'description' => 'Lenovo Computer Products'
            ]
        ]);

        // Seed Units
        DB::table('sma_units')->insert([
            [
                'id' => 1,
                'code' => 'PC',
                'name' => 'Piece',
                'base_unit' => null,
                'operator' => null,
                'operation_value' => null
            ],
            [
                'id' => 2,
                'code' => 'BOX',
                'name' => 'Box',
                'base_unit' => '1',
                'operator' => '*',
                'operation_value' => 6
            ]
        ]);

        // Seed Products
        DB::table('sma_products')->insert([
            [
                'id' => 1,
                'code' => 'PRD001',
                'name' => 'Dell XPS 13',
                'second_name' => 'XPS 13 9380',
                'slug' => 'dell-xps-13',
                'details' => 'Intel Core i7, 16GB RAM, 512GB SSD',
                'price' => 1299.99,
                'mrp' => 1499.99,
                'promotion_price' => 1199.99,
                'category_id' => 2, // Laptops
                'subcategory_id' => null,
                'brand' => 1, // Dell
                'unit' => 1, // Piece
                'quantity' => 15,
                'image' => 'dell-xps-13.jpg',
                'product_status' => 1, // Available
                'date_created' => now(),
                'status_date' => now()
            ],
            [
                'id' => 2,
                'code' => 'PRD002',
                'name' => 'HP Pavilion',
                'second_name' => 'Pavilion 15',
                'slug' => 'hp-pavilion',
                'details' => 'Intel Core i5, 8GB RAM, 256GB SSD',
                'price' => 799.99,
                'mrp' => 899.99,
                'promotion_price' => null,
                'category_id' => 2, // Laptops
                'subcategory_id' => null,
                'brand' => 2, // HP
                'unit' => 1, // Piece
                'quantity' => 8,
                'image' => 'hp-pavilion.jpg',
                'product_status' => 1, // Available
                'date_created' => now(),
                'status_date' => now()
            ],
            [
                'id' => 3,
                'code' => 'PRD003',
                'name' => 'Lenovo ThinkCentre',
                'second_name' => 'ThinkCentre M720',
                'slug' => 'lenovo-thinkcentre',
                'details' => 'Intel Core i5, 8GB RAM, 1TB HDD, Windows 10 Pro',
                'price' => 649.99,
                'mrp' => 699.99,
                'promotion_price' => 599.99,
                'category_id' => 3, // Desktops
                'subcategory_id' => null,
                'brand' => 3, // Lenovo
                'unit' => 1, // Piece
                'quantity' => 0,
                'image' => 'lenovo-thinkcentre.jpg',
                'product_status' => 2, // Out of Stock
                'date_created' => now(),
                'status_date' => now()
            ]
        ]);

        $this->command->info('Sample product data seeded successfully!');
    }
}

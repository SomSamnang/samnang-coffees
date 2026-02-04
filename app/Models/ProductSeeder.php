<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Categories using firstOrCreate to avoid duplicates
        $hotCoffeeCategory = Category::firstOrCreate(['name' => 'Hot Coffee']);
        $icedCoffeeCategory = Category::firstOrCreate(['name' => 'Iced Coffee']);
        $drinksCategory = Category::firstOrCreate(['name' => 'Drinks']);

        // --- Create Products ---
        // Using firstOrCreate to avoid creating duplicate products on subsequent seeds.
        // It checks for the first argument array, and if not found, creates with both arrays merged.

        // Hot Coffees
        Product::firstOrCreate(
            ['name' => 'Hot Cappuccino'],
            [
                'price' => 3.50,
                'category_id' => $hotCoffeeCategory->id,
                'stock' => null, // Represents unlimited stock
                'is_active' => true,
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Hot Latte'],
            [
                'price' => 3.75,
                'category_id' => $hotCoffeeCategory->id,
                'stock' => null,
                'is_active' => true,
            ]
        );

        // Iced Coffees
        Product::firstOrCreate(
            ['name' => 'Iced Cappuccino'],
            [
                'price' => 4.25,
                'category_id' => $icedCoffeeCategory->id,
                'stock' => null,
                'is_active' => true,
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Iced Latte'],
            [
                'price' => 4.50,
                'category_id' => $icedCoffeeCategory->id,
                'stock' => null,
                'is_active' => true,
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Iced Americano'],
            [
                'price' => 3.25,
                'category_id' => $icedCoffeeCategory->id,
                'stock' => null,
                'is_active' => true,
            ]
        );
    }
}
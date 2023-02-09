<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = Brand::all();

        Product::factory()->count(50)->make()->each(function ($product) use ($brands) {
            $product->brand_id = $brands->random()->id;
            $product->save();
        });
    }
}

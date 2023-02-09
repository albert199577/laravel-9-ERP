<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Type;
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
        $types = Type::all();
        
        Product::factory()->count(50)->make()->each(function ($product) use ($brands, $types) {
            $product->brand_id = $brands->random()->id;
            $product->type_id = $types->random()->id;
            $product->save();
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Product_model;
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

            $count = 1;

            if (!$product->is_default) $count = random_int(2, 5);
            Product_model::factory()->count($count)->make()->each(function ($product_model) use ($product) {
                $product_model->product_id = $product->id;
                $product_model->save();
            });
        });
    }
}

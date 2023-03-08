<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Product_model;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductsModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $brands = Brand::all();
        $types = Type::all();

        $brand_id = $request->input('brand_id');

        return view('product_model.create', ['brands' => $brands, 'types' => $types, 'brand_id' => $brand_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->input('product-name'),
            'type_id' => $request->input('type-id'),
            'brand_id' => $request->input('brand-id'),
            'content' => 'test',
            'is_default' => $request->input('model-name')[0] ? false : true,
        ]);

        $models = $request->input('model-name');

        foreach ($models as $key => $value) {
            $product_model = Product_model::create([
                'name' => $request->input('model-name')[$key],
                'color' => $request->input('model-color')[$key],
                'cost' => $request->input('model-cost')[$key],
                'price' => $request->input('model-price')[$key],
                'stock' => $request->input('model-stock')[$key],
                'cargo_id' => $request->input('model-cargo_id')[$key],
                'product_id' => $product->id,
            ]);
        }
        
        session()->flash('status', '商品已建立');

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products_model  $products_model
     * @return \Illuminate\Http\Response
     */
    public function show(Product_model $product_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products_model  $products_model
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Product_model::with('product.brand', 'product.type')->findOrFail($id);
        $brands = Brand::all();
        $types = Type::all();

        return view('product_model.edit', ['model' => $model, 'brands' => $brands, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products_model  $products_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_model $product_model)
    {
        $product_model->name = $request->input('model-name');
        $product_model->color = $request->input('model-color');
        $product_model->cost = $request->input('model-cost');
        $product_model->price = $request->input('model-price');
        $product_model->stock = $request->input('model-stock');
        $product_model->cargo_id = $request->input('model-cargo_id');
        if ($request->input('brand-id') != 'null') {
            $product_model->product->brand_id = $request->input('brand-id');
        }
        if ($request->input('type-id') != 'null') {
            $product_model->product->type_id = $request->input('type-id');
        }

        $product_model->push();

        session()->flash('status', '商品資訊已更新');

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products_model  $products_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_model $product_model)
    {
        $product_model->delete();

        session()->flash('status', '商品種類已刪除');

        return redirect()->route('product.index');
    }
}

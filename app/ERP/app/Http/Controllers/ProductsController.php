<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->input('key');
        $type = $request->input('type');

        switch ($type) {
            case 'brand':
                $products = Product::whereHas('brand', function ($query) use ($key) {
                    $query->where('name', $key);
                })
                ->with(['brand', 'type'])->withSum('product_model', 'stock')->get();
                break;
            case 'type':
                $products = Product::whereHas('type', function ($query) use ($key) {
                    $query->where('name', $key);
                })
                ->with(['brand', 'type'])->withSum('product_model', 'stock')->get();
                break;
            case 'product_name':
                $products = Product::where('name', $key)->with(['brand', 'type'])->withSum('product_model', 'stock')->get();
                break;
            case 'model':
                
                break;
            case 'cargo_id':
                $products = Product::whereHas('product_model', function ($query) use ($key) {
                    $query->where('cargo_id', $key);
                })->with(['brand', 'type'])->withSum('product_model', 'stock')->get();
                break;
        }

        if (empty($key)) $products = Product::with(['brand', 'type', 'product_model'])->withSum('product_model', 'stock')->get();

        $total = 0;
        foreach ($products as $product) {
            foreach ($product->product_model as $model) {
                $total += $model->cost * $model->stock;
            }
        }

        return view('products.index', ['products' => $products, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('status', '商品已刪除');

        return redirect()->route('product.index');
    }
}

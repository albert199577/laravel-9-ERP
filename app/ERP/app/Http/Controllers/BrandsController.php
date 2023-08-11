<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = DB::table('brands')
                    ->select('brands.id', 'brands.name', DB::raw('SUM(COALESCE(product_models.price * product_models.stock, 0)) as brand_total'))
                    ->leftJoin('product_models', 'brands.id', '=', 'product_models.product_id')
                    ->groupBy('brands.name')
                    ->get();

        $total = 0;
        foreach ($brands as $brand) {
            $total += $brand->brand_total;
        }
        return view('brands.index', ['brands' => $brands, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:brands|max:20',
        ]);
        $brand = Brand::create($validated);

        session()->flash('status', '品牌已建立');

        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brands
     * @return \Illuminate\Http\Response
     */
    public function show($brand)
    {
        $brand = Brand::with(['product' => function ($query) {
            $query->withSum('product_model', 'stock');
        }, 'product.type', 'product.product_model'])->findOrFail($brand);

        $products = $brand->product;

        $total = 0;
        
        foreach ($brand->product as $product) {
            foreach ($product->product_model as $model) {
                $total += $model->cost * $model->stock;
            }
        }
        

        return view('brands.show', ['brands' => $brand, 'products' => $products, 'total' => $total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);
        $brand->fill($validated);
        $brand->save();

        session()->flash('status', '品牌名稱已更新');

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        session()->flash('status', '品牌已刪除');

        return redirect()->route('brand.index');
    }
}

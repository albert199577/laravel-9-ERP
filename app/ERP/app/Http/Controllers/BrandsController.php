<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', ['brands' => $brands]);
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
        $brand = Brand::with(['product.product_model', 'product.type'])->findOrFail($brand);
        
        $products = $brand->product;
        
        return view('brands.show', ['brands' => $brand, 'products' => $products]);
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

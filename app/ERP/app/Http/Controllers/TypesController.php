<?php

namespace App\Http\Controllers;

use App\Models\type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('types.index', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
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
        $type = Type::create($validated);

        session()->flash('status', '類別已建立');

        return redirect()->route('type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(type $type)
    {
        return view('types.edit', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, type $type)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);
        $type->fill($validated);
        $type->save();

        session()->flash('status', '類別名稱已更新');

        return redirect()->route('type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(type $type)
    {
        $type->delete();

        session()->flash('status', '類別已刪除');

        return redirect()->route('type.index');
    }
}

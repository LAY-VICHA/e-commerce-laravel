<?php

namespace App\Http\Controllers;

use App\Models\ProductScent;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductSize::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return ProductSize::create([
            'name' => $request->name,
            'price' => $request->price,
            "sce_id" => $request->sce_id,
            "pro_id" => $request->pro_id,
            "stock" => $request->stock,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ProductSize::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productSize = ProductSize::find($id);
        $productSize->update($request->all());
        return $productSize;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ProductSize::destroy($id);
    }

    /**
     * get all size in available scent.
     */
    public function getAllSizeFromScent(string $id)
    {
        $scent = ProductScent::find($id);

        if (!$scent) {
            return response([
                'message' => 'no data for given scent'
            ]);
        }

        return ProductSize::where('sce_id', $id)
            ->where('stock', ">", 0)
            ->get();
    }
}

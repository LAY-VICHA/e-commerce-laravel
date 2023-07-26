<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductScent;
use Illuminate\Http\Request;

class ProductScentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductScent::all();
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
        return ProductScent::create([
            'name' => $request->name,
            "pro_id" => $request->pro_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return ProductScent::find($id);
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
        //
        $productScent = ProductScent::find($id);
        $productScent->update($request->all());
        return $productScent;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ProductScent::destroy($id);
    }

    /**
     * get all productScent in a product.
     */
    public function getAllScentFromProduct(string $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response([
                'message' => 'no given product'
            ]);
        } 
            
        return ProductScent::where('pro_id', $id)->get();
    }
}

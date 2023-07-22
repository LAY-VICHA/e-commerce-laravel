<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
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
        $path = '';
        if($request->hasFile('image')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path = $request->image->store('photos', 'public');
        }

        $path2 = '';
        if($request->hasFile('image2')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path2 = $request->image2->store('photos', 'public');
        }

        $path3 = '';
        if($request->hasFile('image3')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path3 = $request->image3->store('photos', 'public');
        }

        $path4 = '';
        if($request->hasFile('image4')) {
            //public here is to clear laravel cache because we want path to autowrite and access publicly
            $path4 = $request->image4->store('photos', 'public');
        }

        return Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'image2' => $path2,
            'image3' => $path3,
            'image4' => $path4,
            "cat_id" => $request->cat_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::find($id);
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
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Product::destroy($id);
    }

    /**
     * get all product in a category.
     */
    public function categorize(string $id)
    {
        $category = ProductCategory::find($id);

        if(!$category) {
            return response([
                'message' => 'no given category'
            ]);
        } 
            
        return Product::where('cat_id', $id)->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShippingMethod::all();
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
        return ShippingMethod::create([
            'type' => $request->type,
            "price" => $request->price,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ShippingMethod::find($id);
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
        $shippingMethod = ShippingMethod::find($id);
        $shippingMethod->update($request->all());
        return $shippingMethod;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ShippingMethod::destroy($id);
    }
}

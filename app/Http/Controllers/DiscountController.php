<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Discount::all();
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
        return Discount::create([
            'code' => $request->code,
            'amount' => $request->amount,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Discount::find($id);
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
        $discount = Discount::find($id);
        $discount->update($request->all());
        return $discount;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Discount::destroy($id);
    }

    /**
     * find the discount by code
     */
    public function search(string $code)
    {
        return Discount::where('code', $code)->first();
    }
}

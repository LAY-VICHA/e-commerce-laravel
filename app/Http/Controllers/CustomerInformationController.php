<?php

namespace App\Http\Controllers;

use App\Models\CustomerInformation;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class CustomerInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerInformation::all();
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
        return CustomerInformation::create([
            'phonenumber' => $request->phonenumber,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'address' => $request->address,
            'apt' => $request->apt,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CustomerInformation::find($id);
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
        $customerInformation = CustomerInformation::find($id);
        $customerInformation->update($request->all());
        return $customerInformation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return CustomerInformation::destroy($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\CustomerInformation;
use App\Models\ShippingMethod;
use App\Models\Order;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
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
        return Order::create([
            'user_id' => $request->user_id,
            'subtotal' => $request->subtotal,
            "tax" => $request->tax,
            "dis_id" => $request->dis_id,
            "shi_id" => $request->shi_id,
            "cus_id" => $request->cus_id,
            "total" => $request->total,
            "status" => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Order::find($id);
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
        $order = Order::find($id);
        $order->update($request->all());
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Order::destroy($id);
    }

    /**
     * Get the discount of this order
     */
    public function discount(string $id)
    {
        $order = Order::find($id);

        if ($order->dis_id != null) {
            return Discount::where('id', $order->dis_id)->get();
        }
    }

    /**
     * Get the customer information of this order
     */
    public function customerInformation(string $id)
    {
        $order = Order::find($id);

        return CustomerInformation::where('id', $order->cus_id)->get();
    }

    /**
     * Get the shipping method of this order
     */
    public function shippingMethod(string $id)
    {
        $order = Order::find($id);

        return ShippingMethod::where('id', $order->shi_id)->get();
    }

    /**
     * To get the user unpaid checkout order (one user only have one unpaid checkout, otherwise they cannot checkout)
     */
    public function getUnpaidOrder(string $id)
    {
        $order = Order::where('user_id', $id)
                    ->where('status', 'unpaid')
                    ->get();

        if ($order) {
            return $order;
        }
    }

    /**
     * To get order information join with table discount, customer information, shipping method
     */
    public function getOrder(string $id)
    {
        return Order::leftjoin('discounts', 'orders.dis_id', '=', 'discounts.id')
                    ->join('customer_information', 'orders.cus_id', '=', 'customer_information.id')
                    ->join('shipping_methods', 'orders.shi_id', '=', 'shipping_methods.id')
                    ->select(
                        'orders.*',
                        'discounts.*',
                        'customer_information.*',
                        'shipping_methods.*',
                    )
                    ->where('orders.id', $id)
                    ->first()
                    ;
    }
}

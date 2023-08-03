<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderDetail::all();
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
        return OrderDetail::create([
            'order_id' => $request->order_id,
            'pro_id' => $request->pro_id,
            "sce_id" => $request->sce_id,
            "siz_id" => $request->siz_id,
            "quantity" => $request->quantity,
            "subtotal" => $request->subtotal,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return OrderDetail::find($id);
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
        $orderDetail = OrderDetail::find($id);
        $orderDetail->update($request->all());
        return $orderDetail;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return OrderDetail::destroy($id);
    }

    /**
     * get all the order detail of the order
     */
    public function getOrderDetailByOrder(string $id)
    {
        $order = Order::find($id);

        if(!$order) {
            return response([
                'message' => 'no data for given order'
            ]);
        }

        return OrderDetail::where('order_id', $id)
                        ->join('products', 'order_details.pro_id', '=', 'products.id')
                        ->join('product_scents', 'order_details.sce_id', '=', 'product_scents.id')
                        ->join('product_sizes', 'order_details.siz_id', '=', 'product_sizes.id')
                        ->select(
                            'order_details.*',
                            'products.name as product_name',
                            'products.image as product_image',
                            'product_scents.name as product_scent_name',
                            'product_sizes.name as product_size_name',
                            'product_sizes.price as product_size_price',
                        )
                        ->get();
    }
}

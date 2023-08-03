<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cart::all();
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
        return Cart::create([
            'user_id' => $request->user_id,
            'pro_id' => $request->pro_id,
            'sce_id' => $request->sce_id,
            'siz_id' => $request->siz_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price,
            'subtotal' => $request->subtotal,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cart::find($id);
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
        $cart = Cart::find($id);
        $cart->update($request->all());
        return $cart;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Cart::destroy($id);
    }

    /**
     * get all all the cart user have added with product name
     */
    public function getCurrentCart(string $id)
    {
        return Cart::where('user_id', $id)
            ->join('products', 'carts.pro_id', '=', 'products.id')
            ->join('product_scents', 'carts.sce_id', '=', 'product_scents.id')
            ->join('product_sizes', 'carts.siz_id', '=', 'product_sizes.id')
            ->select(
                'carts.*',
                'products.name as product_name',
                'products.image as product_image',
                'product_scents.name as product_scent_name',
                'product_sizes.name as product_size_name'
            )
            ->get();
    }

    /**
     * use for user checking out
     */
    public function checkout(string $id) //user id
    {
        //get all cart(product) ***preparing for storing it into order detail table***
        $carts = Cart::where('user_id', $id)->get();

        //check if cart is empty 
        if (!$carts) {
            return response([
                'message' => 'no data for checkout'
            ]);
        }

        $subtotal = 0;
        foreach ($carts as $cart) {
            $subtotal += $cart->subtotal;
        }
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        //create an order
        $order = Order::create([
            'user_id' => $id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 'unpaid',
        ]);

        return response()->json(['message' => 'Order created successfully']);
    }

    /**
     * use for user checking out again
     */
    public function checkoutAgain(string $id) //user id
    {
        //get all cart(product) ***preparing for storing it into order detail table***
        $carts = Cart::where('user_id', $id)->get();

        //check if cart is empty 
        if (!$carts) {
            return response([
                'message' => 'no data for checkout'
            ]);
        }

        $subtotal = 0;
        foreach ($carts as $cart) {
            $subtotal += $cart->subtotal;
        }
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        $order = Order::where('user_id', $id)
            ->where('status', 'unpaid')
            ->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);

        return response()->json(['message' => 'Order created successfully']);
    }

    /**
     * Called when user click pay 
     * This function will update orders status to paid 
     * Copy cart data to order detail
     * delete all cart with provided user id
     */
    public function pay(string $id) //user id
    {
        //get all cart(product) ***preparing for storing it into order detail table***
        $carts = Cart::where('user_id', $id)->get();

        //check if cart is empty 
        if (!$carts) {
            return response([
                'message' => 'no data for checkout'
            ]);
        }

        $order = Order::where('user_id', $id)
            ->where('status', 'unpaid')
            ->first();

        // store cart in order detail
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'pro_id' => $cart->pro_id,
                'sce_id' => $cart->sce_id,
                'siz_id' => $cart->siz_id,
                'quantity' => $cart->quantity,
                'subtotal' => $cart->subtotal,
            ]);
        }

        //delete the cart record of the user
        Cart::where('user_id', $id)->delete();

        //update status to paid
        Order::where('user_id', $id)
            ->where('status', 'unpaid')
            ->update([
                'status' => 'paid',
            ]);

        return response()->json(['message' => 'Pay successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function notification(string $id)
    {
        return Cart::where('user_id', $id)->get();
    }
}
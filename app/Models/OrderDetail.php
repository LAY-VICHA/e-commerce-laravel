<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductScent;
use App\Models\ProductSize;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'pro_id',
        'sce_id',
        'siz_id',
        'quantity',
        'subtotal',
    ];

    public function OrderOrderDetail()
    {
        return $this->belongsTo(Order::class);
    }

    public function productOrderDetail()
    {
        return $this->belongsTo(Product::class);
    }

    public function scentOrderDetail()
    {
        return $this->belongsTo(ProductScent::class);
    }

    public function sizeOrderDetail()
    {
        return $this->belongsTo(ProductSize::class);
    }
}

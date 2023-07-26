<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductScent;
use App\Models\Cart;
use App\Models\OrderDetail;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sce_id',
        'pro_id',
        'price',
        'stock',
    ];

    public function scentSize()
    {
        return $this->belongsTo(ProductScent::class);
    }

    public function productSize()
    {
        return $this->belongsTo(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

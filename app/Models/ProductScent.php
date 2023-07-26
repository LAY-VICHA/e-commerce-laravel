<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Cart;
use App\Models\OrderDetail;

class ProductScent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        "pro_id"
    ];

    public function productScent()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
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

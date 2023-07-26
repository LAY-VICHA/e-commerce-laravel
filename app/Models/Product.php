<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\ProductScent;
use App\Models\ProductSize;
use App\Models\Cart;
use App\Models\OrderDetail;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'image2',
        'image3',
        'image4',
        "cat_id"
    ];

    //category and product (1 to many)
    public function categoryProduct()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function scents()
    {
        return $this->hasMany(ProductScent::class);
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

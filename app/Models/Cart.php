<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductScent;
use App\Models\ProductSize;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pro_id',
        'sce_id',
        'siz_id',
        'quantity',
        'status',
        'price',
        'subtotal',
    ];

    public function userCart()
    {
        return $this->belongsTo(User::class);
    }

    public function productCart()
    {
        return $this->belongsTo(Product::class);
    }

    public function scentCart()
    {
        return $this->belongsTo(ProductScent::class);
    }

    public function sizeCart()
    {
        return $this->belongsTo(ProductSize::class);
    }
}

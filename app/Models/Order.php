<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Discount;
use App\Models\ShippingMethod;
use App\Models\CustomerInformation;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subtotal',
        'tax',
        'dis_id',
        'shi_id',
        'cus_id',
        "total"
    ];

    public function userOrder()
    {
        return $this->belongsTo(User::class);
    }

    public function discountOrder()
    {
        return $this->belongsTo(Discount::class);
    }

    public function shippingOrder()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function customerOrder()
    {
        return $this->belongsTo(CustomerInformation::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

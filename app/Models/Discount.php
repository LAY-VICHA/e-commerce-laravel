<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

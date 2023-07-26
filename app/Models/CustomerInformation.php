<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class CustomerInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'phonenumber',
        'country',
        'state',
        'zip',
        'address',
        'apt',
        'firstname',
        'lastname',
        'email',
    ];

    public function orders()
    {
        return $this->hasOne(Order::class);
    }
}

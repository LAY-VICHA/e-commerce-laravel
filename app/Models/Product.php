<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

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

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}

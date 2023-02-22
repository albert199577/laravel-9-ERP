<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_model extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'cost',
        'price',
        'stock',
        'cargo_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

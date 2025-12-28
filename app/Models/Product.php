<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- 1. ADD THIS IMPORT
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // <--- 2. ADD THIS INSIDE THE CLASS

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
        'quantity',
        'alert_level'
    ];

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
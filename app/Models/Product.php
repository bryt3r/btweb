<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'name',
        // 'description',
        // 'category',
        // 'condition',
        // 'brand',
        // 'model',
        // 'price',
        // 'is_listed',
    ];

    protected $casts = [
        'costprice' => 'decimal:2',
        'sellingprice' => 'decimal:2',
        'saleprice' => 'decimal:2'
    ];

    public function lister()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

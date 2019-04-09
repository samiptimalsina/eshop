<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $slug)
 * @method static orderBy(string $string, string $string1)
 */
class Product extends Model
{
    protected $fillable = ['name', 'slug', 'category_id', 'brand_id', 'description', 'price', 'image', 'size', 'color', 'status', 'featured'];

    public function orderDetails()
    {
        return $this->belongsTo(Order_detail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, $slug)
 */
class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'status'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}



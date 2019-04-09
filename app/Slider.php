<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 */
class Slider extends Model
{
    protected $fillable = ['name', 'description', 'image', 'status'];
}

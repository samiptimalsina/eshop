<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Review extends Model
{
    protected $fillable = ['product_id', 'user_id', 'review', 'rating', 'help_full', 'not_help_full'];

    function user(){
        return $this->belongsTo(User::class);
    }
}

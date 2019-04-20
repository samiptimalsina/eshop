<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static orderBy(string $string, string $string1)
 * @method static where()
 */
class Review extends Model
{
    protected $fillable = ['product_id', 'user_id', 'review', 'rating', 'help_full', 'not_help_full'];

    function user(){
        return $this->belongsTo(User::class);
    }

    function reviewVotes(){
        return $this->hasMany(Review_vote::class);
    }

    function helpFullVotes(){
        return $this->hasMany(Review_vote::class);

    }
}

<?php

namespace App;

use App\Events\ReviewCreated;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static orderBy(string $string, string $string1)
 * @method static where()
 * @method static orderByRaw(string $string, string $string1)
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

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ReviewCreated::class,
    ];
}

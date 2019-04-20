<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static withCount(array $array)
 */
class Review_vote extends Model
{
    protected $fillable = ['user_id', 'review_id', 'help_full'];
}

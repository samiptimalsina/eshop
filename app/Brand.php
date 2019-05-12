<?php

namespace App;

use App\Events\ReviewCreated;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, $slug)
 */
class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'status'];

    public function products(){
        return $this->hasMany(Product::class);
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

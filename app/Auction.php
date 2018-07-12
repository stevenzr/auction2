<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category', 'title', 'year', 'width', 'height', 'depth', 'description', 'condition', 'origin', 'artist', 'artwork_image_path', 'artwork_image', 'signature_image_path', 'optional_image_path', 'min_price', 'max_price', 'buyout_price', 'end_date',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function bids() {
        return $this->hasMany('App\Bid');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostAmenity extends Model
{
    protected $table = 'post_amenities';

    protected $fillable = ['post_id','amenity_id'];

    public $timestamps = false;

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function amenity(){
        return $this->belongsTo(Amenity::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $table='amenities';
    protected $fillable=['name'];

    public function posts(){
        return $this->belongsToMany(Post::class,'post_amenities');
    }


}

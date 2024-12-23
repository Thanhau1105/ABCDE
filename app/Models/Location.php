<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = ['address','link'];

    public $timestamps = false;

    public function posts(){
        return $this->hasMany(Post::class);
    }
}

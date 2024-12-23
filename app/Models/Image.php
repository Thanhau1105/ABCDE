<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='images';

    protected $fillable =['url','post_id'];

    public $timestamps = false;

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}

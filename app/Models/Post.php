<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';

    protected $fillable = [
        'approved', 'created_at', 'description', 'price', 'title', 'updated_at', 'location_id', 'user_id',
    ];

    protected  $casts =[
        'approved' => 'boolean',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

  // Model Post.php
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }

    public function listImages(){
        return $this->hasMany(Image::class,'post_id','id');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function amenities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Amenity::class,'post_amenities');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}

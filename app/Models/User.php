<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
   use Notifiable;
   protected $table = 'users';
   protected $fillable=['email','password','phone','full_name','role_id','full_name'];

   public function roles()
   {
       return $this->belongsTo(Role::class);
   }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

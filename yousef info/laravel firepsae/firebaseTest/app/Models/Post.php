<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table="posts";
    protected $fillable=['title','content','user_id'];
    protected $hidden=['created_at','updated_at'];

    public function user()
    {
       return $this->belongsto(User::class,'user_id');
    }

    public function comments()
    {
       return $this->hasMany(Comment::class,'post_id');
    }
}

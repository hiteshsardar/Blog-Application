<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    public function posts(){
        return $this->belongsToMany('App/Models/user/post', 'category_posts');
    }
}
<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Chapter extends Model
{
    use HasFactory;



    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function quizs()
    {
        return $this->belongsToMany('App\Models\Quiz','chapter_quiz');
    }

}

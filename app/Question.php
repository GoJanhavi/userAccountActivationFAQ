<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['body'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function answer(){
        return $this->hasMany('App\Answer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts() {
	    return $this->hasMany('App\Post');
	}

	public function user(){
		return $this->hasMany('App\User');
	}
}

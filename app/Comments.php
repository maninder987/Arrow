<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function replies() {
	    return $this->hasMany('App\Replies');
	}

	public function user(){
		return $this->belongsTo("App\User");
	}

	public function getCreatedAtAttribute($value){
		return $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
	}
}

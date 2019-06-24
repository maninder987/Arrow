<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class Post extends Model
{
    

	public function user(){
         return $this->belongsTo('App\User','author');
    }

    public function category() {
	    return $this->belongsTo('App\Category','category');
    }
    
    public function getCreatedAtAttribute($value){
		return $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
	}

}

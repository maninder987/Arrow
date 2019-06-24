<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    public function comment() {
	    return $this->belongsTo('App\Comments');
	}
}

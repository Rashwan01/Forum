<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    protected  static function boot(){
		parent::boot();
		static::creating(function($reply){
			$reply->user_id = auth()->id();
		});
	}
	public function user(){

		return $this->belongsTo(User::class);
	}
	public function question(){

		return $this->belongsTo(question::class);
	}
	public function like(){

		return $this->hasMany(Like::class);
	}

}

<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
	protected $fillable = ["title","slug","body","user_id","category_id"];

	protected  static function boot(){

		parent::boot();
		static::creating(function($question){
			$question->slug = Str::slug($question->title,"-");
		});
	}
	public function getRouteKeyName()
	{
		return "slug";
	}
	public function user(){
		return $this->belongsTo(User::class);

	}
	public function replies(){

		return $this->hasMany(Reply::class,"question_id");
	}
	public function category(){

		return $this->belongsTo(Category::class);
	}
	public function getPathAttribute(){

		return "question/$this->slug";
	}
}

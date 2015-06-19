<?php namespace App;
trait Taggable{
	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}
}
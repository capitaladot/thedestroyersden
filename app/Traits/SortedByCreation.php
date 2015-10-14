<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
trait SortedByCreation{
	public static function apply(Builder $builder){
		return $builder->sortBy('created_at');
	}
}

?>
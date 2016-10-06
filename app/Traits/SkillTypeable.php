<?php
namespace App\Traits;
trait SkillTypeable{
	public function skillType(){
		return $this->belongsTo('App\SkillType');
	}
	public function newQuery($excludeDeleted = true)
	{
		if(count($this->skillType))
			return parent::newQuery()->whereSkillTypeId($this->skillType->id);
		return parent::newQuery();
	}
}

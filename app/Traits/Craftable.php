<?php

namespace App\Traits;
use App\CraftingOccurrence;

/**
 * An item is craftable if it can be produced by a crafting technique.
 *
 * @author U53456
 *        
 */
trait Craftable
{
	public function craft(Craft $craft,$providedRequisites = [],PlayerCharacter $crafter = null, Item $producedComponent)
	{
		$craftingOccurrence = new CraftingOccurrence;
		foreach ($producedComponent->requisites() as $eachRequisite) {
			foreach ($providedRequisites as $eachProvidedRequisite) {
			}
		}
	}
	/**
	 * the crafts with which an Item with the Craftable trait may be produced.
	 */
	public function getCrafts()
	{
		$crafts = collect();
		foreach($this->requirements() as $craftingRequirement)
			$crafts[$craftingRequirement->title] = $craftingRequirement->crafts();
		return $crafts;
	}


	/**
	 */
	public function craftingOccurrence()
	{
		return $this->belongsToMany('App\CraftingOccurrence');
	}

	public function craftingComponents()
	{
		return $this->morphedByMany('App\CraftingComponent', 'requirable', 'requirements', 'requirable_id');
	}

	public function rawResources()
	{
		return $this->morphedByMany('App\RawResource', 'requirable', 'requirements', 'requirable_id');
	}

	public function tools()
	{
		return $this->morphedByMany('App\Tool', 'requirable', 'requirements', 'reguirable_id');
	}
}

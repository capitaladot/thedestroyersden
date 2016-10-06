<?php
namespace App\Traits;

use App\ItemType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
trait ItemTypeable{
	public function itemType(){
		return $this->belongsTo('App\ItemType');
	}
	public function newQuery($excludeDeleted = true){
		$itemTypeTitle = class_basename(self::class);
		try{
			$itemType = ItemType::where('title',$itemTypeTitle)->firstOrFail();
		}
		catch(ModelNotFoundException $mnfe){
			\ddd($itemTypeTitle ." not found.");
		}
		catch(NotFoundHttpException $nfhe){
			\ddd($itemTypeTitle ." not found.");
		}
		return parent::newQuery($excludeDeleted)->where('item_type_id',$itemType->id);
	}
}

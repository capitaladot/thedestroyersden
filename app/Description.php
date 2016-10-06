<?php 

namespace App;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
//traits
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\RoutedById;
use Sleimanx2\Plastic\Searchable;

class Description extends BaseModel implements FillableContract, NavigatableContract, RelatableContract{
	use Fillable;
	use RoutedById;
	use Relatable;
	use Searchable;
	public $appends = ['syncDocument','title'];
	public $fillable = ['body'];
	public function getSyncDocumentAttribute(){
		return $this->syncDocument;
	}
	public function setSyncDocumentAttribute($syncDocument){
		$this->syncDocument = $syncDocument;
	}
	public function buildDocument()
	{
		return [
			'id'=> $this->id,
			'body'=>$this->body,
			'title'=>$this->getTitle()
		];
	}
	public function getTitle(){
		return $this->describable->getTitle()." ".studly_case(class_basename($this->describable_type))." Description";
	}
	public function getTitleAttribute(){
		return $this->getTitle();
	}
	//relations
	public function describable(){
		return $this->morphTo();
	}
}

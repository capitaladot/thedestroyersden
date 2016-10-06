<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\DB;
use Log;
use Psy\Exception\ErrorException;
use SortedByCreation;
use App\Contracts\RelatableContract;


abstract class BaseModel extends Model implements RelatableContract {
	const READABLE_DATE = "F j, Y, g:i a T";
	public $hidden = [
			'relationMethods',
			'processedFillables',
			'relatedModels',
			'level',
			'slug'
	];
	public $validator;
	public $validatorRules = [ ];
	public $validatorValues = [ ];
	public $relatedModels = [ ];
	public $relationControls = [ ];
	public $relationMethods = [ ];
	public $processedFillables = [];
	protected $table;
	protected $touches = [ ];

	/**
	 * BaseModel constructor.
	 * @param array $attributes
	 */
	public function __construct(array $attributes = []) {
		parent::__construct($attributes);
		foreach ( $attributes as $key => $value ){
			//Log::debug('Setting '.$key,[$value]);
			$this->setAttribute ( $key, $value );
		}
		/* manually set table name for each subclass */
		if(empty($this->table))
			$this->table = snake_case ( class_basename ( str_plural ( get_class ( $this ) ) ) );
	}
	public function properName() {
		return ucwords ( str_replace ( '_', ' ', snake_case ( $this->baseUrl() ) ) );
	}
	public function pluralName(){
		return str_plural ( $this->properName());
	}
	/**@desc Produces basic route url segment.
	 * @return string
	 */
	public static function baseUrl(){
		return str_slug(class_basename(get_called_class()));
	}
	public function permission($permissionType){
		return $permissionType.".".strtolower(str_singular($this->getTable()));
	}
	public function getTable(){
		return $this->table;
	}
	/**
	 * @param $traitName string
	 * @return bool
	 */
	public static function hasTrait($traitName){
		return FALSE !== array_search($traitName, class_uses (get_called_class(),false));
	}

	/**
	 * @param $interfaceName
	 * @return bool
	 */
	public static function implementsInterface($interfaceName){
		return FALSE !== array_search($interfaceName, get_declared_interfaces());
	}
	//scopes
	public function newQuery($excludeDeleted = true){
		$query = parent::newQuery();
		if($this->hasTrait('Illuminate\Database\Eloquent\SoftDeletingTrait') && $excludeDeleted === true) {
			$query->where('deleted_at', '=', 0);
		}
		$attributes = $this->getAttributes();
		if($this->hasTrait('App\Traits\Navigatable') && isset($attributes['title'])) {
			$query->orderBy($this->table . '.title', 'ASC');
		}
		return $query;
	}
}

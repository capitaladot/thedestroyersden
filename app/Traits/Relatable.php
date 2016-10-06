<?php
namespace App\Traits;


use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Log;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
trait Relatable{
	public static function bootRelatable(){
	}

	/**
	 * @param $relationMethod
	 * @return Collection
	 */
	public function collectSelections($relationMethod) {
		$selected = $this->$relationMethod;
		if (is_null ( $selected ))
			return new Collection ();
		elseif (! ($selected instanceof Collection)) {
			//Log::debug("[".get_called_class()."]".'Selected',(array)$selected);
			$selected = new Collection ( [
				$selected
			] );
		}
		return $selected;
	}

	/**
	 * @param $relatedModel
	 * @param $selected
	 * @return mixed
	 */
	public function setSelectedOptions(Array $relatedModel,$selected){
		if (count ( $selected ) > 0) {
			//Log::debug ("[".get_called_class()."]". 'Selected', $selected->toArray () );
			foreach ( $selected as $eachSelection ) {
				if ($eachSelection->getAttribute ( 'title' )) {
					$relatedModel ['selected'] [$eachSelection->id] = $eachSelection->getAttribute ( 'title' );
				} else {
					$relatedModel ['selected'] [$eachSelection->id] = $eachSelection->id;
				}
				$relatedModel ['options'] [$eachSelection->id] ['checked'] = true;
			}
		}
		return $relatedModel;
	}

	/**
	 * @param Model $option
	 * @param array $attributes
	 * @return array
	 */
	public function attachAttributesToOptions(Model $option, $attributes = []){
		$optionArray= [
			'label'=>str_singular(studly_case(str_replace("_"," ",$option->table))),
			'value' => $option->id,
			'checked' => false,
			'attributes' => $attributes
		];
		if(method_exists($option,"getTitle")){
			$optionArray['title' ] = $option->getTitle();
		}
		elseif (isset ( $option->attributes ['title'] )) {
			$optionArray['title' ] = $option->attributes ['title'];
		}
		return $optionArray;
	}

	/**
	 * @param array $relatedModel
	 * @return array
	 */
	public function attachColumnData($relatedModel = []){
		$column = DB::connection ()->getDoctrineColumn ( $this->table, $relatedModel['columnName'] );
		$relatedModel ['maxLength'] = $column->getLength ();
		$relatedModel ['notNull'] = $column->getNotnull ();
		return $relatedModel;
	}

	/**
	 * @param $namespacedClassname string
	 * @param $relationMethod
	 * @param $relatedModel
	 * @return mixed
	 */
	public function attachOptionsAndSelections($namespacedClassName,$relationMethod,$relatedModel){
		try{
			foreach ( $namespacedClassName::all() as $eachOption ) {
				$attributes = $eachOption->attributesToArray ();
				$options[$eachOption->id] = $this->attachAttributesToOptions($eachOption,$attributes);
			}
		}
		catch(\ErrorException $ee){
			Log::critical($namespacedClassName. " could not be instantiated.". $ee->getMessage());
		}
		$options[0] = ['title'=>'None','value'=>'','checked'=>false];
		ksort($options);
		$relatedModel ['options'] = $options;
		$selected = $this->collectSelections ( $relationMethod );
		$relatedModel = $this->setSelectedOptions($relatedModel,$selected);
		return $relatedModel;
	}
	/**
	 * @param $className
	 * @param $relationMethod
	 * @param $foreignKey
	 * @throws ErrorException
	 * @desc attach the relatedModels array, to be used in form generation.
	 * @return bool

	 */
	public function relateBelongsTo($className,$relationMethod,$foreignKey){
		$relatedModel = [
			'label' => ucwords ( str_replace ( "_", " ", snake_case ( $relationMethod ) ) ),
			'namespaced' => $className
		];
		/* must strictly follow Eloquent convention, or no dice. */
		if(class_exists($className)){
			$relatedModel = $this->attachOptionsAndSelections($className, $relationMethod, $relatedModel);
			$columns = DB::connection ()->getDoctrineSchemaManager ()->listTableColumns ( $this->table );
			if (isset ( $columns [$foreignKey] )) {
				$relatedModel ['columnName'] = $foreignKey;
				$relatedModel = $this->attachColumnData($relatedModel);
				$this->unsetProcessedFillable([$foreignKey]);
				$this->relationControls [$relationMethod] = $relatedModel;
			}
			$this->relatedModels [] = $className;
		}
		else {
			Log::critical("Called for related class, '"
				.$className. "', that does not exist.");
		}
		return $this;
	}

	/**
	 * @param $relationMethod
	 * @param $className
	 */
	public function relateMorph($relationMethod,$className){
		$relatedModel = [
			'label' => ucwords ( str_replace ( "_", " ", snake_case ( $relationMethod ) ) ),
			'namespaced' => $className
		];
		$relatedModel = $this->attachOptionsAndSelections($className, $relationMethod, $relatedModel);
		$this->relationControls [$relationMethod] = $relatedModel;
		return $this;
	}
	/**
	 *
	 */
	public function provideRelatables() {
		//Log::debug("[".get_called_class()."]"."Providing relateables for ".count($this->relationMethods)." relation methods.",$this->relationMethods);
		foreach ( $this->relationMethods as $relationKey => $relationMethod ) {
			if(method_exists($this,$relationMethod)){
				$className = get_class($this->$relationMethod()->getRelated());
				if($className == get_called_class() && method_exists($this->$relationMethod(),"getMorphClass"))
					$className = $this->$relationMethod()->getMorphClass();
				$foreignKey = $this->$relationMethod()->getForeignKey();
				//Log::debug("[".get_called_class()."]"."Providing relateables for ".$className ."; foreign key? ".$foreignKey);
				if(get_class($this->$relationMethod()) == BelongsTo::class){
					//Log::debug("[".get_called_class()."]".$foreignKey." belongs to ".get_called_class());
					$this->relateBelongsTo($className,$relationMethod,$foreignKey);
				}
				else if(in_array(get_class($this->$relationMethod()),[
					MorphMany::class,
					MorphTo::class,
					MorphOneOrMany::class,
					MorphToMany::class
				])) {
					$this->relateMorph($relationMethod,$className);
				}
			}
			else Log::error("Could not provide relatable; method '".$relationMethod."' did not exist.");
		}
		$this->relationMethods = collect($this->relationMethods);
		return $this;
	}
	/**
	 * @desc add validation rules for the foreign keys on the table.
	 * @param array $data
	 */
	public function attachRequiredRelations($data = []) {
		if(empty($this->relationControls))
			$this->provideRelatables();
		//Log::debug("[".get_called_class()."]"."Relation Controls Count: ".count($this->relationControls),$data);
		foreach ( $this->relationControls as $relationMethod => $properties ) {
			//Log::debug("[".get_called_class()."]".$relationMethod .' attaching required relation "'.$relationMethod);
			//\ddd($properties);
			if(!is_array($properties)){
				Log::error("[".get_called_class()."]".'Error in attaching required relations; malformed relation control!',$properties);
				return false;
			}
			elseif ((in_array(get_class($this->$relationMethod()),[HasOne::class]) && isset ( $properties ['columnName'] ) && $data[ $properties ['columnName'] ])){
				//Log::debug("[" . get_called_class() . "]" . "Setting " . $properties['columnName'] . " on " . $properties['namespaced']);
				$associatedModel = $properties ['namespaced']::find($data[$properties ['columnName']]);
				//Log::debug("[" . get_called_class() . "]" . $properties ['columnName'] . ' associated.');
				$this->$relationMethod ()->save($associatedModel);
			}
			elseif(in_array(get_class($this->$relationMethod()),[BelongsTo::class])){
				//Log::debug("[" . get_called_class() . "]->".$relationMethod." ".get_class($this->$relationMethod())."==".BelongsTo::class);
				//Log::debug("[" . get_called_class() . "]" . "Setting " . $properties['columnName'] . " on " . $properties['namespaced']);
				$associatedModel = $properties ['namespaced']::find($data[$properties ['columnName']]);
				$this->$relationMethod()->associate($associatedModel);
				$this->save();
			}
			else if(in_array(get_class($this->$relationMethod()),[
				MorphMany::class,
				MorphTo::class,
				MorphOneOrMany::class,
				MorphToMany::class
			])){
				//\ddd($data);
				if (is_array($data) && isset($data[$relationMethod])) {
					if(is_array($data[$relationMethod])){
						$objects = [];
						foreach($data[$relationMethod] as $eachRelatedId)
							$objects[] = $properties ['namespaced']::findOrFail((int)$eachRelatedId);
						 $this->$relationMethod()->saveMany($objects);
					}
					else {
						$this->$relationMethod()->saveMany([$properties ['namespaced']::findOrFail((int)$data[$relationMethod])]);
					}
				}
				elseif(!empty($data->$relationMethod)) {
					$this->$relationMethod()->saveMany([$properties ['namespaced']::findOrFail((int)$data->$relationMethod)]);
				}
			}
			else {
				//Log::debug("[".get_called_class()."]".$properties ['columnName'] .' was absent from input.');
			}
		}
		return true;
	}
}

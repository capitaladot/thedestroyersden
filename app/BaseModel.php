<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\MainMenu;
use App\MainMenuItem;
use Log;
use Psy\Exception\ErrorException;
use SortedByCreation;
use App\Contracts\RelatableContract;


class BaseModel extends Model implements RelatableContract {
	protected $hidden = [ 
			'relationMethods',
			'processedFillables',
			'relatedModels' 
	];
	public $validator;
	public $validatorRules = [ ];
	public $validatorValues = [ ];
	public $processedFillables = [ ];
	public $relatedModels = [ ];
	public $relationControls = [ ];
	public $relationMethods = [ ];
	protected $table;
	protected $touches = [ ];
	public $traits = [ ];

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
		
		/* put public variables from traits into the fillable array */
		$fillables = DB::connection ()->getDoctrineSchemaManager ()->listTableColumns ( $this->table );
		/* except those that are foreign keys */
		$hidables = [ ];
		$filteredFillables = [ ];
		foreach ( $fillables as $fillable ) {
			$name = $fillable->getName ();
			if ($name == 'facebook_id' || $name == 'id' || ends_with ( $name, '_at' )) {
				// don't mess with id or dates.
			} elseif (ends_with ( $name, '_id' )) {
				$hidables [] = $name;
			} elseif (ends_with ( $name, 'able_type' )) {
				$hidables [] = $name;
			} else {
				$filteredFillables [] = $name;
			}
		}
		$newFillable = array_merge ( $this->getFillable (), $filteredFillables );
		$this->fillable ( $newFillable );
		$this->traits = class_uses (get_class($this),false);
		$hidables = array_merge ( $hidables, [ 
			'slug',
			'relationMethods',
			'traits',
			'filteredFillables',
			'schemaManager',
			'relatedModels' 
		] );
		$hidables = array_merge ( $hidables, $this->getHidden () );
		$this->setHidden ( $hidables );
	}
	public function collectSelections($relationMethod) {
		$selected = $this->$relationMethod;
		if (is_null ( $selected ))
			return new Collection ();
		elseif (! ($selected instanceof Collection)) {
			Log::debug('Selected',(array)$selected);
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
	protected function setSelectedOptions(Array $relatedModel,$selected){
		if (count ( $selected ) > 0) {
			Log::info ( 'Selected', $selected->toArray () );
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
	 * @param BaseModel $option
	 * @param array $attributes
	 * @return BaseModel
	 */
	protected function attachAttributes(BaseModel $option, $attributes = []){
		if (isset ( $option->attributes ['title'] )) {
			$optionArray= [
				'label'=>str_singular(studly_case(str_replace("_"," ",$option->table))),
				'value' => $option->id,
				'title' => $option->attributes ['title'],
				'checked' => false,
				'attributes' => $attributes
			];
		} else {
			$optionArray = [
				'label'=>str_singular(studly_case(str_replace("_"," ",$option->table))),
				'value' => $option->id,
				'checked' => false,
				'attributes' => $attributes
			];
		}
		return $optionArray;
	}

	/**
	 * @param array $relatedModel
	 * @return array
	 */
	protected function attachColumnData($relatedModel = []){
		$column = DB::connection ()->getDoctrineColumn ( $this->table, $relatedModel['columnName'] );
		$relatedModel ['maxLength'] = $column->getLength ();
		$relatedModel ['notNull'] = $column->getNotnull ();
		return $relatedModel;
	}

	/**
	 * @param $namespaceClassname
	 * @param $relationMethod
	 * @param $relatedModel
	 * @return mixed
	 */
	protected function attachOptionsAndSelections($namespacedClassName,$relationMethod,$relatedModel){
		try{
			foreach ( $namespacedClassName::all() as $eachOption ) {
				$attributes = $eachOption->attributesToArray ();
				$options[$eachOption->id] = $this->attachAttributes($eachOption,$attributes);
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
	 * @param $namespacedClassName
	 * @param $relationMethod
	 * @param $foreignKey
	 * @throws ErrorException

	 * @return bool

	 */
	protected function relateBelongsTo($namespacedClassName,$relationMethod,$foreignKey){
		$relatedModel = [
			'label' => ucwords ( str_replace ( "_", " ", snake_case ( $relationMethod ) ) ),
			'namespaced' => $namespacedClassName
		];
		/* must strictly follow Eloquent convention, or no dice. */
		$options = [ ];
		if(class_exists($namespacedClassName)){
			$relatedModel = $this->attachOptionsAndSelections($namespacedClassName, $relationMethod, $relatedModel);
			$columns = DB::connection ()->getDoctrineSchemaManager ()->listTableColumns ( $this->table );
			if (isset ( $columns [$foreignKey] )) {
				$relatedModel ['columnName'] = $foreignKey;
				$relatedModel = $this->attachColumnData($relatedModel);
				unset ( $this->processedFillables [$foreignKey] );
				$this->relationControls [$relationMethod] = $relatedModel;
			}
			$this->relatedModels [] = $namespacedClassName;
		}
		else {
			throw new ErrorException("Called for related class, '"
				.$namespacedClassName. "', that does not exist.");
		}
		return $this;
	}

	/**
	 * @param $relationMethod
	 * @param $namespacedClassName
	 */
	protected function relateMorphMany($relationMethod,$namespacedClassName){
		$relatedModel = [
			'label' => ucwords ( str_replace ( "_", " ", snake_case ( $relationMethod ) ) ),
			'namespaced' => $namespacedClassName
		];
		$relatedModel = $this->attachOptionsAndSelections($namespacedClassName, $relationMethod, $relatedModel);
		$this->relationControls [$relationMethod] = $relatedModel;
		return $this;
	}
	/**
	 * attach the relatedModels array, to be used in form generation.
	 */
	public function provideRelatables() {
		foreach ( $this->relationMethods as $relationKey => $relationMethod ) {
			if(method_exists($this,$relationMethod)){
				$className = str_singular ( studly_case ( $relationMethod ) );
				$foreignKey = snake_case ( str_singular ( $relationMethod ) ) . '_id';
				if(isset($this->$foreignKey)){
					if (is_numeric ( $relationKey )) {
						$namespacedClassName = 'App\\' . $className;
					} else {
						$namespacedClassName = 'App\\' . $relationKey;
					}
					$this->relateBelongsTo($namespacedClassName,$relationMethod,$foreignKey);
				}
				else if($this->$relationMethod() instanceof MorphMany) {
					$namespacedClassName = 'App\\' . $className;
					$this->relateMorphMany($relationMethod,$namespacedClassName);
				}
			}
		}
		return $this;
	}
	/**
	 * @desc add validation rules for the foreign keys on the table.
	 * @param array $data
	 */
	public function attachRequiredRelations($data = []) {
		foreach ( $this->relationControls as $relationMethod => $properties ) {
			/* deal with properties local to this object. */
			if (isset ( $properties ['columnName'] ) && $data[ $properties ['columnName'] ]) {
				$associatedModel = $properties ['namespaced']::find ( $data[ $properties ['columnName'] ] );
				$this->$relationMethod ()->associate ( $associatedModel );
				Log::debug($properties ['columnName'] .' associated.');
			} elseif(!is_array($properties)){
				Log::error('Error in attaching required relations; malformed relation control!',$properties);
			}elseif($this->$relationMethod() instanceof MorphMany){
				$this->$relationMethod()->saveMany([$properties ['namespaced']::findOrFail((int)$data->$relationMethod)]);
			}else {
				Log::debug($properties ['columnName'] .' was absent from input.');
			}
		}
	}
	/**
	 * @desc add validation rules and bind variables for fillables.
	 * @param Request $data)
	 */
	function validateFillables($data = []){
		$this->getProcessedFillables ();
		$this->provideRelatables ();
		Log::debug('Validating request',$data);
		Log::debug('Validating fillables',$this->processedFillables);
		foreach ( $this->processedFillables as $input => $properties ) {
			/* perform processing for special input types */
			$pipeSeparatedInputName = str_replace ( '.', '_', $input );
			if ($properties['inputType'] == 'datetime') {
				$processedDate = strtotime($data[ $pipeSeparatedInputName ]);
				if($processedDate)
					$this->validatorValues [$input] = $processedDate;
				else
					Log::error('Failed to date parse',[$pipeSeparatedInputName => $data[ $pipeSeparatedInputName ]]);
			} 
			else {
				$this->validatorValues [$input] = $data[ $pipeSeparatedInputName ];
			}
			Log::debug('Validator value ',[$input => $data[ $pipeSeparatedInputName ] ]);
			/* set date validator rule for datetimes */
			if($input == 'timezone')
				$this->validatorRules [$input] [] = 'timezone';
			if ($properties ['inputType'] == 'datetime') {
				$this->validatorRules [$input] [] = 'digits:10';
			}
			/* require non-nullable fields */
			if ($properties ['notNull']) {
				$this->validatorRules [$input] [] = 'required';
			}
			if ($properties ['maxLength']) {
				$this->validatorRules [$input] [] = 'max:' . $properties ['maxLength'];
			}
			/* join accumulated rules with pipe separator */
			if (! empty ( $this->validatorRules [$input] ))
				$this->validatorRules [$input] = implode ( '|', $this->validatorRules [$input] );
		}
	}

	/**
	 * @param array $data
	 */
	function attachValidatedValues($data = []) {
		/* while not ideal, forceFill is the only way to use attributes that are dynamically added by Traits. */
		Log::debug('Attaching validated values',$this->validatorValues);
		$this->fill ( $this->validatorValues );
		$this->attachRequiredRelations ( $data );
	}
	/**
	 *
	 * @param array $data
	 * @return bool
	 */
	function validate($data = []) {
		$this->validateFillables ( $data );
		$this->validator = Validator::make ( $this->validatorValues, $this->validatorRules );
		if ($this->validator->passes ()) {
			Log::debug('Validated',[$this]);
			$this->attachValidatedValues ( $data );
			return true;
		}
		Log::debug('Validator failed with',$this->validator->errors()->all());
		return false;
		
	}
//scopes
	public function newQuery($excludeDeleted = true){
		$query = parent::newQuery();
		if(false !== (array_search('Illuminate\Database\Eloquent\SoftDeletingTrait', $this->traits)) && $excludeDeleted === true) {
			$query->where('deleted_at', '=', 0);
		}
		if(false !== (array_search('App\Traits\Navigatable', $this->traits))) {
			$query->orderBy($this->table . '.title', 'ASC');
		}
		return $query;
	}
}

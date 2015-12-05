<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\MainMenu;
use App\MainMenuItem;
use App\Observers\BaseModelObserver;
use Log;
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
	private $schemaManager;
	protected $table;
	protected $touches = [ ];
	protected $traits = [ ];
	public function __construct(array $attributes = []) {
		if (get_parent_class ( $this ) == 'App\\BaseModel' && get_parent_class ( $this ) !=  get_class ( $this )) {
			$this->schemaManager = DB::connection ()->getDoctrineSchemaManager ();
			foreach ( $attributes as $key => $value ){
				Log::debug('Setting '.$key,[$value]);
				$this->setAttribute ( $key, $value );
			}
			/* manually set table name for each subclass */
			if(empty($this->table))
				$this->table = snake_case ( class_basename ( str_plural ( get_class ( $this ) ) ) );
			
			/* put public variables from traits into the fillable array */
			$fillables = $this->schemaManager->listTableColumns ( $this->table );
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
		parent::__construct($attributes);
	}
	public static function isNavigable($modelInstance) {
		return ! (empty ( $modelInstance->slug ) || empty ( $modelInstance->title ));
	}
	/**
	 *
	 * set slug and/or title, and if necessary, create MenuItems.
	 *
	 * @param BaseModel $modelInstance        	
	 */
	public static function fixNavigability(BaseModel $modelInstance) {
		Log::info ( 'Fixing navigability for', [ 
			$modelInstance 
		] );
		if (!empty($modelInstance->name) && empty ( $modelInstance->slug )) {
			$modelInstance->slug = str_slug ( $modelInstance->name );
		}
		if (!empty($modelInstance->name) && empty ( $modelInstance->title )) {
			$modelInstance->title = $modelInstance->name;
		}
		if (!empty($modelInstance->title) && empty ( $modelInstance->slug )) {
			$modelInstance->slug = str_slug ( $modelInstance->title );
		}
	}
	/**
	 *
	 * @param BaseModel $modelInstance        	
	 */
	public static function provideNavigatable(BaseModel $modelInstance) {
		Log::debug('Providing navigatable.');
		$basename = class_basename ( $modelInstance );
		$menu = MainMenu::all ()->where ( 'name', $basename )->first ();
		if (! $menu) {
			$menu = MainMenu::create ( [ 
					'name' => $basename 
			] );
			$menu->save ();
		}
		$menuItems = MainMenuItem::with('menu')->get ()->filter(function($eachMenuItem)use($basename,$menu,$modelInstance){
			return 
				$eachMenuItem->menu->id == $menu->id
					&&
				$eachMenuItem->navigatable_type == $basename
					&&
				$eachMenuItem->navigatable_id = $modelInstance->id;
		});
		if (! count($menuItems) ){
			Log::debug ( 'Creating MenuItem for ', ['model'=>$modelInstance,'basename'=>$basename] );
			try{
				$newItem = new MainMenuItem( ['menu_id' => $menu->id]);
				$newItem->navigatable()->associate($modelInstance);
				$newItem->save();
			}
			catch(\QueryException $qe){
				Log::debug ( 'MenuItem already extant? ', ['model'=>$modelInstance,'menuItems'=>$menuItems] );
			}
		}
		return count($menuItems) ? $menuItems->first() : $newItem;
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
	 * attach the relatedModels array, to be used in form generation.
	 */
	public function provideRelatables() {
		$columns = $this->schemaManager->listTableColumns ( $this->table );
		foreach ( $this->relationMethods as $relationKey => $relationMethod ) {
			if (is_numeric ( $relationKey )) {
				$entity = str_singular ( studly_case ( $relationMethod ) );
				$namespacedClassName = 'App\\' . $entity;
				$repositoryName = 'App\\Repositories\\' . $entity . 'Repository';
			} else {
				$namespacedClassName = 'App\\' . $relationKey;
				$repositoryName = 'App\\Repositories\\' . $relationKey . 'Repository';
			}
			$relatedModel = [ 
				'label' => ucwords ( str_replace ( "_", " ", snake_case ( $relationMethod ) ) ),
				'namespaced' => $namespacedClassName 
			];
			/* must strictly follow Eloquent convention, or no dice. */
			$foreignKey = snake_case ( str_singular ( $relationMethod ) ) . '_id';
			$options = [ ];
			if(class_exists($namespacedClassName)){
				foreach ( $namespacedClassName::all () as $eachOption ) {
					$attributes = $eachOption->attributesToArray ();
					if (isset ( $eachOption->attributes ['title'] )) {
						$options [$eachOption->id] = [ 
							'value' => $eachOption->id,
							'title' => $eachOption->attributes ['title'],
							'checked' => false,
							'attributes' => $attributes 
						];
					} else {
						$options [$eachOption->id] = [ 
							'value' => $eachOption->id,
							'checked' => false,
							'attributes' => $attributes 
						];
					}
				}
				if (! empty ( $options )) {
					$relatedModel ['options'] = $options;
					$selected = $this->collectSelections ( $relationMethod );
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
				}
				if (isset ( $columns [$foreignKey] )) {
					$relatedModel ['columnName'] = $foreignKey;
					$column = DB::connection ()->getDoctrineColumn ( $this->table, $foreignKey );
					$relatedModel ['maxLength'] = $column->getLength ();
					$relatedModel ['notNull'] = $column->getNotnull ();
					unset ( $this->processedFillables [$foreignKey] );
					$this->relationControls [$relationMethod] = $relatedModel;
				}
				$this->relatedModels [] = $namespacedClassName;
			}
		}
		return $this;
	}
	/**
	 * add validation rules for the foreign keys on the table.
	 */
	public function attachRequiredRelations($request) {
		foreach ( $this->relationControls as $relationMethod => $properties ) {
			/* deal with properties local to this object. */
			if (isset ( $properties ['columnName'] ) && $request[ $properties ['columnName'] ]) {
				$associatedModel = $properties ['namespaced']::find ( $request[ $properties ['columnName'] ] );
				$this->$relationMethod ()->associate ( $associatedModel );
				Log::debug($properties ['columnName'] .' associated.');
			} elseif(!is_array($properties)){
				Log::error('Error in attaching required relations; malformed relation control!',$properties);
			}elseif(!isset ( $properties ['columnName'] )){
				Log::error('Error in attaching required relations; no column name present!',$properties);
			}else {
				Log::debug($properties ['columnName'] .' was absent from input.');
			}
		}
	}
	/*
	 * @desc add validation rules and bind variables for fillables.
	 * @param Request $request
	 */
	function validateFillables( $request) {
		$this->getProcessedFillables ();
		$this->provideRelatables ();
		Log::debug('Validating request',$request);
		Log::debug('Validating fillables',$this->processedFillables);
		foreach ( $this->processedFillables as $input => $properties ) {
			/* perform processing for special input types */
			$pipeSeparatedInputName = str_replace ( '.', '_', $input );
			if ($properties['inputType'] == 'datetime') {
				$processedDate = strtotime($request[ $pipeSeparatedInputName ]);
				if($processedDate)
					$this->validatorValues [$input] = $processedDate;
				else
					Log::error('Failed to date parse',[$pipeSeparatedInputName => $request[ $pipeSeparatedInputName ]]);
			} 
			else {
				$this->validatorValues [$input] = $request[ $pipeSeparatedInputName ];
			}
			Log::debug('Validator value ',[$input => $request[ $pipeSeparatedInputName ] ]);
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
	function attachValidatedValues($request) {
		/* while not ideal, forceFill is the only way to use attributes that are dynamically added by Traits. */
		Log::debug('Attaching validated values',$this->validatorValues);
		$this->fill ( $this->validatorValues );
		$this->attachRequiredRelations ( $request );
	}
	/**
	 *
	 * @param Request $request        	
	 */
	function validate($request) {
		$this->validateFillables ( $request );
		$this->validator = Validator::make ( $this->validatorValues, $this->validatorRules );
		if ($this->validator->passes ()) {
			Log::debug('Validated',[$this]);
			$this->attachValidatedValues ( $request );
			return true;
		}
		Log::debug('Validator failed with',$this->validator->errors()->all());
		return false;
		
	}
}
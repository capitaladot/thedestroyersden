<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facade as Debugbar;
use MartinBean\MenuBuilder\Menu;
use MartinBean\MenuBuilder\MenuItem;
use App\Observers\BaseModelObserver;

abstract class BaseModel extends Model {
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
		if (get_parent_class ( $this ) == 'App\\BaseModel') {
			foreach ( $attributes as $key => $value )
				$this->setAttribute ( $key, $value );
				/* manually set table name for each subclass */
			$this->table = snake_case ( class_basename ( str_plural ( get_class ( $this ) ) ) );
			$this->schemaManager = DB::connection ()->getDoctrineSchemaManager ();
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
			$this->traits = class_uses (get_class($this),false);
			if (in_array ( 'App\\Traits\\Navigatable', $this->traits )) {
				static::creating ( function ($modelInstance) {
					logger ( 'Creating ' . self::class, [ 
							$modelInstance 
					] );
					try {
						$wasNotNavigable = ! self::isNavigable ( $modelInstance );
						if ($wasNotNavigable) {
							$id = self::fixNavigability ( $modelInstance );
							$modelInstance = $modelInstance::findOrFail ( $id );
						}
					} catch ( Exception $e ) {
						logger ( "exception creating", [ 
								$e 
						] );
					}
					return true;
				} );
				static::created ( function ($modelInstance) {
					logger ( 'Created ' . self::class, [ 
							$modelInstance 
					] );
				} );
				static::updating ( function ($modelInstance) {
					logger ( 'Updating ' . self::class, [ 
							$modelInstance 
					] );
					$wasNotNavigable = ! self::isNavigable ( $modelInstance );
					if ($wasNotNavigable)
						self::fixNavigability ( $modelInstance );
				} );
				static::updated ( function ($modelInstance) {
					logger ( 'Updated ' . self::class, [ 
							$modelInstance 
					] );
				} );
				static::saved ( function ($modelInstance) {
					logger ( 'Saving ' . self::class, [ 
							$modelInstance 
					] );
				} );
				static::saved ( function ($modelInstance) {
					logger ( 'Saved ' . self::class, [ 
							$modelInstance 
					] );
				} );
			}
		}
	}
	public static function isNavigable($modelInstance) {
		return ! (empty ( $modelInstance->slug ) || empty ( $modelInstance->title ) || ! count ( $modelInstance->menuItem ));
	}
	/**
	 *
	 * set slug and/or title, and if necessary, create MenuItems.
	 *
	 * @param BaseModel $modelInstance        	
	 */
	public static function fixNavigability(BaseModel $modelInstance) {
		logger ( 'Fixing navigability for', [ 
				$modelInstance 
		] );
		if (empty ( $modelInstance->slug )) {
			$modelInstance->slug = str_slug ( $modelInstance->name );
		}
		if (empty ( $modelInstance->title )) {
			$modelInstance->title = $modelInstance->name;
		}
		self::provideNavigatable ( $modelInstance );
		if (! empty ( $modelInstance->id )) {
			$updated = DB::table ( $modelInstance->getTable () )->where ( 'id', $modelInstance->id )->update ( $modelInstance->attributesToArray () );
			if ($updated)
				return $modelInstance->id;
			else
				logger ( 'Failed Updating ' . self::class . ' ' . $modelInstance->id );
		} else if (! empty ( $modelInstance->facebook_id )) {
			if (DB::table ( $modelInstance->getTable () )->where ( 'facebook_id', $modelInstance->facebook_id )) {
				$updated = DB::table ( $modelInstance->getTable () )->where ( 'facebook_id', $modelInstance->facebook_id )->update ( $modelInstance->attributesToArray () );
				if ($updated)
					return $modelInstance->facebook_id;
				else
					logger ( 'Failed Updating (Facebook) ' . self::class . ' ' . $modelInstance->facebook_id );
			}
		} // fall-through and insert.
		return DB::table ( $modelInstance->getTable () )->insertGetId ( $modelInstance->attributesToArray () );
	}
	/**
	 *
	 * @param BaseModel $modelInstance        	
	 */
	public static function provideNavigatable(BaseModel $modelInstance) {
		$basename = class_basename ( $modelInstance );
		$menu = Menu::all ()->where ( 'name', $basename )->first ();
		if (! $menu) {
			$menu = Menu::create ( [ 
					'name' => $basename 
			] );
			$menu->save ();
		}
		$menuItem = MenuItem::all ()->where ( 'navigatable_id', $modelInstance->id )->where ( 'navigatable_type', $basename )->where ( 'menu_id', $menu->id )->first ();
		if (! $menuItem || $modelInstance->isDirty ( [ 
				'title',
				'slug' 
		] )) {
			logger ( 'Creating MenuItem for ', [ 
					'attributes' => $modelInstance->attributesToArray (),
					'backtrace' => debug_backtrace () 
			] );
			MenuItem::firstOrNew ( [ 
					'navigatable_type' => $basename,
					'menu_id' => $menu->id,
					'navigatable_id' => $modelInstance->id 
			] )->navigatable ()->associate ( $modelInstance )->save ();
		}
	}
	public function collectSelections($relationMethod) {
		$selected = $this->$relationMethod;
		if (is_null ( $selected ))
			return new Collection ();
		elseif (! ($selected instanceof Collection)) {
			// dd ( $selected );
			$selected = new Collection ( [ 
					$selected 
			] );
			// dd ( $selected );
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
			// dd ( $namespacedClassName );
			$relatedModel = [ 
					'label' => ucwords ( str_replace ( "_", " ", snake_case ( $relationMethod ) ) ),
					'namespaced' => $namespacedClassName 
			];
			/* must strictly follow Eloquent convention, or no dice. */
			$foreignKey = snake_case ( str_singular ( $relationMethod ) ) . '_id';
			$options = [ ];
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
					logger ( 'Selected', $selected->toArray () );
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
			}
			$this->relationControls [$relationMethod] = $relatedModel;
			$this->relatedModels [] = $namespacedClassName;
		}
		return $this;
	}
	/**
	 * add validation rules for the foreign keys on the table.
	 */
	public function attachRequiredRelations(Request $request) {
		foreach ( $this->relatedModels as $relationMethod => $properties ) {
			/* deal with properties local to this object. */
			if (isset ( $properties ['columnName'] ) && $request->input ( $properties ['columnName'] )) {
				$associatedModel = $properties ['namespaced']::find ( $request->input ( $properties ['columnName'] ) );
				$this->$relationMethod ()->associate ( $associatedModel );
			} else {
			}
		}
	}
	/*
	 * @desc add validation rules and bind variables for fillables.
	 * @param Request $request
	 */
	function validateFillables(Request $request) {
		foreach ( $this->processedFillables as $input => $properties ) {
			/* perform processing for special input types */
			$pipeSeparatedInputName = str_replace ( '.', '_', $input );
			if (is_array ( $request->input ( $pipeSeparatedInputName ) )) {
				$implodedDate = implode ( $request->input ( $pipeSeparatedInputName ), ' ' );
				$processedDate = \DateTime::createFromFormat ( 'Y n j G O', $implodedDate . ' ' . Config::get ( 'app.timezone' ) );
				$this->validatorValues [$input] = $processedDate;
			} else {
				$this->validatorValues [$input] = $request->input ( $pipeSeparatedInputName );
			}
			/* set date validator rule for datetimes */
			if ($properties ['inputType'] == 'datetime') {
				$this->validatorRules [$input] [] = 'date';
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
	function attachValidatedValues(Request $request) {
		/* while not ideal, forceFill is the only way to use attributes that are dynamically added by Traits. */
		$this->fill ( $this->validatorValues );
		$this->attachRequiredRelations ( $request );
	}
	/**
	 *
	 * @param Request $request        	
	 */
	function validate(Request $request) {
		$this->validateFillables ( $request );
		$this->validator = Validator::make ( $this->validatorValues, $this->validatorRules );
		if ($this->validator->passes ()) {
			$this->attachValidatedValues ( $request );
		}
	}
}
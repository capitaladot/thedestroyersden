<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Config;
use Validator;
use MartinBean\MenuBuilder\Menu;
use MartinBean\MenuBuilder\MenuItem;
class BaseModel extends Model{
	protected $hidden = ['relationMethods','processedFillables','relatedModels'];
	public $validator;
	public $validatorRules = [];
	public $validatorValues = [];
	public $processedFillables = [];
	public $relatedModels = [];
	private $schemaManager;
	private $traits;
	public function __construct(){
		if(get_parent_class($this) == 'App\\BaseModel')	{
			/* manually set table name for each subclass */
			$this->table = snake_case(class_basename(str_plural(get_class($this))));
			$this->schemaManager = \DB::connection ()
				->getDoctrineSchemaManager();
			/* put public variables from traits into the fillable array */
			$fillables = $this->schemaManager->listTableColumns($this->table);
			/* except those that are foreign keys */
			$hidables = [];
			$filteredFillables = [];
			foreach($fillables as $fillable){
				$name = $fillable->getName();
				if(
					FALSE !== strpos($name,'_id')
						||
					FALSE !== strpos($name,'able_type')
				){
					$hidables[] = $name;
				}
				else if ($name == 'id'
						||
					FALSE !== strpos($name,'_at'))
				{
					//don't mess with id or dates.
				}
				else{
					$filteredFillables[] = $name;
				}
			}
			/* determine which traits this subclass uses */
			$this->traits = class_uses($this);
			$savedCallback = function (){
				$traits = $this->getTraits();
				if(isset($traits['App\\Navigatable'])){
					$basename = class_basename($this);
					$menu = Menu::firstOrCreate(['name'=>str_plural($basename)]);
					$itemValues = [
						'menu_id' => $menu->id,
						'sort_order'=>1
					];
					$menuItem = MenuItem::firstOrNew($itemValues);
					$menuItem->navigatable()
						->associate($this);
					$menuItem->save();
				}
			};
			$savedCallback->bindTo($this);
			$this->saved($savedCallback);
			$this->fillable(array_merge($hidables,array_merge($this->getFillable(),$filteredFillables)));
			$this->setHidden(array_merge($hidables,['relationMethods','traits','filteredFillables','schemaManager','relatedModels']));
			
		}
	}
	public function getTraits(){
		return $this->traits;
	}
	/**
	 * @desc attach the relatedModels array, to be used in form generation.
	 */
	public function provideRelatables(){
		$columns = $this->schemaManager->listTableColumns($this->table);
		foreach($this->relationMethods as $relationMethod){
			$namespacedClassName = 'App\\'.str_singular(studly_case($relationMethod));
			$relatedModel = [
				'label' => ucwords(str_replace("_"," ",snake_case($relationMethod))),
				'namespaced' => $namespacedClassName
			];
			/* must strictly follow Eloquent convention, or no dice. */
			$foreignKey = snake_case ( str_singular($relationMethod) ).'_id';
			$options = [];
			foreach($namespacedClassName::all() as $eachOption){
				$attributes = $eachOption->attributesToArray();
				if(isset($eachOption->attributes['title'])){
					$options[$eachOption->id] = ['value' => $eachOption->id,'title'=>$eachOption->attributes['title'],'checked'=>false,'attributes'=>$attributes];
				}
				else{
					$options[$eachOption->id] = ['value' => $eachOption->id,'checked'=>false,'attributes'=>$attributes];
				}
			};
			if(!empty($options)){
				$relatedModel['options'] = $options;
				$selected = $this->$relationMethod;
				$relatedModel['selected'] = [];
				if(count($selected) > 0){
					Debugbar::info($selected);
					foreach($selected as $eachSelection){
						if($eachSelection->getAttribute('title')){
							$relatedModel['selected'][$eachSelection->id] = $eachSelection->getAttribute('title');
						}
						else{
							$relatedModel['selected'][$eachSelection->id] = $eachSelection->id;
						}
						$relatedModel['options'][$eachSelection->id]['checked'] = true;
					}
				}
			}
			if(isset($columns[$foreignKey])){
				$relatedModel['columnName'] = $foreignKey;
				$column = \DB::connection ()
					->getDoctrineColumn ($this->table, $foreignKey );
				$relatedModel['maxLength'] = $column->getLength ();
				$relatedModel['notNull'] = $column->getNotnull();
				unset($this->processedFillables[$foreignKey]);
			}
			$this->relatedModels[$relationMethod] = $relatedModel;
		}
		return $this;
	}
	/**
	 * @desc add validation rules for the foreign keys on the table.
	 * */
	public function attachRequiredRelations(Request $request){
		foreach($this->relatedModels as $relationMethod => $properties){
			/* deal with properties local to this object. */
			if(isset($properties['columnName']) && $request->input($properties['columnName'])){
				$associatedModel = $properties['namespaced']::find($request->input($properties['columnName']));
				$this->$relationMethod()->associate($associatedModel);
			}
			else{
				
			}
		}
	}
	/*
	 * @desc add validation rules and bind variables for fillables.
	 * @param Request $request
	 */
	function validateFillables(Request $request){
		foreach($this->processedFillables as $input => $properties){
			/* perform processing for special input types */
			$pipeSeparatedInputName = str_replace('.','_',$input);
			if(is_array($request->input($pipeSeparatedInputName))){
				$implodedDate = implode($request->input($pipeSeparatedInputName),' ');
				$processedDate = \DateTime::createFromFormat(
						'Y n j G O',
						$implodedDate.' '.Config::get('app.timezone')
				);
				$this->validatorValues[$input] = $processedDate;
			}
			else{
				$this->validatorValues[$input] = $request->input($pipeSeparatedInputName);
			}
			/* set date validator rule for datetimes */
			if($properties['inputType'] == 'datetime'){
				$this->validatorRules[$input][] = 'date';
			}
			/* require non-nullable fields */
			if($properties['notNull']){
				$this->validatorRules[$input][] ='required';
			}
			if($properties['maxLength']){
				$this->validatorRules[$input][]='max:'.$properties['maxLength'];
			}
			/* join accumulated rules with pipe separator */
			$this->validatorRules[$input] = implode('|',$this->validatorRules[$input]);
		}
	}
	function attachValidatedValues(Request $request){
		/* while not ideal, forceFill is the only way to use attributes that are dynamically added by Traits. */
		$this->fill($this->validatorValues);
		$this->attachRequiredRelations($request);
	}
	/**
	 *
	 * @param Request $request
	 */
	function validate(Request $request){
		$this->validateFillables($request);
		$this->validator = Validator::make($this->validatorValues,$this->validatorRules);
		if($this->validator->passes()){
			$this->attachValidatedValues($request);
		}
	}
}
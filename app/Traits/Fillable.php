<?php

namespace App\Traits;

use Doctrine\DBAL\Schema\SchemaException;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait Fillable {
	public function setProcessedFillable($fillable){
		$this->provideRelatables[key($fillable)] = pos(array_values($fillable));
		return $this;
	}
	public function unsetProcessedFillable($fillableTuple){
		if(is_null($this->processedFillables))
			return false;
		if(FALSE!==array_search(key($fillableTuple),array_keys($this->processedFillables)))
			unset($this->processedFillables[key($fillableTuple)]);
		elseif(FALSE!==array_search(pos(array_values($fillableTuple)),$this->processedFillables))
			unset($this->processedFillables[pos(array_values($fillableTuple))]);
		return $this;
	}
	/**
	 * @desc put public variables from traits into the fillable array
	 */
	public function bindFillables(){
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
		$newFillable = array_unique(array_merge ( $this->getFillable (), $filteredFillables ));
		$this->fillable ( $newFillable );
		$hidables = array_merge ( $hidables, [
			'slug',
			'relationMethods',
			'traits',
			'filteredFillables',
			'relatedModels'
		] );
		$hidables = array_unique(array_merge ( $hidables, $this->getHidden () ));
		$this->setHidden ( $hidables );
	}
	public function getProcessedFillables() {
		$this->bindFillables();
		$this->processedFillables = [ ];
		foreach ( $this->fillable as $eachFillable ) {
			//Log::debug("Processing fillable: ".$eachFillable);
			try {
				$columnName = snake_case ( $eachFillable );
				$column = \DB::connection ()->getDoctrineColumn ( $this->table, $columnName );
				$this->processedFillables [$eachFillable] = [ 
					'inputType' => $column->getType ()->getName (),
					'maxLength' => $column->getLength (),
					'notNull' => $column->getNotnull (),
					'label' => ucwords ( str_replace ( "_", " ", $eachFillable ) ),
					'columnName' => $eachFillable 
				];
			} catch ( SchemaException $se ) {
				Log::error($se->getMessage());
			}
			catch(\ErrorException $e){
				Log::error($e->getMessage());
			}
		}
		//Log::debug('Processed fillables',$this->processedFillables);
		return $this;
	}
	/**
	 * @desc add validation rules and bind variables for fillables.
	 * @param Request $data)
	 */
	public function validateFillables($data = []){
		$this->getProcessedFillables ();
		Log::debug('Validating request',$data);
		Log::debug('Validating fillables',$this->processedFillables);
		foreach ( $this->processedFillables as $input => $properties ) {
			/* perform processing for special input types */
			$pipeSeparatedInputName = str_replace ( '.', '_', $input );
			if(isset($data[ $pipeSeparatedInputName ])) {
				if ($properties['inputType'] == 'datetime') {
					$processedDate = strtotime($data[$pipeSeparatedInputName]);
					if ($processedDate)
						$this->validatorValues [$input] = $processedDate;
					else
						Log::error('Failed to date parse', [$pipeSeparatedInputName => $data[$pipeSeparatedInputName]]);
				} else {
					$this->validatorValues [$input] = $data[$pipeSeparatedInputName];
				}
				Log::debug('Validator value ',[$input => $data[ $pipeSeparatedInputName ] ]);
			}
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
	public function attachValidatedValues($data = []) {
		/* while not ideal, forceFill is the only way to use attributes that are dynamically added by Traits. */
		Log::debug('Attaching validated values',$this->validatorValues);
		$this->fill ( $this->validatorValues );
	}
	/**
	 *
	 * @param array $data
	 * @return bool
	 */
	public function validate($data = []) {
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
}

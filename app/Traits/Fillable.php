<?php

namespace App\Traits;

use Doctrine\DBAL\Schema\SchemaException;
use Log;
trait Fillable {
	public function getProcessedFillables() {
		$this->processedFillables = [ ];
		$realFillable = array_diff ( $this->fillable, $this->getHidden () );
		foreach ( $realFillable as $eachFillable ) {
			Log::debug($eachFillable);
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
		Log::debug('Processed fillables',$this->processedFillables);
		return $this;
	}
}
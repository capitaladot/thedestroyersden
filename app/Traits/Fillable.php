<?php

namespace App\Traits;

use Doctrine\DBAL\Schema\SchemaException;

trait Fillable {
	public function getProcessedFillables() {
		$this->processedFillables = [ ];
		$realFillable = array_diff ( $this->getFillable (), $this->getHidden () );
		foreach ( $realFillable as $eachFillable ) {
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
			}
		}
		return $this;
	}
}
<?php namespace App;
trait Fillable{
	public function getProcessedFillables(){
		$this->processedFillables = [];
		foreach($this->getFillable() as $eachFillable){
			$column = \DB::connection ()
				->getDoctrineColumn ($this->table, snake_case ( $eachFillable ) );
			$this->processedFillables[$eachFillable] = [
				'inputType' => $column->getType ()->getName (),
				'maxLength' => $column->getLength (),
				'notNull' => $column->getNotnull(),
				'label' => ucfirst(str_replace("_"," ",$eachFillable)),
				'columnName' => $eachFillable
			];
		}
		return $this;
	}
}
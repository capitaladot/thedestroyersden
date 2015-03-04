<?php
trait Salvageable {
	public $lossFactor;
	public function salvage() {
		return $this->craftingComponents->random ( (count ( $this->craftingComponents ) + count ( $this->rawResources )) - $this->itemType->lossFactor );
	}
}
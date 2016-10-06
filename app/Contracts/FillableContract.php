<?php

namespace App\Contracts;

interface FillableContract{
	function bindFillables();
	function getProcessedFillables();
	function validateFillables($data = []);
	function attachValidatedValues($data = []);
	function validate($data = []);
}

<?php

namespace App\Database\Seeds;
use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
	function realTrim($string){
		$string = strtr($string, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES)));
		return trim($string," \t\n\r\0\x0B".chr(0xC2).chr(0xA0));
	}
}

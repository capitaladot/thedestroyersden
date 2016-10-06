<?php
Form::macro ( 'marshaledDateTime', function ($name, $properties = [], $value = null) {
	$date = date ( "Y-m-d\TH:i:s", time());
	if (! empty ( $value )) {
		$date = date ( "Y-m-d\TH:i:s", strtotime ( $value ) );
	}
	$input = '<input name="'.$name.'" class="form-control" type="datetime-local"';
	if(!empty($properties['notNull']))
		$input.=' required="required"';
	return $input.' value="'.$date.'">';
} );
Form::macro("timezone",function($name,$value,$options){
	if(empty($value))
		$value = date_default_timezone_get();
	$zones = array_combine(array_values(timezone_identifiers_list()),array_values(timezone_identifiers_list()));
	$selected = array_search($value,$zones);
	$opts = ['class'=>'form-control'];
	if (! empty ( $options ))
		$options = array_merge ( $opts, $options );
	else
		$options = $opts;
	return Form::select($name, $zones, $selected, $options);
});
Form::macro ( "chosen", function ($name, $allOptions = array(), $selectedOptions = array(), $attributes = array()) {
	
	// For empty Input::old($name) session, $selectedOptions is an empty string
	$multiple = str_plural ( $name ) == $name;
	$defaultAttributes = array (
			'class' => 'chosen-select form-control',
			'id' => $name,
			'size' => ($multiple ? (count ( $selectedOptions ) < 7 ? 7 : count ( $selectedOptions )) : 1)
	);
	if ($multiple) {
		$defaultAttributes ['multiple'] = $multiple;
		$defaultAttributes ['name'] = $name . '[]';
	} else
		$defaultAttributes ['name'] = $name;
	if (! empty ( $attributes ))
		$attributes = array_merge ( $defaultAttributes, $attributes );
	else
		$attributes = $defaultAttributes;

	$returnString = '<select ' . Html::attributes ( $attributes ) . '>';
	foreach ( $allOptions as $eachOption ) {
		$value = is_object($eachOption) ? $eachOption->id : (array_key_exists('value',$eachOption) ? $eachOption['value'] :  "" );
		$returnString .= '<option value="' . $value  . '"';
		if((!is_object($eachOption) && !empty($eachOption['checked'])) || (is_object($eachOption) && FALSE!==array_search($eachOption->id,$selectedOptions))){
			$returnString .= ' selected="selected"';
		}
		$returnString .= '>' . Html::entities ( (isset($eachOption['title'])
				? $eachOption['title']
				: (isset($eachOption['attributes']['note'])
					? $eachOption['attributes']['note']
					: $eachOption['attributes']['id']
				))) . '</option>';
	}
	$returnString .= '</select>';
	return $returnString;
} );

<?php
Form::macro ( 'dateTime', function ($input, $properties = [], $value = null) {
	$dateArray = [ 
			0 => false,
			1 => false,
			2 => false,
			3 => false,
			4 => false 
	];
	$date = date ( "Y-m-d\TH:i:s", time());
	if (! empty ( $value )) {
		$date = date ( "Y-m-d\TH:i:s", strtotime ( $value ) );
	}
	return '<input name="'.$input.'" class="form-control" type="datetime-local" value="'.$date.'">';
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
Form::macro ( "chosen", function ($name, $defaults = array(), $selected = array(), $options = array()) {
	
	// For empty Input::old($name) session, $selected is an empty string
	if (! $selected)
		$selected = array ();
	$multiple = str_plural ( $name ) == $name;
	$opts = array (
			'class' => 'chosen-select form-control',
			'id' => $name,
			'size' => ($multiple ? (count ( $selected ) < 7 ? 7 : count ( $selected )) : 1) 
	);
	if ($multiple) {
		$opts ['multiple'] = $multiple;
		$opts ['name'] = $name . '[]';
	} else
		$opts ['name'] = $name;
	if (! empty ( $options ))
		$options = array_merge ( $opts, $options );
	else
		$options = $opts;
	$attributes = Html::attributes ( $options );
	
	$ret = '<select ' . $attributes . '>';
	foreach ( $defaults as $def ) {
		$ret .= '<option value="' . $def->id . '"';
		foreach ( $selected as $selection ) {
			// dd ( $selection );
			// session array or passed stdClass obj
			$current = $selection->id ? $selection->id : $selection;
			if ($def->id == $current) {
				$ret .= ' selected="selected"';
			}
		}
		$ret .= '>' . Html::entities ( @$def->title ? $def->title : json_encode ( $def->getAttributes () ) ) . '</option>';
	}
	$ret .= '</select>';
	return $ret;
} );
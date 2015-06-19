<?php
Form::macro ( 'dateTime', function ($input, $properties = [], $value = null) {
	$dateArray = [ 
			0 => false,
			1 => false,
			2 => false,
			3 => false,
			4 => false 
	];
	if (! is_null ( $value )) {
		$date = date ( 'Y n j G O', strtotime ( $value ) );
		$dateArray = explode ( " ", $date );
	}
	return Form::selectYear ( $input . '[Y]', date ( 'Y' ) - 1, date ( 'Y' ) + 5, $dateArray [0] ? $dateArray [0] : date ( 'Y' ), [ 
			$properties ['notNull'] ? 'required' : '' 
	] ) . Form::selectMonth ( $input . '[M]', $dateArray [1] ? $dateArray [1] : date ( 'n' ), [ 
			$properties ['notNull'] ? 'required' : '' 
	] ) . Form::label ( 'Date' ) . Form::selectRange ( $input . '[D]', 1, 31, $dateArray [2] ? $dateArray [2] : date ( 'j' ), [ 
			$properties ['notNull'] ? 'required' : '' 
	] ) . Form::label ( 'Hour' ) . Form::selectRange ( $input . '[H]', 0, 23, $dateArray [3] ? $dateArray [3] : 17, [ 
			$properties ['notNull'] ? 'required' : '' 
	] );
} );
Form::macro ( "chosen", function ($name, $defaults = array(), $selected = array(), $options = array()) {
	
	// For empty Input::old($name) session, $selected is an empty string
	if (! $selected)
		$selected = array ();
	$multiple = str_plural ( $name ) == $name;
	$opts = array (
			'class' => 'chosen-select',
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
	$attributes = Html::attributes ( $options );
	
	// need an empty array to send if all values are unselected
	$ret = '<input type="hidden" name="' . Html::entities ( $name ) . '[]">';
	$ret .= '<select ' . $attributes . '>';
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
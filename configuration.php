<?php

$baseUrl = 'http://tools.motivado.de/condition/';
$cheeseUrl = 'http://projects.simsab.net/cheese/';

$examples = array(
	'Example 1 (valid, true)' => array(
		'keys' => array(
			'var1', 'var2', 'var3'
		),
		'values' => array(
			'1', '2', '0'
		),
		'condition' => "(var1 is 1 or var1 is 'bla') and ('blubb' or var3 gt 5) or var2 is 'hallo'"
	),
	'Example 2 (valid, false)' => array(
		'condition' => "(var1 is 1 or 0) and (1 and (undefined gt 1)) or 0"
	),
	'Example 3 (invalid, false)' => array(
		'condition' => "(var1 is 1 or 'bla') and(1 and('blubb' or b gt 1)) or base64_decode('hallo')"
	),
	'Example 3.1 (getting there, false)' => array(
		'condition' => "(var1 is 1 or 'bla') and (1 and('blubb' or b gt 1)) or base64_decode('hallo')"
	),
	'Example 3.2 (getting there, false)' => array(
		'condition' => "(var1 is 1 or 'bla') and (1 and ('blubb' or b gt 1)) or base64_decode('hallo')"
	),
	'Example 3.3 (valid, true)' => array(
		'condition' => "(var1 is 1 or 'bla') and (1 and ('blubb' or b gt 1)) or base64_decode ('hallo')"
	)
);
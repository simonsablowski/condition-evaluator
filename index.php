<?php

namespace Motivado\Api;

$base = dirname(__FILE__) . '/';

require $base . '../../nacho/Application.php';
require $base . '../../nacho/libraries/Error.php';
require $base . '../ui/libraries/CoachingConfigurator.php';
require $base . '../api/libraries/ConditionEvaluator.php';
require $base . '../api/libraries/Json.php';
require $base . '/configuration.php';

$self = $_SERVER['PHP_SELF'];

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

$default = $examples ? pos($examples) : NULL;
$keys = isset($_REQUEST['keys']) ? $_REQUEST['keys'] : (isset($default['keys']) ? $default['keys'] : array());
$values = isset($_REQUEST['values']) ? $_REQUEST['values'] : (isset($default['values']) ? $default['values'] : array());
$condition = isset($_REQUEST['condition']) ? $_REQUEST['condition'] : (isset($default['condition']) ? $default['condition'] : '');

$CoachingConfigurator = new \CoachingConfigurator;
$CoachingConfigurator->setValues(array_combine($keys, $values));

$ConditionEvaluator = new ConditionEvaluator;
$ConditionEvaluator->setCoachingConfigurator($CoachingConfigurator);

$result = $ConditionEvaluator->evaluate($condition);

$code = highlight_file('../api/libraries/ConditionEvaluator.php', TRUE);

require $base . 'layout.php';
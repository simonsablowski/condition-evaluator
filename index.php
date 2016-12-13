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

$default = $examples ? pos($examples) : NULL;
$keys = isset($_REQUEST['keys']) ? $_REQUEST['keys'] : (isset($default['keys']) ? $default['keys'] : array());
$values = isset($_REQUEST['values']) ? $_REQUEST['values'] : (isset($default['values']) ? $default['values'] : array());
$condition = isset($_REQUEST['condition']) ? $_REQUEST['condition'] : (isset($default['condition']) ? $default['condition'] : '');

$CoachingConfigurator = new \CoachingConfigurator;
$CoachingConfigurator->setValues(array_combine($keys, $values));

$ConditionEvaluator = new ConditionEvaluator;
$ConditionEvaluator->setCoachingConfigurator($CoachingConfigurator);

$result = $ConditionEvaluator->evaluate($condition);

require $base . 'layout.php';
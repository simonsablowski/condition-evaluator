<?php

class ConditionEvaluator extends Application {
	protected $CoachingConfigurator = NULL;
	protected $operators = array(
		'is' => '==',
		'not' => '!=',
		'lt' => '<',
		'le' => '<=',
		'gt' => '>',
		'ge' => '>=',
		'and' => '&&',
		'or' => '||'
	);
	
	public function __construct() {
		
	}
	
	protected function secureCondition(&$condition) {
		if (preg_match('/[^\s\w()\']/i', $condition, $characters)) {
			throw new Error('Condition contains invalid characters', $characters);
		}
		
		foreach ($this->getOperators() as $alias => $original) {
			$condition = preg_replace(sprintf('/(\s+)%s(\s+)/', $alias), sprintf('$1%s$2', $original), $condition);
		}
		
		if (!preg_match_all('/(^|\s|\()([a-z]{1}\w+)([^\s\)$])?/i', $condition, $variables)) {
			throw new Error('Condition contains no valid variables', $condition);
		} else {
			foreach ($variables[3] as $n => $element) {
				if ($element) {
					throw new Error('Condition contains invalid element', $variables[0][$n]);
				}
			}
		}
		
		foreach ($variables[0] as $n => $part) {
			$variable = $variables[2][$n];
			$condition = str_replace($part, str_replace($variable, '$' . $variable, $part), $condition);
		}
		
		$condition = sprintf('return %s;', $condition);
		var_dump($condition);
	}
	
	public function evaluate($condition) {
		extract($this->getCoachingConfigurator()->getValues());
		
		$level = error_reporting(0);
		$this->secureCondition($condition);
		$result = (bool)eval($condition);
		error_reporting($level);
		
		return $result;
	}
// }
	
	public function getOperators() {
		return $this->operators;
	}
	
	public function getCoachingConfigurator() {
		return $this->CoachingConfigurator;
	}
	
	public function setCoachingConfigurator($CoachingConfigurator) {
		return $this->CoachingConfigurator = $CoachingConfigurator;
	}
}
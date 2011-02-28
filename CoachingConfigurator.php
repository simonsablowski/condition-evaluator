<?php

class CoachingConfigurator extends Application {
	protected $values = array();
	
	public function getValues() {
		return $this->values;
	}
	
	public function setValues($values) {
		return $this->values = $values;
	}
}
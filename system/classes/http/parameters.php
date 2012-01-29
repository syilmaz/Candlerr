<?php
class HTTP_Parameters {
	/**
	 * Data vault
	 * @var Array
	 */
	protected $vault = array();

	public function __set($name, $value) {
		$this->vault[$name] = $value;
	}

	public function __get($name) {
		return isset($this->vault[$name]) ? $this->vault[$name] : null;
	}
}

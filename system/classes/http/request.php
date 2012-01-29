<?php
require_once SYS_PATH . 'classes' . DIRECTORY_SEPARATOR . 'http' . DIRECTORY_SEPARATOR . 'parameters' . EXT;

class HTTP_Request {
	/**
	 * HTTP Method
	 * @var String
	 */
	public $method = null;

	/**
	 * @var HTTP_Parameters
	 */
	public $params = null;

	/**
	 * Available HTTP Methods
	 * @var array
	 */
	protected $available_methods = array('get', 'put', 'post', 'delete');

	/**
	 * Convert the request to more readable variables
	 * @param $resources
	 */
	public function __construct(array $resources) {
		// Create a holder for parameters
		$this->params = new HTTP_Parameters();

		$method = strtolower($_SERVER['REQUEST_METHOD']);

		// Check if the current method is correct
		if (!in_array($method, $this->available_methods)) {
			$this->method = null;
		}

		$this->method = $method;

		// Set the parameters that we have
		foreach ($resources as $resource => $id) {
			$resource_name = strtolower($resource) . 'Id';
			$this->params->__set($resource_name, $id);
		}
	}

	/**
	 * Determines which action should be called
	 * @param String $id
	 * @return String
	 */
	public function getAction($id = null) {
		// Determine which action we are going to call
		if ($this->method === 'get' && $id === null) {
			return 'index';
		}

		if ($this->method === 'get' && $id !== null) {
			return 'show';
		}

		if ($this->method === 'put' && $id !== null) {
			return 'update';
		}

		if ($this->method === 'post') {
			return 'create';
		}

		if ($this->method === 'delete' && $id !== null) {
			return 'destroy';
		}

		return null;
	}
}
<?php
require_once SYS_PATH . 'classes' . DIRECTORY_SEPARATOR . 'loader' . EXT;

class Request {
	/**
	 * @static Returns a new instance of {@link Request}
	 * @return Request
	 */
	static public function factory() {
		return new Request();
	}

	/**
	 * Set the available return type formats here
	 * @var array
	 */
	protected $available_formats = array('json', 'xml');

	/**
	 * The requested resources are set here
	 * @var array
	 */
	protected $resources = array();

	/**
	 * Does the actual loading of resources
	 */
	public function execute() {
		// First process the URI
		$this->processUri($_SERVER['REQUEST_URI']);

		// Load the resources
		Loader::load($this->resources);
	}

	/**
	 * Process the URI
	 * Detect which resources we should be loading
	 * @param $uri String
	 */
	protected function processUri($uri) {
		// Strip out the first /index.php if present
		if (strpos($uri, '/index.php') !== -1) {
			$uri = substr($uri, strlen('/index.php'));
		}

		// Remove the query string from the URI
		$uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $uri);

		// Get the type from the url
		$uri = trim($uri, '/');

		// We need to get the first part
		$bits = explode('/', $uri);

		if (empty($uri)) {
			$bits = null;
		}

		if (Candlerr::$responseFormatInUri) {
			// Is the first part of the uri a format?
			if (in_array($bits[0], $this->available_formats)) {
				// Yes it is, set the format
				Candlerr::$format = strtolower($bits[0]);

				// Remove this bit
				array_shift($bits);
			}
		}
		else if (isset($_GET['format'])) {
			// Since $responseFormatInUri is false, check if it's inside the GET query string
			Candlerr::$format = strtolower($_GET['format']);
		}

		// Now actually process the URI
		for ($i = 0; $i < count($bits); $i += 2) {
			// Check if the variable has been given
			if (isset($bits[$i + 1])) {
				$this->resources[strtolower($bits[$i])] = $bits[$i + 1];

				continue;
			}

			$this->resources[strtolower($bits[$i])] = null;
		}

		// No resource was provided in the url, fall back to the default one
		if (count($this->resources) === 0) {
			$this->resources[Candlerr::$defaultResource] = null;
		}
	}
}
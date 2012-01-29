<?php
require_once SYS_PATH . 'classes' . DIRECTORY_SEPARATOR . 'http' . DIRECTORY_SEPARATOR . 'request' . EXT;
require_once SYS_PATH . 'classes' . DIRECTORY_SEPARATOR . 'http' . DIRECTORY_SEPARATOR . 'response' . EXT;

class Loader {
	/**
	 * @static Loads in the resources in the set order of the array
	 * @param $resources Array
	 * @return null
	 */
	static public function load(array $resources) {
		$trail = array();

		// Create a new HTTP Request
		$request = new HTTP_Request($resources);
		$response =  new HTTP_Response();

		ob_start();

		// Method not provided, bad request
		if ($request->method === null) {
			$response->send(400);
		}

		// Keep track of where we are
		$total_resources = count($resources);
		$i = 1;

		foreach ($resources as $resource => $id) {
			$file = '';

			// Check if we are moving deeper, if so, we need to include the trail
			if (!empty($trail)) {
				$file  = implode(DIRECTORY_SEPARATOR, $trail);
				$file .= DIRECTORY_SEPARATOR;
			}

			$file .= $resource;

			// Require the resource
			require_once APP_PATH . 'resources' . DIRECTORY_SEPARATOR . $file . EXT;

			// This is the class name
			$name = 'Resource_';

			// Check if we are moving deeper, if so, we need to include the trail
			if (!empty($trail)) {
				$name .= implode('_', $trail);
				$name .= '_';
			}

			$name .= $resource;

			// Determine the method we are going to call
			$action = ($i === $total_resources) ? $request->getAction($id) : 'load';

			// No action provided, bad request
			if ($action === null) {
				return $response->send(400);
			}

			// Lets create a reflectionClass first, so we can check if the requested method is available
			$reflection = new ReflectionClass($name);

			// Requested action is not implemented
			if (!$reflection->hasMethod($action)) {
				return $response->send(400);
			}

			// Do the actual calling of the function
			$class = new $name;
			call_user_func(array($class, $action), $request, $response);

			// Keep track
			$i++;

			// Add it to the trail
			$trail []= $resource;
		}

		ob_end_flush();

		return null;
	}
}
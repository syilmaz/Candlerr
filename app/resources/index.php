<?php
class Resource_Index implements HTTP_Resource {
	/**
	 * Called when a GET request is made without an id
	 * i.e: /users
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function index(HTTP_Request $request, HTTP_Response $response)
	{
		$response->send(201);
		// TODO: Implement index() method.
	}

	/**
	 * Called when a GET request is made with an id
	 * i.e: /users/1
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function show(HTTP_Request $request, HTTP_Response $response)
	{
		// TODO: Implement show() method.
	}

	/**
	 * Called whenever a POST request is being made without an id
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function create(HTTP_Request $request, HTTP_Response $response)
	{
		// TODO: Implement create() method.
	}

	/**
	 * Called when a PUT request is made with an id
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function update(HTTP_Request $request, HTTP_Response $response)
	{
		// TODO: Implement update() method.
	}

	/**
	 * Called when a DELETE request is made with an id
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function destroy(HTTP_Request $request, HTTP_Response $response)
	{
		// TODO: Implement destroy() method.
	}

	/**
	 * Called when a deeper request is made and this is the parent.
	 * For example, when a request is made to: /users/1/messages
	 * Then load() is called on the Users resource.
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function load(HTTP_Request $request, HTTP_Response $response)
	{
		$request->params->id = 'he';
		// TODO: Implement load() method.
	}

}
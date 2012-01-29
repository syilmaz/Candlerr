<?php
interface HTTP_Resource {
	/**
	 * Called when a GET request is made without an id
	 * i.e: /users
	 * @abstract
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function index(HTTP_Request $request, HTTP_Response $response);

	/**
	 * Called when a GET request is made with an id
	 * i.e: /users/1
	 * @abstract
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function show(HTTP_Request $request, HTTP_Response $response);

	/**
	 * Called whenever a POST request is being made without an id
	 * @abstract
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function create(HTTP_Request $request, HTTP_Response $response);

	/**
	 * Called when a PUT request is made with an id
	 * @abstract
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function update(HTTP_Request $request, HTTP_Response $response);

	/**
	 * Called when a DELETE request is made with an id
	 * @abstract
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function destroy(HTTP_Request $request, HTTP_Response $response);

	/**
	 * Called when a deeper request is made and this is the parent.
	 * For example, when a request is made to: /users/1/messages
	 * Then load() is called on the Users resource.
	 * @abstract
	 * @param HTTP_Request $request
	 * @param HTTP_Response $response
	 */
	public function load(HTTP_Request $request, HTTP_Response $response);
}
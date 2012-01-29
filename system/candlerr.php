<?php
/**
 * Holds all the bootstrappable functionalities
 */
class Candlerr {
	/**
	 * When this is set to <b>true</b> API url is:
	 * 	/<format>/<resource>
	 *
	 * When set to <b>false</b> the format can be provided as a query string:
	 * /<resource>?format=<format>
	 *
	 * @var Boolean
	 */
	static $responseFormatInUri = false;

	/**
	 * Default format when one is not provided
	 *
	 * Options:
	 * - json
	 * - xml
	 *
	 * @var string
	 */
	static $format = 'json';

	/**
	 * Sets the default resource when one isn't provided
	 *
	 * @var String
	 */
	static $defaultResource = 'index';
}
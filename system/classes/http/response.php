<?php
class HTTP_Response {
	/**
	 * Available status
	 * @var array
	 */
	protected $http_status = array(
		'100' => 'Continue',
		'101' => 'Switching Protocols',
		'200' => 'OK',
		'201' => 'Created',
		'202' => 'Accepted',
		'203' => 'Non-Authoritative Information',
		'204' => 'No Content',
		'205' => 'Reset Content',
		'206' => 'Partial Content',
		'300' => 'Multiple Choices',
		'301' => 'Moved Permanently',
		'302' => 'Moved Temporarily',
		'303' => 'See Other',
		'304' => 'Not Modified',
		'305' => 'Use Proxy',
		'400' => 'Bad Request',
		'401' => 'Unauthorized',
		'402' => 'Payment Required',
		'403' => 'Forbidden',
		'404' => 'Not Found',
		'405' => 'Method Not Allowed',
		'406' => 'Not Acceptable',
		'407' => 'Proxy Authentication Required',
		'408' => 'Request Time-out',
		'409' => 'Conflict',
		'410' => 'Gone',
		'411' => 'Length Required',
		'412' => 'Precondition Failed',
		'413' => 'Request Entity Too Large',
		'414' => 'Request-URI Too Large',
		'415' => 'Unsupported Media Type',
		'500' => 'Internal Server Error',
		'501' => 'Not Implemented',
		'502' => 'Bad Gateway',
		'503' => 'Service Unavailable',
		'504' => 'Gateway Time-out',
		'505' => 'HTTP Version not supported'
	);

	/**
	 * The default HTTP Protocol
	 * @var String
	 */
	protected $protocol = 'HTTP/1.0';

	public function __construct() {
		// Are we supposed to use something other than HTTP/1.0?
		if (isset($_SERVER['SERVER_PROTOCOL'])) {
			$this->protocol = $_SERVER['SERVER_PROTOCOL'];
		}
	}

	/**
	 * Sends out the response to the client
	 * @param mixed $body|$status
	 * @param mixed $header|$status
	 * @param int $status http header status
	 */
	public function send($body = null, $header = null, $status = null) {
		$arg = func_get_args();

		$body = isset($arg[0]) ? $arg[0] : null;
		$header = isset($arg[1]) ? $arg[1] : null;
		$status = isset($arg[2]) ? $arg[2] : null;

		// Check to see if the status code is set, or if the body is being set
		if (is_numeric($body)) {
			$status = (int) $body;
			$body = null; // Unset the body
		}

		if (is_numeric($header)) {
			$status = (int) $header;
			$header = null; // Unset the header
		}

		// Prepare the header, set status code if needed
		$this->prepareHeader($header, $status);

		// Send out the body
		echo $body;

		ob_end_flush();
	}

	/**
	 * Prepare the header
	 * @param Array $header
	 * @param String|Int $status
	 */
	protected function prepareHeader($header = null, $status = '200') {
		$status_text = $this->http_status[(string) $status];

		// Set the header
		header("$this->protocol $status $status_text");
	}
}
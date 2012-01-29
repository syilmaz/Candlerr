<?php
/**
 * Include the core file
 */
require SYS_PATH . 'core' . EXT;

/**
 * When this is set to <b>true</b> API url is:
 * 	/<format>/<resource>
 *
 * When set to <b>false</b> the format can be provided as a query string:
 * /<resource>?format=<format>
 */
Candlerr::$responseFormatInUri = false;

/**
 * Sets the default resource when one isn't provided
 */
Candlerr::$defaultResource = 'index';
<?php

include(dirname(__FILE__) . '/config.php');

/**
 * Define Wordpress constants
 */
define("WP_CONTENT_URL", $contenturl);
define("WP_CONTENT_DIR", $contentdir);

/**
 * Define whitelabel configuration
 */
$GLOBALS['WHITELABEL'] = array(
	'contenturl' => $contenturl,
	'contentdir' => $contentdir,
	'admindomain' => $admindomain,
	'publicdomain' => $publicdomain,
);

/**
 * Switch to real Wordpress directory
 */
chdir($wppath);

/**
 * Start buffering
 */
ob_start();

/**
 * Run Wordpress
 */
if (!include_once($wppath . "/index.php")) {
        header("HTTP/1.1 503 Service Unavailable");
}

/**
 * Get the content.
 */
$content = ob_get_contents();

/**
 * Cleanup output buffering
 */
ob_end_clean();

/**
 * Fix various shitty Wordpress plugins, which are saved in Notepad and have BOM characters
 */
$content = ltrim($content);

/**
 * Flush out the content
 */
echo($content);

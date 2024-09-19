<?php
// Maintenance
// if ( $_SERVER["HTTP_X_FORWARDED_FOR"] != '80.60.243.113') {
// 	header('HTTP/1.0 503 Service Unavailable');
// 	die('<html><head><meta name="viewport" content="width=device-width, initial-scale=1"></head><body><h2>Temporary under maintenance</h2><p>Check back in a few hours.</p></body></html>');
// }

// Composer
require BASE_DIR . '/vendor/autoload.php';

// Environment
require FW_DIR . '/defines.php';

// Load core
require FW_DIR . '/dataproxy.php';
require FW_DIR . '/functions.php';

// Fat Free Rendering! 
$f3 = \Base::instance();
$f3->set('AUTOLOAD', FW_DIR . '/');
$f3->set('CACHE', 'folder=/tmp/f3filescache/');

// Enable sessions 


// Error reporting
if ((defined('ENVIRONMENT') && ENVIRONMENT == 'development') || $_SERVER["HTTP_X_FORWARDED_FOR"] == '80.60.243.113') {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

// Globals
$assets_manifest = get_asset_manifest();
$dataproxy = new TopQuote\DataProxy();
$orderby = $f3->get('GET.ob') ?? $dataproxy::$ORDER_CREATED;
$order = $f3->get('GET.o') ?? $dataproxy::$ORDER_DESC;
$page = $f3->get('GET.p') ?? 1;

// Routes
require FW_DIR . '/routes.php';

$f3->run();

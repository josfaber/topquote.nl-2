<?php

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
if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
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

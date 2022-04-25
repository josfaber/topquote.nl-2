<?php

// Composer
require BASE_DIR . '/vendor/autoload.php';

// DotEnv
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(BASE_DIR . '/.env');

// Load core
require FW_DIR . '/defines.php';
require FW_DIR . '/functions.php';

// Fat Free Rendering! 
$f3 = \Base::instance();
$f3->set('AUTOLOAD', FW_DIR . '/');

// Globals
$assets_manifest = get_asset_manifest();
$dataproxy = new \TopQuote\DataProxy();
$orderby = $f3->get('GET.ob') ?? $dataproxy::$ORDER_CREATED;
$order = $f3->get('GET.o') ?? $dataproxy::$ORDER_DESC;
$page = $f3->get('GET.p') ?? 1;

// Routes
$f3->route('GET /', 						'Controller\Home->index');

$f3->route('GET /quotes', 					'Controller\Quotes->index');
$f3->route('GET /quotes/@filter/@slug', 	'Controller\Quotes->@filter');
$f3->route('GET /quote/@slug', 				'Controller\Quote->detail');

$f3->route('GET /add', 						'Controller\Quote->add');
$f3->route('POST /add', 					'Controller\Quote->store');

$f3->route('GET /import',  					'Controller\Dev->import');

$f3->route('POST /api/quotes [ajax]',		'Controller\Api->quotes');

$f3->run();

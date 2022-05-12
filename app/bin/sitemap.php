<?php 
define("BASE_DIR", 		__DIR__ . "/..");
define("FW_DIR", 		__DIR__ . "/../framework");
define("PUBLIC_DIR", 	__DIR__ . "/../public");

require BASE_DIR . '/vendor/autoload.php';

require FW_DIR . '/dataproxy.php';
require FW_DIR . '/defines.php';
require FW_DIR . '/functions.php';

$dataproxy = new TopQuote\DataProxy();

include __DIR__ . "/includes/render_sitemap.php";
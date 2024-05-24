<?php
define("BASE_DIR", 		__DIR__ . "/..");
define("FW_DIR", 		__DIR__ . "/../framework");
define("PUBLIC_DIR", 	__DIR__ . "/../public");

require BASE_DIR . '/vendor/autoload.php';

require FW_DIR . '/defines.php';

require FW_DIR . '/dataproxy.php';
require FW_DIR . '/functions.php';

$db = new DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
	throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

$results = $db->exec("SELECT * FROM quotes", []);

$n = 1;
foreach ($results as $result) {
	// if ($n++ > 11) break;

	$tags = $result['tags'];
	try {
		$unserialized = unserialize($tags);
		continue;
	} catch (Exception $e) {
		$serialized = serialize(array_filter(explode(',', strtolower($tags))));
		$db->exec("UPDATE quotes SET `tags` = '$serialized' WHERE `id` = ?", $result['id']);
		echo $result['id'] . "\n";
	}
}

restore_error_handler();

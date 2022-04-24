<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {

		$db = get_db();
		$results = $db->exec('SELECT * FROM quotes ORDER BY RAND() LIMIT 1');
		!s($results);

		render_template('home.html', [
			"quote" => $results[0],
		]);

	}
}
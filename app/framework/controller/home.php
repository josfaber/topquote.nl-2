<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {
		
		global $dataproxy;
		$quote = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 1)["results"][0];
		
		render_template('home.html', [
			"quote" => $quote,
		]);

	}
}
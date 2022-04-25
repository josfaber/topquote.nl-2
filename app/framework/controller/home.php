<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {
		
		global $dataproxy;
		$quote = $dataproxy->get_random_quote();

		render_template('home.html', [
			"quote" => $quote,
		]);

	}
}
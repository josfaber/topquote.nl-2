<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {
		
		global $dataproxy;
		$random_quote = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 1)["results"][0];
		
		$said_last_week = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 1, 1, "
			 AND (`created` > DATE_SUB(now(), INTERVAL 30 DAY))
		")["results"][0];
		
		render_template('home.html', [
			"random_quote" => $random_quote,
			"said_last_week" => $said_last_week,
		]);

	}
}
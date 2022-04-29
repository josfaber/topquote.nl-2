<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {
		
		global $dataproxy;
		$random_quote = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 1)["results"][0];
		
		$said_last_week = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 1, 1, "
			 AND (`created` > DATE_SUB(now(), INTERVAL 30 DAY))
		")["results"][0];

		$top_tags = $dataproxy->get_top_tags();
		shuffle($top_tags);

		$top_sayers = $dataproxy->get_top_sayers();
		shuffle($top_sayers);

		$top_submitters = $dataproxy->get_top_submitters();
		shuffle($top_submitters);

		render_template('home.html', [
			"is_home" => true,
			"mailchimp_url" => MAILCHIMP_URL,
			"random_quote" => $random_quote,
			"said_last_week" => $said_last_week,
			"top_tags" => $top_tags,
			"top_sayers" => $top_sayers,
			"top_submitters" => $top_submitters,
		]);

	}
}
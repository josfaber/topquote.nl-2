<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {
		
		global $assets_manifest, $dataproxy;
		// !d($dataproxy::$ORDER_RANDOM);
		$random_quotes = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
			AND LENGTH(`quote`) > 10 AND LENGTH(`quote`) < 120
	")["results"];
		
		$said_last_week = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
			 AND (`created` > DATE_SUB(now(), INTERVAL 30 DAY)) AND LENGTH(`quote`) > 10 AND LENGTH(`quote`) < 120
		")["results"];

		$top_tags = $dataproxy->get_top_tags();
		shuffle($top_tags);

		$top_sayers = $dataproxy->get_top_sayers();
		shuffle($top_sayers);

		$top_submitters = $dataproxy->get_top_submitters();
		shuffle($top_submitters);

		render_template('home.html', [
			"is_home" => true,
			"mailchimp_url" => MAILCHIMP_URL,
			"random_quotes" => $random_quotes,
			"said_last_week" => $said_last_week,
			"top_tags" => $top_tags,
			"top_sayers" => $top_sayers,
			"top_submitters" => $top_submitters,
		], [], [site_url($assets_manifest["home.js"])]);

	}
}
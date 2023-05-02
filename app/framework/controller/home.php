<?php

namespace Controller;

class Home {
	function index(\Base $f3, $params) {
		
		global $assets_manifest, $dataproxy;
		// !d($dataproxy::$ORDER_RANDOM);
		$random_quotes = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
		AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
		")["results"];
		
		$said_last_month = ($slm = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
		AND (`created` > DATE_SUB(now(), INTERVAL 30 DAY)) AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
		")) ? $slm["results"]: [];

		if (count($said_last_month) == 0) {
			$said_last_month = ($slm = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
			AND (`created` > DATE_SUB(now(), INTERVAL 60 DAY)) AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
			")) ? $slm["results"]: [];
		}

		if (count($said_last_month) == 0) {
			$said_last_month = ($slm = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
			AND (`created` > DATE_SUB(now(), INTERVAL 90 DAY)) AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
			")) ? $slm["results"]: [];
		}

		if (count($said_last_month) == 0) {
			$said_last_month = ($slm = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
			AND (`created` > DATE_SUB(now(), INTERVAL 180 DAY)) AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
			")) ? $slm["results"]: [];
		}
		
		$top_tags = $dataproxy->get_top_tags();
		foreach(["hjkm", "tc", "touchcreative", "RTV", "RTV", "woedend", "nrg3", "meidengeheimen"] as $tag) { $top_tags[] = array( "tag" => $tag, "amount" => 1000 ); }
		$top_tags = array_unique($top_tags, SORT_REGULAR);
		shuffle($top_tags);

		$top_sayers = $dataproxy->get_top_sayers();
		shuffle($top_sayers);

		$top_submitters = $dataproxy->get_top_submitters();
		shuffle($top_submitters);

		render_template('home.html', [
			"is_home" => true,
			"mailchimp_url" => MAILCHIMP_URL,
			"random_quotes" => $random_quotes,
			"said_last_month" => $said_last_month,
			"top_tags" => $top_tags,
			"top_sayers" => $top_sayers,
			"top_submitters" => $top_submitters,
		], [], [site_url($assets_manifest["home.js"])]);

	}

	function phpinfo(\Base $f3, $params) {
		echo "<pre>"; var_dump(gd_info()); echo "</pre>";
		phpinfo();
	}
}
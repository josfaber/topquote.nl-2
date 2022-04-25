<?php

namespace Controller;

class Quote {

	function detail(\Base $f3, $params) {
		if (!isset($params["slug"])) {
			$f3->error(404);
		}

		global $dataproxy;
		$quote = $dataproxy->get_quote_by_slug($params["slug"]);
		
		if ($quote == false) {
			$f3->error(404);
		}

		// redirect to canonical URL
		if ($params["slug"] != $quote["slug"]) {
			$f3->reroute("/quote/{$quote["slug"]}");
		}

		// !d( $results );

		render_template('quote.html', [
			"quote" => $quote,
		]);
	}

	function add(\Base $f3, $params) {
		!d( "Add Quote.");
	}

}
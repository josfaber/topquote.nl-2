<?php

namespace Controller;

class Quote
{

	function detail(\Base $f3, $params)
	{
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
			"is_single_quote" => true,
			"quote" => $quote,
		]);
	}

	function add(\Base $f3, $params)
	{
		// !d( "Add Quote.");

		render_template('add.html', [
			"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
		]);
	}

	function store(\Base $f3, $params)
	{
		// !d("Store Quote.", $params, $_POST);

		$verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=" . $_POST["rtoken"] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$response = json_decode(file_get_contents($verify_url), true);

		if ($response['success'] == true) {
		
			$db = new \DB\SQL( 'mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD );

			$quote = trim($_POST["quote"]);
			$slug = slugify($quote, 200);
			$sayer = trim($_POST["by"]);
			$submitter = trim($_POST["from"]);
			$tags = implode(",", array_map("tagify", explode(",", $_POST["tags"])));
			// !d(
			// 	$quote, 
			// 	$slug,
			// 	$sayer,
			// 	$submitter,
			// 	$tags
			// );
			// exit();

			$db->exec('INSERT INTO quotes (
				import_id, 
				created, 
				slug, 
				quote, 
				quote_lc, 
				sayer, 
				sayer_lc, 
				sayer_slug, 
				submitter, 
				submitter_lc, 
				submitter_slug, 
				tags, 
				tags_lc
				) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
					0,
					date('Y-m-d H:i:s'), 
					$slug, 
					$quote,
					strtolower($quote),
					$sayer,
					strtolower($sayer),
					slugify($sayer),
					$submitter,
					strtolower($submitter),
					slugify($submitter),
					$tags,
					strtolower($tags)
				]);

				render_template('saved.html', [
					"saved_quote_url" => site_url("/quote/{$slug}")
				]);

		
		} else {

			render_template('add.html', array_merge($_POST, [
				"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
			]));
		}

	}
}

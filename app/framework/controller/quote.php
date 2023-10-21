<?php

namespace Controller;

// use \Ramsey\Uuid\Uuid;
use \MailchimpMarketing\ApiClient;
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

		// !d($params["slug"], $quote["slug"]);
		// exit;

		// redirect to canonical URL
		if ($params["slug"] != $quote["slug"]) {
			$f3->reroute(site_url("quote/{$quote["slug"]}"));
		}

		$related = $dataproxy->get_related_quotes($quote["id"]);
		// !d($related);
		if (!$related) {
			$related = array("results" => []);
		}

		// !d( $results );

		render_template('quote.html.twig', [
			"is_single_quote" => true,
			"quote" => $quote,
			"related" => $related["results"],
		]);
	}

	function add(\Base $f3, $params)
	{
		render_template('add.html.twig', [
			"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
		]);
	}

	function edit(\Base $f3, $params)
	{
		if (!isset($_GET["id"]) || !isset($_GET["key"])) {
			$f3->error(404);
		}

		global $dataproxy;
		$quote = $dataproxy->get_quote($_GET["id"], true);
		$quote_owner = $dataproxy->get_quote_owner($_GET["id"], $_GET["key"]);
		
		if (!$quote || !$quote_owner || $quote_owner[0]["modkey"] != $_GET["key"]) {
			$f3->error(404);
		}

		render_template('add.html.twig', [
			"edit_url" => site_url('mod'),
			"quote_id" => $quote["id"],
			"modkey" => $_GET["key"],
			"quote" => $quote["quote"],
			"by" => $quote["sayer"],
			"from" => $quote["submitter"],
			"tags" => implode(",", $quote["tags"]),
			"edit" => true
		]);
	}

	function update(\Base $f3, $params) {
		
		if (!isset($_POST["quote_id"]) || !isset($_POST["modkey"])) {
			$f3->error(404);
		}

		global $dataproxy;
		$quote = $dataproxy->get_quote($_POST["quote_id"], true);
		$quote_owner = $dataproxy->get_quote_owner($_POST["quote_id"], $_POST["modkey"]);
		
		if (!$quote || !$quote_owner || $quote_owner[0]["modkey"] != $_POST["modkey"]) {
			$f3->error(404);
		}

		$db = new \DB\SQL( 'mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD );
		
		$db_quote = new \DB\SQL\Mapper($db, 'quotes');
		$db_quote->load(array('id=?', $_POST["quote_id"]));
		
		if($db_quote->dry()) {
			// not exists
			$f3->error(404);
		}

		if (isset($_POST["is_delete"]) && $_POST["is_delete"] == "1") {
			
			$db_quote_owner = new \DB\SQL\Mapper($db, 'quote_owner');
			$db_quote_owner->load(array('quote_id=?', $db_quote->id));
			if(!$db_quote->dry()) {
				$db_quote_owner->erase();
			}
			$dataproxy->removeQuoteFromCache($db_quote);
			$db_quote->erase();

			render_template('jump.html.twig', [
				"message" => "Quote verwijderd.",
				"jump_url" => site_url(),
				"jump_url_text" => "Naar home"
			]);

			exit(0);
		}

		$quote = trim($_POST["quote"]);
		$slug = slugify($quote, 200);
		$sayer = trim($_POST["by"]);
		$submitter = trim($_POST["from"]);
		$tags = implode(",", array_map("tagify", explode(",", $_POST["tags"])));

		$db_quote->slug = $slug;
		$db_quote->quote = $quote;
		$db_quote->quote_lc = strtolower($quote);
		$db_quote->sayer = $sayer;
		$db_quote->sayer_lc = strtolower($sayer);
		$db_quote->sayer_slug = slugify($sayer);
		$db_quote->submitter = $submitter;
		$db_quote->submitter_lc = strtolower($submitter);
		$db_quote->submitter_slug = slugify($submitter);
		$db_quote->tags = $tags;
		$db_quote->tags_lc = strtolower($tags);
		$db_quote->save();

		render_template('jump.html.twig', [
			"message" => "Quote geüpdatet.",
			"jump_url" => site_url("/quote/{$slug}"),
			"jump_url_text" => "Bekijk de quote"
		]);
	}

	function store(\Base $f3, $params)
	{
		global $dataproxy;

		$verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=" . $_POST["rtoken"] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$response = json_decode(file_get_contents($verify_url), true);

		if ($response['success'] == true) {
		
			$db = new \DB\SQL( 'mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD );

			$quote = trim($_POST["quote"]);
			$slug = slugify($quote, 200);
			$sayer = trim($_POST["by"]);
			$submitter = trim($_POST["from"]);
			$tags = implode(",", array_map("tagify", explode(",", $_POST["tags"])));
			
			$email = trim($_POST["email"]);
			// @todo validate email 
			// $modkey = Uuid::uuid4();
			$modkey = uniqid("mod", true);
			
			$db_quote = new \DB\SQL\Mapper($db, 'quotes');
			$db_quote->import_id = 0;
			$db_quote->created = date('Y-m-d H:i:s');
			$db_quote->slug = $slug;
			$db_quote->quote = $quote;
			$db_quote->quote_lc = strtolower($quote);
			$db_quote->sayer = $sayer;
			$db_quote->sayer_lc = strtolower($sayer);
			$db_quote->sayer_slug = slugify($sayer);
			$db_quote->submitter = $submitter;
			$db_quote->submitter_lc = strtolower($submitter);
			$db_quote->submitter_slug = slugify($submitter);
			$db_quote->tags = $tags;
			$db_quote->tags_lc = strtolower($tags);
			$db_quote->save();

			$quote_id = $db_quote->id;
			$quote_link = site_url('/quote/' . $slug);

			$db_quote_owner = new \DB\SQL\Mapper($db, 'quote_owner');
			$db_quote_owner->quote_id = $quote_id;
			$db_quote_owner->email = $email;
			$db_quote_owner->ip = $_SERVER['REMOTE_ADDR'];
			$db_quote_owner->modkey = $modkey;
			$db_quote_owner->save();

			$html = "<blockquote><p>{$quote}</p><cite>{$sayer}</cite></blockquote><ul>";
			foreach(explode(",", $tags) as $tag) {
				$html .= "<li>{$tag}</li>";
			}
			$html .= "</ul>";

			// mail to topquote
			try {
				$mail = $dataproxy->get_mailer();
				$mail->addAddress(TO_EMAIL, 'topquote');
				$mail->Subject = "Nieuwe quote van {$sayer}, opgeslagen door {$submitter}";
				$mail->msgHTML($html);
				$mail->send();	
			} catch (\Exception $e) {
				error_log("Mailer Error: {$mail->ErrorInfo}");
			}

			// mail to submitter
			$html = "
				<blockquote>
					<p>{$quote}</p>
					<cite>{$sayer}</cite>
				</blockquote>
				<hr>
				<p>&#128279; De link naar je quote. Delen maar! &#128522;<br><a href=\"{$quote_link}\">{$quote_link}</a></p>
				<p>&#9881;&#65039; Beheren: <a href=\"" . site_url('mod') . "?key={$modkey}&id={$quote_id}\">Beheer deze quote</a></p>
				";
		
			try {
				$mail = $dataproxy->get_mailer();
				$mail->addAddress($email);
				$mail->Subject = "Je opgeslagen quote van {$sayer} (beheer link)";
				$mail->msgHTML($html);
				$mail->send();
			} catch (\Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}

			// add to Mailchimp 
			try {
				$client = new ApiClient();
				$client->setConfig([
					'apiKey' => MAILCHIMP_API_KEY,
					'server' => MAILCHIMP_SERVER_PREFIX,
				]);
		
				$response = $client->lists->addListMember(MAILCHIMP_LIST_ID, [
					"email_address" => $email,
					"merge_fields" => [
						"FNAME" => $submitter ?? explode("@", $email)[0]
					],
					"status" => "subscribed",
				]);

			} catch (\Exception $e) {
				error_log('Mailchimp error: ' . $e->getMessage());
			}			

			render_template('jump.html.twig', [
				"message" => "Quote opgeslagen.",
				"jump_url" => site_url("/quote/{$slug}"),
				"jump_url_text" => "Bekijk de quote"
			]);
		
		} else {

			render_template('add.html.twig', array_merge($_POST, [
				"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
			]));
		}

	}
}

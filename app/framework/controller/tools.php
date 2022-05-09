<?php

namespace Controller;

use \MailchimpMarketing\ApiClient;

class Tools
{
	function rank(\Base $f3, $params)
	{
		set_time_limit(180);
		
		$this->rank_tags($f3, $params);

		$this->rank_sayers($f3, $params);

		$this->rank_submitters($f3, $params);
	}

	function clear_cache(\Base $f3, $params)
	{
		try {
			$redis = new \Redis();
			$redis->connect('cache', 6379);
			$redis->flushDB();
		} catch (\Exception $e) {
			error_log($e->getMessage());
		}
	}

	function rank_tags(\Base $f3, $params)
	{

		$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

		$tags_query = $db->exec("
			SELECT tags_lc   
			FROM quotes 
		");

		$tags = array();
		foreach ($tags_query as $tags_result) {
			$tags_split = array_map("trim", explode(",", $tags_result['tags_lc']));
			foreach ($tags_split as $tag) {
				if (empty($tag)) continue;
				if (!isset($tags[$tag])) {
					$tags[$tag] = array(
						"tag" => $tag,
						"count" => 0
					);
				}
				$tags[$tag]["count"]++;
			}
		}

		$db_tag = new \DB\SQL\Mapper($db, 'tag_rank');
		foreach ($tags as $tag) {
			$db_tag->reset();
			$db_tag->load(array('tag=?', $tag["tag"]));
			if ($db_tag->dry()) {
				$db_tag->tag = $tag["tag"];
			}
			$db_tag->amount = $tag["count"];
			$db_tag->save();
		}
	}

	function rank_sayers(\Base $f3, $params)
	{

		$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

		$sayers_query = $db->exec("
			SELECT sayer   
			FROM quotes 
		");

		$sayers = array();
		foreach ($sayers_query as $sayer) {
			if (empty($sayer)) continue;
			$key = strtolower(trim($sayer['sayer']));
			if (!isset($sayers[$key])) {
				$sayers[$key] = array(
					"sayer" => $sayer['sayer'],
					"count" => 0
				);
			}
			$sayers[$key]["count"]++;
		}

		$sayer_rank = new \DB\SQL\Mapper($db, 'sayer_rank');
		foreach ($sayers as $key => $sayer) {
			$sayer_rank->reset();
			$sayer_rank->load(array('sayer=?', $key));
			if ($sayer_rank->dry()) {
				$sayer_rank->sayer = $sayer["sayer"];
			}
			$sayer_rank->amount = $sayer["count"];
			$sayer_rank->save();
		}
	}

	function rank_submitters(\Base $f3, $params)
	{

		$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

		$submitters_query = $db->exec("
			SELECT submitter    
			FROM quotes 
		");

		$submitters = array();
		foreach ($submitters_query as $submitter) {
			if (empty($submitter)) continue;
			$key = strtolower(trim($submitter['submitter']));
			if (!isset($submitters[$key])) {
				$submitters[$key] = array(
					"submitter" => $submitter['submitter'],
					"count" => 0
				);
			}
			$submitters[$key]["count"]++;
		}

		$submitter_rank = new \DB\SQL\Mapper($db, 'submitter_rank');
		foreach ($submitters as $key => $submitter) {
			$submitter_rank->reset();
			$submitter_rank->load(array('submitter=?', $key));
			if ($submitter_rank->dry()) {
				$submitter_rank->submitter = $submitter["submitter"];
			}
			$submitter_rank->amount = $submitter["count"];
			$submitter_rank->save();
		}
	}

	function import(\Base $f3, $params)
	{

		$jsonData = file(BASE_DIR . '/export.ndjson');
		$data = array_map('json_decode', $jsonData);
		// !d($data);

		$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

		$n = 1;

		$db_quote = new \DB\SQL\Mapper($db, 'quotes');
		$db_quote_owner = new \DB\SQL\Mapper($db, 'quote_owner');

		$n = 0;
		$quote_amount = 0;
		$quote_owner_amount = 0;

		foreach ($data as $quote) {
			$n++;

			if ($quote->_type == "quote") {
				$quote_amount++;

				$time = strtotime($quote->created);
				$tags = implode(",", array_map("trim", $quote->tags ?? [])) ?? "";
				$slug = slugify($quote->quote, 200);
				$hits = isset($quote->hits) ? (int) $quote->hits : 0;
				$likes = isset($quote->likes) ? (int) $quote->likes : 0;

				$db_quote->reset();
				$db_quote->load(array('import_id=?', $quote->_id));

				if (!$db_quote->dry()) {
					// exists
					continue;
				}

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
					tags_lc,
					hits,
					likes
					) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
					$quote->_id,
					date('Y-m-d H:i:s', $time),
					$slug,
					$quote->quote,
					strtolower($quote->quote),
					$quote->sayer,
					strtolower($quote->sayer),
					slugify($quote->sayer),
					$quote->submitter,
					strtolower($quote->submitter),
					slugify($quote->submitter),
					$tags,
					strtolower($tags),
					$hits,
					$likes
				]);
			}


			if ($quote->_type == "quote_owner") {
				$quote_owner_amount++;
				$quote_owner = $quote;
				// {
				// 	"_createdAt":"2022-01-01T10:41:55Z",
				// 	"_id":"OFfCN90hHBAVvgweCLOPqh",
				// 	"_rev":"OFfCN90hHBAVvgweCLOPpn",
				// 	"_type":"quote_owner",
				// 	"_updatedAt":"2022-01-01T10:41:55Z",
				// 	"created":"2022-01-01T10:41:54+00:00",
				// 	"email":"hesterombre@gmail.com",
				// 	"ip":"80.60.243.113",
				// 	"modkey":"0e404ddf-657c-4d10-8a8b-10a6de2e2dbd",
				// 	"quote_id":"7ZC24o5nD1sX9AsxZmywVl"
				// 	}


				$db_quote->reset();
				$db_quote->load(array('import_id=?', $quote_owner->quote_id));

				if (!$db_quote->dry()) {
					$db_quote_owner->reset();
					$db_quote_owner->load(array('quote_id=?', $db_quote->id));

					if ($db_quote_owner->dry()) {
						$db_quote_owner->quote_id = $db_quote->id;
						$db_quote_owner->email = $quote_owner->email;
						$db_quote_owner->ip = $quote_owner->ip;
						$db_quote_owner->modkey = $quote_owner->modkey;
						$db_quote_owner->save();
						// !d($db_quote->import_id, $db_quote->id, $db_quote_owner->quote_id, $db_quote_owner->modkey);
					}
				} else {
					!d('not found', $quote_owner->quote_id);
				}
			}
		}

		// !d($quote_amount, $quote_owner_amount);

	}

	function feedback(\Base $f3, $params)
	{
		render_template('feedback.html', [
			"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
		]);
	}

	function save_feedback(\Base $f3, $params)
	{
		global $dataproxy;

		$verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=" . $_POST["rtoken"] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$response = json_decode(file_get_contents($verify_url), true);
		
		if ($response['success'] == true) {

			if (!filter_var($email = $_POST["email"], FILTER_VALIDATE_EMAIL)) {
				exit(0);
			}

			$html = "<p>" . strip_tags($_POST["message"]) . "</p>";

			// mail to topquote
			$mail = $dataproxy->get_mailer();
			$mail->addReplyTo($email, $_POST["from"]);
			$mail->addAddress('josfaber@me.com', 'topquote');
			$mail->Subject = "Topquote feedback van " . $_POST["from"];
			$mail->msgHTML($html);
			$mail->send();

			render_template('jump.html', [
				"message" => "Bericht verzonden.",
				"jump_url" => site_url(),
				"jump_url_text" => "Terug naar home"
			]);
			exit(0);
		}

		render_template('feedback.html', [
			"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
		]);
	}

	function sitemap(\Base $f3, $params)
	{
		global $dataproxy;

		$cache_key = 'sitemap';
		$cache_time = 60 * 60 * 24;
		if ($sitemap = $dataproxy->from_cache($cache_key)) {
			echo json_decode($sitemap, true);
			exit;
		}

		$now = date("Y-m-d\TH:i:sP");
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL; 
		
		$sitemap .= '<url>' . PHP_EOL . '	<loc>https://topquote.nl</loc>' . PHP_EOL . '	<lastmod>' . $now . '	</lastmod>' . PHP_EOL . '</url>' . PHP_EOL;
		
		foreach([ "frikandellenbos", "poep", "rusland", "amerika", "kleuter", "opvoeding", "eten", "radio", "tv", "internet", "maandag", "dinsdag", "woensdag", "vrijdag",
			"aarde", "natuur", "geweld", "sex", "game", "bijbel", "geloof", "jinek", "britt", "dekker", "food", "voetbal", "jan smit", "nederland", "bekend", "geld", "porno",
			"idee"
		] as $term) {
			$sitemap .= '<url>' . PHP_EOL . '	<loc>https://topquote.nl/search/' . $term . '</loc>' . PHP_EOL . '	<lastmod>' . $now . '	</lastmod>' . PHP_EOL . '</url>' . PHP_EOL;
		}

		$all_quotes = $dataproxy->get_all_quotes_slugs();
		foreach ($all_quotes as $quote) {
			$sitemap .= '<url>' . PHP_EOL;
			$sitemap .= '	<loc>https://topquote.nl/quote/' . $quote["slug"] . '</loc>' . PHP_EOL;
			$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
			$sitemap .= '</url>' . PHP_EOL;
		}

		$all_single_tags = $dataproxy->get_all_tags_slugs();
		foreach($all_single_tags as $tag) {
			$sitemap .= '<url>' . PHP_EOL;
			$sitemap .= '	<loc>https://topquote.nl/quotes/tag/' . $tag . '</loc>' . PHP_EOL;
			$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
			$sitemap .= '</url>' . PHP_EOL;
		}

		$all_sayers = $dataproxy->get_all_sayers_slugs();
		foreach($all_sayers as $quote) {
			$sitemap .= '<url>' . PHP_EOL;
			$sitemap .= '	<loc>https://topquote.nl/quotes/by/' . $quote["sayer_slug"] . '</loc>' . PHP_EOL;
			$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
			$sitemap .= '</url>' . PHP_EOL;
		}

		$all_submitters = $dataproxy->get_all_submitters_slugs();
		foreach($all_submitters as $quote) {
			$sitemap .= '<url>' . PHP_EOL;
			$sitemap .= '	<loc>https://topquote.nl/quotes/from/' . $quote["submitter_slug"] . '</loc>' . PHP_EOL;
			$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
			$sitemap .= '</url>' . PHP_EOL;
		}
		
		$sitemap .= '</urlset>';

		$dataproxy->to_cache($cache_key, json_encode($sitemap), $cache_time);
		echo $sitemap;
	}
	
	// function test1(\Base $f3, $params) 
	// {
	// 	try {
	// 		$client = new ApiClient();
	// 		$client->setConfig([
	// 			'apiKey' => MAILCHIMP_API_KEY,
	// 			'server' => MAILCHIMP_SERVER_PREFIX,
	// 		]);
	
	// 		$email = 'test2@topquote.nl';
	
	// 		$response = $client->lists->addListMember(MAILCHIMP_LIST_ID, [
	// 			"email_address" => $email,
	// 			"merge_fields" => [
	// 			  "FNAME" => explode("@", $email)[0]
	// 			],
	// 			"status" => "subscribed",
	// 		]);
	
	// 		!d($response);

	// 	} catch (\Exception $e) {
	// 		!d($e->getMessage());
	// 	}
	// }

	// function img(\Base $f3, $params)
	// {
	// 	!d($params);

	// 	global $dataproxy;
	// 	$quote = $dataproxy->get_quote($params["id"]);

	// 	if (!$quote) {
	// 		exit(0);
	// 	}

	// 	// function tryText($size, $font, $quote, $w, $h) {
	// 	// 	$box 	= imagettfbbox($size, 0, $font, $quote);
	// 	// 	$box_h 	= imagettfbbox($size, 0, $font, "Wdp");
	// 	// 	$tw 	= abs(max($box[2], $box[4]));
	// 	// 	$th 	= abs(max($box[5], $box[7]));
		
	// 	// 	if ($tw < $w && $th < $h) {
	// 	// 		return array(
	// 	// 			"size" => $size,
	// 	// 			"tw" => $tw,
	// 	// 			"th" => $th + 36,
	// 	// 		);
	// 	// 	} else {
	// 	// 		return tryText($size - 1, $font, $quote, $w, $h);
	// 	// 	}
	// 	// }

	// 	$font =  BASE_DIR . '/assets/NHaasGroteskDSPro-55Rg.otf';
	// 	!d($font, function_exists('imagettfbbox'));
	// 	phpinfo();
	// 	$width = 1600;
	// 	$height = 900;

	// 	// header("Content-Type: image/png");

	// 	$im = imagecreate($width, $height);
	// 	$bg = imagecolorallocate($im, 0, 0, 0);
	// 	$fg = imagecolorallocate($im, 229, 0, 124);
	// 	imagefilledrectangle($im, 0, 0, $width, $height, $bg);

	// 	$t1 = tryText(100, $font, "Lorum ipsum allicandor lorum", $width, $height);

	// 	// imagepng($im, $filepath, 85);
	// 	imagepng($im);
	// 	imagedestroy($im);
	// }
}

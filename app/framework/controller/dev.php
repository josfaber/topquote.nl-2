<?php

namespace Controller;

class Dev {
	function import(\Base $f3, $params) {

		$jsonData = file(BASE_DIR . '/export.ndjson');
		$data = array_map('json_decode', $jsonData);
		// !d($data);

		$db = get_db();
		
		$n=1;
		foreach ($data as $quote) {
			if ($quote->_type != "quote") continue;
			
			// stdClass (14) (
			// 	public '_createdAt' -> string (20) "2022-04-22T12:51:29Z"
			// 	public '_id' -> string (22) "8Kxx6mS06JFrzlAqyzxca1"
			// 	public '_rev' -> string (22) "8Kxx6mS06JFrzlAqyzxcW2"
			// 	public '_type' -> string (5) "quote"
			// 	public '_updatedAt' -> string (20) "2022-04-22T12:51:29Z"
			// 	public 'created' -> string (25) "2022-04-22T14:51:29+02:00"
			// 	public 'quote' -> string (37) "Als koekjes warm zijn dan is het goed"
			// 	public 'quote_lc' -> string (37) "als koekjes warm zijn dan is het goed"
			// 	public 'sayer' -> string (4) "Erik"
			// 	public 'sayer_lc' -> string (4) "erik"
			// 	public 'submitter' -> string (3) "Jos"
			// 	public 'submitter_lc' -> string (3) "jos"
			// 	public 'tags' -> array (1) [
			// 		0 => string (3) "TSG"
			// 	]
			// 	public 'tags_lc' -> array (1) [
			// 		0 => string (3) "tsg"
			// 	]
			// )
			
			$time = strtotime($quote->_createdAt);
			$tags = implode(",", array_map("trim", $quote->tags ?? [])) ?? "";
			
			if ($n++ == 10) !s($tags, $quote->_createdAt, date('Y-m-d H:i:s', $time));

			$slug = slugify($quote->quote, 200);
			// !d( $slug );
			$result = $db->exec('SELECT id FROM quotes WHERE slug = ?', [ $slug ]);
			if ($db->count() == 0) {
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
						strtolower($tags)
					]);
			} else {
				// s('already exists');
			}
			// echo $db->log();
		}

		// $db->exec('SELECT brandName FROM wherever');


	}
}
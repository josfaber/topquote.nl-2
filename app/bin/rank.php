<?php 
define("BASE_DIR", 		__DIR__ . "/..");
define("FW_DIR", 		__DIR__ . "/../framework");

require BASE_DIR . '/vendor/autoload.php';
// require FW_DIR . '/dataproxy.php';
require FW_DIR . '/defines.php';
require FW_DIR . '/functions.php';



function rank_tags()
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

function rank_sayers()
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

function rank_submitters()
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

rank_tags();
rank_sayers();
rank_submitters();

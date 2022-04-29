<?php

namespace TopQuote;

class DataProxy
{

	public static $ORDER_CREATED = "created";
	public static $ORDER_LIKES = "likes";
	public static $ORDER_RANDOM = "random";

	public static $ORDER_ASC = "ASC";
	public static $ORDER_DESC = "DESC";

	public $db;

	public $redis;

	public function __construct()
	{
		$this->db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
		$this->redis = new \Redis();
		$this->redis->connect('cache', 6379);
	}

	private function from_cache($key)
	{
		try {
			// $this->redis->del($key);
			$this->redis->get($key);
			return $this->redis->get($key);
		} catch (\Exception $e) {
			error_log($e->getMessage());
			return false;
		}
	}

	private function to_cache($key, $value, $ttl = 60 * 5)
	{
		try {
			$this->redis->setex($key, $ttl, $value);
		} catch (\Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function get_quote($id)
	{
		$cache_key = 'quote_' . $id;
		$cache_time = 60 * 60;
		if ($quote = $this->from_cache($cache_key)) { return json_decode($quote, true); }

		$results = $this->db->exec("
			SELECT * 
			FROM quotes 
			WHERE id = ? 
			LIMIT 1
		", [$id]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$quote = $this->hydrate_quote($results[0]);
		$this->to_cache($cache_key, json_encode($quote), $cache_time);

		return $quote;
	}

	public function get_quote_by_slug($slug)
	{
		$cache_key = 'quote_' . md5($slug);
		$cache_time = 60 * 60;
		if ($quote = $this->from_cache($cache_key)) { return json_decode($quote, true); }

		$results = $this->db->exec("
			SELECT *  
			FROM quotes 
			WHERE slug = ? 
			OR import_id = ? 
			LIMIT 1
		", [$slug, $slug]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$quote = $this->hydrate_quote($results[0]);
		$this->to_cache($cache_key, json_encode($quote), $cache_time);

		return $quote;
	}

	public function get_quotes($by = null, $from = null, $tag = null, $orderby = 'created', $order = 'DESC', $quotes_per_page = QUOTES_PER_PAGE, $page = 1, $AND = "")
	{
		$key_post = ($by ?? "") . '-' . ($from ?? "") . '-' . ($tag ?? "") . '-' . ($orderby ?? "") . '-' . ($order ?? "") . '-' . ($quotes_per_page ?? "") . '-' . ($page ?? "") . '-' . ($AND ?? "");
		// !d($key_post, md5($key_post));
		$cache_key = 'quotes_' . md5($key_post);
		$cache_time = $orderby == self::$ORDER_RANDOM ? 30 : 60 * 5;

		if ($results = $this->from_cache($cache_key)) { 
			// !d("redis");
			return [ "results" => json_decode($results, true) ];
		}

		$offset_base = ($page - 1) * $quotes_per_page;

		$SELECT = "SELECT * ";

		$FROM = "FROM quotes ";

		$WHERE = "WHERE 1";
		$bounds = [];
		if ($by != null) {
			$WHERE = "WHERE sayer_slug = :sayer ";
			$bounds = [":sayer" => $by];
		}
		if ($from != null) {
			$WHERE = "WHERE submitter_slug = :submitter ";
			$bounds = [":submitter" => $from];
		}
		if ($tag != null) {
			$WHERE = "WHERE tags_lc LIKE :tag ";
			$bounds = [":tag" => "%{$tag}%"];
		}

		$LIMIT = "LIMIT {$offset_base}, {$quotes_per_page}";

		switch ($orderby) {
			case self::$ORDER_LIKES:
				$ORDER = "ORDER BY likes {$order}";
				break;

			case self::$ORDER_RANDOM:
				$ORDER = "ORDER BY RAND()";
				break;

			case self::$ORDER_CREATED:
			default:
				$ORDER = "ORDER BY created {$order}";
				break;
		}

		$sql = "
			{$SELECT}
			{$FROM}
			{$WHERE}
			{$AND}
			{$ORDER}
			{$LIMIT}
		";

		// !d($key_post, $sql);

		$results = $this->db->exec($sql, $bounds);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(array($this, 'hydrate_quote'), $results);
		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return [
			"results" => $results
		];
	}

	function hydrate_quote($quote)
	{
		$quote["tags"] = explode(",", $quote["tags"]);
		$quote["tags_links"] = implode("", array_map(function ($tag) {
			return "<a class=\"tag\" href='" . site_url("quotes/tag") . "/" . strtolower(trim($tag)) . "'>{$tag}</a>";
		}, $quote["tags"]));
		$quote["link"] = $this->get_quote_link($quote);
		$quote["sayer_link"] = $this->get_sayer_link($quote);
		$quote["submitter_link"] = $this->get_submitter_link($quote);
		$quote["ago"] = time_elapsed_string($quote["created"]);
		return $quote;
	}

	function get_quote_link($quote)
	{
		if (is_string($quote)) {
			$quote = $this->get_quote($quote);
		}
		return site_url("/quote/{$quote['slug']}");
	}

	function get_sayer_link($quote)
	{
		if (is_string($quote)) {
			$quote = $this->get_quote($quote);
		}
		return site_url("/quotes/by/{$quote['sayer_slug']}");
	}

	function get_submitter_link($quote)
	{
		if (is_string($quote)) {
			$quote = $this->get_quote($quote);
		}
		return site_url("/quotes/from/{$quote['submitter_slug']}");
	}

	public function get_top_tags()
	{
		$cache_key = 'top_tags';
		$cache_time = 60 * 60 * 4;
		if ($top_tags = $this->from_cache($cache_key)) { return json_decode($top_tags, true); }

		$results = $this->db->exec("
			SELECT tag, amount 
			FROM `tag_rank` 
			ORDER BY amount DESC
			LIMIT 12;
		");

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return $results;
	}

	public function get_top_sayers()
	{
		$cache_key = 'top_sayers';
		$cache_time = 60 * 60 * 4;
		if ($top_sayers = $this->from_cache($cache_key)) { return json_decode($top_sayers, true); }

		$WHERE = rand(0, 3) < 3 ? "WHERE 1" : "WHERE LOWER(sayer) <> 'jos'";
		$results = $this->db->exec("
			SELECT sayer, amount 
			FROM `sayer_rank` 
			{$WHERE}
			ORDER BY amount DESC 
			LIMIT 10;
		");

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(function ($result) {
			return array(
				"sayer" => $result["sayer"],
				"sayer_slug" => slugify($result["sayer"]),
				"amount" => $result["amount"],
			);
		}, $results);

		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return $results;
	}

	public function get_top_submitters()
	{
		$cache_key = 'top_submitters';
		$cache_time = 60 * 60 * 4;
		if ($top_submitters = $this->from_cache($cache_key)) { return json_decode($top_submitters, true); }

		$WHERE = rand(0, 3) < 3 ? "WHERE 1" : "WHERE LOWER(submitter) <> 'jos'";
		$results = $this->db->exec("
			SELECT submitter, amount 
			FROM `submitter_rank` 
			{$WHERE}
			ORDER BY amount DESC
			LIMIT 10;
		");

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(function ($result) {
			return array(
				"submitter" => $result["submitter"],
				"submitter_slug" => slugify($result["submitter"]),
				"amount" => $result["amount"],
			);
		}, $results);

		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return $results; 
	}
}

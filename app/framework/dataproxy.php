<?php

namespace TopQuote;

class DataProxy {

	public static $ORDER_CREATED = "created";
	public static $ORDER_LIKES = "likes";
	public static $ORDER_RANDOM = "random";
	
	public static $ORDER_ASC = "ASC";
	public static $ORDER_DESC = "DESC";

	public $db;

	public function __construct() {
		$this->db = new \DB\SQL( 'mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD );
	}

	public function get_quote($id) {
		$results = $this->db->exec("
			SELECT * 
			FROM quotes 
			WHERE id = ? 
			LIMIT 1
		", [$id]);
		
		if (!$results || $this->db->count() == 0) {
			return false;
		}

		return $this->hydrate_quote($results[0]);
	}

	public function get_quote_by_slug($slug) {
		$results = $this->db->exec("
			SELECT id, created, slug, quote, sayer, submitter, tags 
			FROM quotes 
			WHERE slug = ? 
			OR import_id = ? 
			LIMIT 1
		", [$slug, $slug]);
		
		if (!$results || $this->db->count() == 0) {
			return false;
		}

		return $this->hydrate_quote($results[0]);
	}

	public function get_random_quote() {
		$results = $this->db->exec("
			SELECT * 
			FROM quotes 
			ORDER BY RAND() 
			LIMIT 1
		");
		
		if (!$results || $this->db->count() == 0) {
			return false;
		}

		return $this->hydrate_quote($results[0]);
	}

	public function get_quotes($by = null, $from = null, $tag = null, $orderby = 'created', $order = 'DESC', $quotes_per_page = QUOTES_PER_PAGE, $page = 1) {
		$offset_base = ($page - 1) * $quotes_per_page;
		$SELECT = "SELECT * ";
		$FROM = "FROM quotes ";
		$LIMIT = "LIMIT {$offset_base}, {$quotes_per_page}";

		switch($orderby) {
			case self::$ORDER_CREATED:
			default:
				$ORDER = "ORDER BY created {$order}";
				break;

			case self::$ORDER_LIKES:
				$ORDER = "ORDER BY likes {$order}";
				break;
		}

		$results = $this->db->exec("
			{$SELECT}
			{$FROM}
			{$ORDER}
			{$LIMIT}
		");
		
		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(array($this, 'hydrate_quote'), $results);

		return $results;
	}

	function hydrate_quote($quote) {
		$quote["tags"] = explode(",", $quote["tags"]);
		$quote["link"] = $this->get_quote_link($quote);
		$quote["ago"] = time_elapsed_string($quote["created"]);
		return $quote;
	}

	function get_quote_link($quote) {
		if (is_string($quote)) {
			$quote = $this->get_quote($quote);
		}
		return site_url("/quote/{$quote['slug']}");
	}

}
<?php

namespace TopQuote;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use DB;
use TopQuote\Model\QuoteModel;

class DataProxy
{

	public static $ORDER_CREATED = "created";
	public static $ORDER_LIKES = "likes";
	public static $ORDER_RANDOM = "random";

	public static $ORDER_ASC = "ASC";
	public static $ORDER_DESC = "DESC";

	public $db;

	public function __construct()
	{
		$this->db = new DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	}

	public function from_cache($key)
	{
		// @todo implement new
		return false;
	}

	public function to_cache($key, $value, $ttl = 60 * 5)
	{
		// @todo implement new
		return false;
	}

	public function del_cache($key)
	{
		// @todo implement new
		return false;
	}

	public function removeQuoteFromCache($quote)
	{
		$this->del_cache('quote_' . $quote->id);
		$this->del_cache('quote_' . md5($quote->slug));
	}

	public function vote($quote_id)
	{
		$identifier = $_SERVER['REMOTE_ADDR'];

		$db_vote = new \DB\SQL\Mapper($this->db, 'vote_log');
		$db_vote->reset();
		$db_vote->load(array('quote_id=? AND identifier=?', $quote_id, $identifier));
		if (!$db_vote->dry()) {
			// already voted
			return array("message" => "already voted");
		}

		$db_quote = new \DB\SQL\Mapper($this->db, 'quotes');
		$db_quote->load(array('id=?', $quote_id));
		if (!$db_quote->dry()) {
			$db_quote->likes = $db_quote->likes + 1;
			$db_quote->save();

			$db_vote->quote_id = $quote_id;
			$db_vote->identifier = $identifier;
			$db_vote->save();

			// clear cache keys 
			$this->del_cache('quote_' . md5($db_quote->slug));
			$this->del_cache('quote_' . $quote_id);

			return array("message" => "voted", "quote_id" => (int)$quote_id, "likes" => $db_quote->likes);
		}

		return array("message" => "quote not found");
	}

	public function get_quote($id, $bypass_cache = false)
	{
		$cache_key = 'quote_' . $id;
		$cache_time = 60 * 60;
		if (!$bypass_cache && $quote = $this->from_cache($cache_key)) {
			return json_decode($quote, true);
		}

		$results = $this->db->exec("
			SELECT * 
			FROM quotes 
			WHERE id = ? 
			LIMIT 1
		", [$id]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		/** @var QuoteModel */
		$quote = new QuoteModel($results[0]);
		$this->to_cache($cache_key, json_encode($quote), $cache_time);

		return $quote;
	}

	public function get_quote_owner($quote_id, $modkey)
	{
		$results = $this->db->exec("
			SELECT * 
			FROM quote_owner 
			WHERE quote_id = ? 
			AND modkey = ? 
			LIMIT 1
		", [$quote_id, $modkey]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		return $results;
	}

	public function get_group_owner($group_id, $modkey)
	{
		$results = $this->db->exec("
			SELECT * 
			FROM group_owner 
			WHERE group_id = ? 
			AND modkey = ? 
			LIMIT 1
		", [$group_id, $modkey]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		return $results;
	}

	public function get_quote_by_slug($slug)
	{
		$cache_key = 'quote_' . md5($slug);
		$cache_time = 60 * 60;
		if ($quote = $this->from_cache($cache_key)) {
			return json_decode($quote, true);
		}

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

		$quote = new QuoteModel($results[0]);
		$this->to_cache($cache_key, json_encode($quote), $cache_time);

		return $quote;
	}

	public function get_group_by_slug($slug)
	{
		$cache_key = 'group_' . md5($slug);
		$cache_time = 60 * 60;
		if ($group = $this->from_cache($cache_key)) {
			return json_decode($group, true);
		}

		$results = $this->db->exec("
			SELECT *  
			FROM groups 
			WHERE slug = ? 
			LIMIT 1
		", [$slug]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$group = $results[0];
		$this->to_cache($cache_key, json_encode($group), $cache_time);

		return $group;
	}

	public function get_group_by_id($id)
	{
		$results = $this->db->exec("
			SELECT *  
			FROM groups 
			WHERE id = ? 
			LIMIT 1
		", [$id]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$group = $results[0];

		return $group;
	}

	public function get_quotes($by = null, $from = null, $tag = null, $orderby = 'created', $order = 'DESC', $quotes_per_page = QUOTES_PER_PAGE, $page = 1, $AND = "", $group_id = null)
	{
		$key_post = ($by ?? "") . '-' . ($from ?? "") . '-' . ($tag ?? "") . '-' . ($orderby ?? "") . '-' . ($order ?? "") . '-' . ($quotes_per_page ?? "") . '-' . ($page ?? "") . '-' . ($AND ?? "");
		$cache_key = 'quotes_' . md5($key_post);
		$cache_time = $orderby == self::$ORDER_RANDOM ? 60 * 5 : 60 * 30;

		if ($results = $this->from_cache($cache_key)) {
			return ["results" => json_decode($results, true)];
		}

		$offset_base = ($page - 1) * $quotes_per_page;

		$SELECT = "SELECT * ";

		$FROM = "FROM quotes ";

		$WHERE = "WHERE 1";
		$bounds = [];
		if ($by != null) {
			$WHERE = "WHERE sayer_slug = :sayer OR sayer_slug = :sayer_slug ";
			$bounds = [":sayer" => $by, ":sayer_slug" => slugify($by)];
		}
		if ($from != null) {
			$WHERE = "WHERE submitter_slug = :submitter OR submitter_slug = :submitter_slug ";
			$bounds = [":submitter" => $from, ":submitter_slug" => slugify($from)];
		}
		if ($tag != null) {
			$WHERE = "WHERE tags LIKE :tag ";
			$bounds = [":tag" => "%{$tag}%"];
		}

		if (!is_null($group_id)) {
			$PRIVATE_GROUP = "";
			$WHERE = "WHERE group_id = :group_id ";
			$bounds = [":group_id" => $group_id];
		} else {
			$PRIVATE_GROUP = " AND is_private = 0 ";
		}

		$LIMIT = "LIMIT {$offset_base}, {$quotes_per_page}";
		if ($quotes_per_page == -1) {
			$LIMIT = "";
		}

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
			{$PRIVATE_GROUP}
			{$ORDER}
			{$LIMIT}
		";

		$results = $this->db->exec($sql, $bounds);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(function ($x) {
			return new QuoteModel($x);
		}, $results);
		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return [
			"results" => $results
		];
	}

	// public function search_quotes($terms = "", $quotes_per_page = QUOTES_PER_PAGE, $page = 1)
	public function search_quotes($terms = "")
	{
		// $key_post = ($terms ?? "") . '-' . ($quotes_per_page ?? "") . '-' . ($page ?? "");
		$key_post = ($terms ?? "");
		$cache_key = 'search_' . md5($key_post);
		$cache_time = 60 * 15;

		if ($results = $this->from_cache($cache_key)) {
			return ["results" => json_decode($results, true)];
		}

		// $offset_base = ($page - 1) * $quotes_per_page;

		// $LIMIT = "LIMIT {$offset_base}, {$quotes_per_page}";
		$LIMIT = " LIMIT 400 ";

		$termsAsTags = tagify($terms);

		$sql = "
			SELECT *, MATCH (quote_lc,sayer_lc,submitter_lc,tags) AGAINST (:terms IN NATURAL LANGUAGE MODE) AS score 
			FROM quotes 
			WHERE 1 = 2 
			OR MATCH (quote_lc,sayer_lc,submitter_lc,tags) AGAINST (:terms IN NATURAL LANGUAGE MODE) 
			OR MATCH (quote_lc,sayer_lc,submitter_lc,tags) AGAINST (:tags IN NATURAL LANGUAGE MODE) 
			OR sayer_lc LIKE :tags_like 
			OR submitter_lc LIKE :tags_like 
			OR tags LIKE :tags_like 
			OR quote_lc LIKE :terms_like 
			ORDER BY score DESC
			{$LIMIT}  
		";

		$results = $this->db->exec($sql, [
			":terms" => $terms,
			":terms_like" => "%" . $terms . "%",
			":tags" => $termsAsTags,
			":tags_like" => "%" . $termsAsTags . "%",
		]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(function ($x) {
			return new QuoteModel($x);
		}, $results);
		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return [
			"results" => $results
		];
	}

	public function get_related_quotes($quote_id)
	{
		$cache_key = 'related_to_' . $quote_id;
		$cache_time = 60 * 60 * 24;

		if ($results = $this->from_cache($cache_key)) {
			return ["results" => json_decode($results, true)];
		}

		$LIMIT = " LIMIT 20 ";

		$sql = "SELECT quote_lc, tags, sayer_lc FROM quotes WHERE id = :id LIMIT 1";
		$terms = $this->db->exec($sql, [":id" => $quote_id]);

		$sql = "
			SELECT *, 
				MATCH (quote_lc) AGAINST (:quote_lc IN NATURAL LANGUAGE MODE) AS quote_score, 
				MATCH (tags) AGAINST (:tags IN NATURAL LANGUAGE MODE) AS tags_score, 
				MATCH (sayer_lc) AGAINST (:sayer_lc IN NATURAL LANGUAGE MODE) AS sayer_score 
			FROM quotes 
			WHERE id <> :id AND (
				MATCH (quote_lc) AGAINST (:quote_lc IN NATURAL LANGUAGE MODE) 
				OR MATCH (tags) AGAINST (:tags IN NATURAL LANGUAGE MODE) 
				OR MATCH (sayer_lc) AGAINST (:sayer_lc IN NATURAL LANGUAGE MODE)
			) 
			ORDER BY quote_score DESC, tags_score DESC, sayer_score DESC
			{$LIMIT}  
		";

		// $results = $this->db->exec($sql, [":id" => $quote_id]);
		$results = $this->db->exec($sql, [
			":id" => $quote_id,
			":quote_lc" => $terms[0]["quote_lc"],
			":tags" => $terms[0]["tags"],
			":sayer_lc" => $terms[0]["sayer_lc"]
		]);

		if (!$results || $this->db->count() == 0) {
			return false;
		}

		$results = array_map(function ($x) {
			return new QuoteModel($x);
		}, $results);
		$this->to_cache($cache_key, json_encode($results), $cache_time);

		return [
			"results" => $results
		];
	}

	public function get_top_tags()
	{
		$cache_key = 'top_tags';
		$cache_time = 60 * 60 * 12;
		if ($top_tags = $this->from_cache($cache_key)) {
			return json_decode($top_tags, true);
		}

		$results = $this->db->exec("
			SELECT tag, amount 
			FROM `tag_rank` 
			ORDER BY amount DESC
			LIMIT 10;
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
		$cache_time = 60 * 60 * 12;
		if ($top_sayers = $this->from_cache($cache_key)) {
			return json_decode($top_sayers, true);
		}

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
		$cache_time = 60 * 60 * 12;
		if ($top_submitters = $this->from_cache($cache_key)) {
			return json_decode($top_submitters, true);
		}

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

	public function get_mailer()
	{
		$mailer = new PHPMailer();
		$mailer->isSMTP();
		$mailer->Host = SMTP_HOST;
		$mailer->SMTPAuth = true;
		$mailer->Username = SMTP_USER;
		$mailer->Password = SMTP_PASS;
		$mailer->SMTPKeepAlive = true;
		$mailer->Port = SMTP_PORT;
		if (!empty(SMTP_SECURE)) {
			$mailer->SMTPSecure = SMTP_SECURE;
		}
		$mailer->setFrom(FROM_EMAIL, 'topquote');
		return $mailer;
	}

	public function get_all_sayers_slugs()
	{
		$cache_key = 'all_sayers_slugs';
		$cache_time = 60 * 60 * 24;
		if ($all_sayers = $this->from_cache($cache_key)) {
			return json_decode($all_sayers, true);
		}

		$all_sayers = $this->db->exec("
			SELECT DISTINCT(sayer_slug) 
			FROM quotes 
			ORDER BY sayer_slug ASC
		");

		if (!$all_sayers || $this->db->count() == 0) {
			return false;
		}

		$this->to_cache($cache_key, json_encode($all_sayers), $cache_time);

		return $all_sayers;
	}

	public function get_all_submitters_slugs()
	{
		$cache_key = 'all_submitters_slugs';
		$cache_time = 60 * 60 * 24;
		if ($all_submitters = $this->from_cache($cache_key)) {
			return json_decode($all_submitters, true);
		}

		$all_submitters = $this->db->exec("
			SELECT DISTINCT(submitter_slug) 
			FROM quotes 
			ORDER BY submitter_slug ASC
		");

		if (!$all_submitters || $this->db->count() == 0) {
			return false;
		}

		$this->to_cache($cache_key, json_encode($all_submitters), $cache_time);

		return $all_submitters;
	}

	public function get_all_quotes_slugs()
	{
		$cache_key = 'all_quotes_slugs';
		$cache_time = 60 * 60 * 24;
		if ($all_quotes = $this->from_cache($cache_key)) {
			return json_decode($all_quotes, true);
		}

		$all_quotes = $this->db->exec("
			SELECT slug  
			FROM quotes 
			ORDER BY slug ASC
		");

		if (!$all_quotes || $this->db->count() == 0) {
			return false;
		}

		$this->to_cache($cache_key, json_encode($all_quotes), $cache_time);

		return $all_quotes;
	}

	public function get_all_tags_slugs()
	{
		$cache_key = 'all_tags_slugs';
		$cache_time = 60 * 60 * 24;
		if ($all_tags = $this->from_cache($cache_key)) {
			return json_decode($all_tags, true);
		}

		$all_tags = $this->db->exec("
			SELECT DISTINCT(tags_lc)   
			FROM quotes 
			ORDER BY tags_lc ASC
		");

		if (!$all_tags || $this->db->count() == 0) {
			return false;
		}

		$all_single_tags = [];
		foreach ($all_tags as $mtags) {
			$single_tags = explode(",", $mtags["tags_lc"]);
			foreach ($single_tags as $tag) {
				$all_single_tags[] = $tag;
			}
		}
		$all_single_tags = array_filter($all_single_tags, function ($tag) {
			return !empty($tag) && preg_match("/^[a-zA-Z0-9]+$/", $tag) == 1;
		});

		$this->to_cache($cache_key, json_encode($all_single_tags), $cache_time);

		return $all_single_tags;
	}
}

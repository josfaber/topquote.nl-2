<?php

namespace Controller;

class Quotes {


	/** 
	 * Default quotes list
	 */
	function index(\Base $f3, $params) {
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, null, null, $orderby, $order, QUOTES_PER_PAGE);

		// render
		render_template('quotes.html', [
			"list_title" => "Alle uitspraken",
			"list_url" => site_url('quotes'),
			"quotes" => $quotes["results"],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes by sayer
	 */
	function by(\Base $f3, $params) {
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes($params["slug"], null, null, $orderby, $order, QUOTES_PER_PAGE);
		
		render_template('quotes.html', [
			"list_title" => "Alle uitspraken van <span class=\"em\">{$quotes["results"][0]["sayer"]}</span>",
			"list_url" => site_url('quotes/by/' . $params["slug"]),
			"quotes" => $quotes["results"],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes from submitter
	 */
	function from(\Base $f3, $params) {
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, $params["slug"], null, $orderby, $order, QUOTES_PER_PAGE);

		render_template('quotes.html', [
			"list_title" => "Alle uitspraken opgeslagen door <span class=\"em\">{$quotes["results"][0]["submitter"]}</span>",
			"list_url" => site_url('quotes/from/' . $params["slug"]),
			"quotes" => $quotes["results"],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes with tag
	 */
	function tag(\Base $f3, $params) {
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, null, $params["slug"], $orderby, $order, QUOTES_PER_PAGE);

		render_template('quotes.html', [
			"list_title" => "Alle uitspraken met tag <span class=\"em\">{$params["slug"]}</span>",
			"list_url" => site_url('quotes/tag/' . $params["slug"]),
			"quotes" => $quotes["results"],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Search quotes
	 */
	function search(\Base $f3, $params) {
		global $assets_manifest;
		global $dataproxy;

		// get quotes
		$quotes = $dataproxy->search_quotes($params["terms"]);
		// !d($params);

		render_template('quotes.html', [
			"is_search" => true,
			"list_title" => "Alle uitspraken met <span class=\"em\">{$params["terms"]}</span>",
			"list_url" => site_url('quotes/search/' . $params["terms"]),
			"quotes" => $quotes ? $quotes["results"] : [],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}

}
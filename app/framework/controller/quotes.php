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
			"quotes" => $quotes["results"],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}

}
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
			"quotes" => $quotes,
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes by sayer
	 */
	function by(\Base $f3, $params) {
		global $assets_manifest;

		render_template('quotes.html', [
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes from submitter
	 */
	function from(\Base $f3, $params) {
		global $assets_manifest;

		render_template('quotes.html', [
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes with tag
	 */
	function tag(\Base $f3, $params) {
		global $assets_manifest;

		render_template('quotes.html', [
		], [], [site_url($assets_manifest["quotes.js"])]);
	}

}
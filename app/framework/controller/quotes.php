<?php

namespace Controller;

class Quotes
{


	/** 
	 * Default quotes list
	 */
	function index(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, null, null, $orderby, $order, QUOTES_PER_PAGE);

		// render
		render_template('quotes.html.twig', [
			"list_title" => "Alle uitspraken",
			"list_url" => site_url('quotes'),
			"quotes" => $quotes ? $quotes["results"] : [],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes by sayer
	 */
	function by(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes($params["slug"], null, null, $orderby, $order, QUOTES_PER_PAGE);
		$sayer = $quotes ? $quotes["results"][0]["sayer"] : $params["slug"];

		render_template('quotes.html.twig', [
			"list_title" => "Alle uitspraken van <span class=\"em\">{$sayer}</span>",
			"list_url" => site_url('quotes/by/' . $params["slug"]),
			"slide_url" => site_url('slide/by/' . $params["slug"]),
			"quotes" => $quotes ? $quotes["results"] : [],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes from submitter
	 */
	function from(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, $params["slug"], null, $orderby, $order, QUOTES_PER_PAGE);
		$submitter = $quotes ? $quotes["results"][0]["submitter"] : $params["slug"];

		render_template('quotes.html.twig', [
			"list_title" => "Alle uitspraken opgeslagen door <span class=\"em\">{$submitter}</span>",
			"list_url" => site_url('quotes/from/' . $params["slug"]),
			"slide_url" => site_url('slide/from/' . $params["slug"]),
			"quotes" => $quotes ? $quotes["results"] : [],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Quotes with tag
	 */
	function tag(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, null, $params["slug"], $orderby, $order, QUOTES_PER_PAGE);

		render_template('quotes.html.twig', [
			"list_title" => "Alle uitspraken met tag <span class=\"em\">{$params["slug"]}</span>",
			"list_url" => site_url('quotes/tag/' . $params["slug"]),
			"slide_url" => site_url('slide/tag/' . $params["slug"]),
			"quotes" => $quotes ? $quotes["results"] : [],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Search quotes
	 */
	function search(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get quotes
		$quotes = $dataproxy->search_quotes($params["terms"]);
		// !d($params);

		render_template('quotes.html.twig', [
			"is_search" => true,
			"list_title" => "Alle uitspraken met <span class=\"em\">{$params["terms"]}</span>",
			"list_url" => site_url('quotes/search/' . $params["terms"]),
			"quotes" => $quotes ? $quotes["results"] : [],
		], [], [site_url($assets_manifest["quotes.js"])]);
	}


	/** 
	 * Slide
	 */
	function slide(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		if (!in_array($params["filter"], ["by", "from", "tag"])) {
			$f3->error(404);
		}

		switch ($params["filter"]) {
			case "by":
				$quotes = $dataproxy->get_quotes($params["slug"], null, null, 'random', $order, 50);
				$title_inject = "van <span class=\"em\">{$params["slug"]}</span>";
				break;
			case "from":
				$quotes = $dataproxy->get_quotes(null, $params["slug"], null, 'random', $order, 50);
				$title_inject = "opgeslagen door <span class=\"em\">{$params["slug"]}</span>";
				break;
			case "tag":
				$quotes = $dataproxy->get_quotes(null, null, $params["slug"], 'random', $order, 50);
				$title_inject = "met tag <span class=\"em\">{$params["slug"]}</span>";
				break;
		}

		render_template('slide.html.twig', [
			"list_title" => "Alle uitspraken {$title_inject} als slideshow",
			"list_url" => site_url('quotes/tag/' . $params["slug"]),
			"quotes" => $quotes ? array_map(function ($x) {
				return $x->toArray();
			}, $quotes["results"]) : [],
			"filter" => $params["filter"],
			"slug" => $params["slug"],
		], [], [site_url($assets_manifest["slide.js"])]);
	}
}

<?php

namespace Controller;

use Controller\Base;

class Quotes extends Base
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
	function sayer(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes($params["slug"], null, null, $orderby, $order, QUOTES_PER_PAGE);
		$sayer = $quotes ? $quotes["results"][0]->getSayer() : $params["slug"];

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
	function submitter(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		// get quotes
		$quotes = $dataproxy->get_quotes(null, $params["slug"], null, $orderby, $order, QUOTES_PER_PAGE);
		$submitter = $quotes ? $quotes["results"][0]->getSubmitter() : $params["slug"];

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
	 * Quotes from group
	 */
	function group(\Base $f3, $params)
	{
		global $assets_manifest;
		global $dataproxy;

		// get order properties
		global $orderby, $order;

		$group = $dataproxy->get_group_by_slug($params["slug"]);

		if (!$group || empty($group)) {
			$f3->error(404);
		}

		// wrong group (will redirect in next step) 
		if ($f3->get('SESSION.tq_group_id') != $group["id"] || $f3->get('SESSION.tq_group_h') != $group["hash"]) {
			$f3->set('SESSION.tq_group_id', null);
			$f3->set('SESSION.tq_group_h', null);
		}

		// no session information
		if (!$f3->get('SESSION.tq_group_id') || !$f3->get('SESSION.tq_group_h')) {
			$f3->reroute(site_url('login/' . $params["slug"]));
			exit;
		}

		// get quotes
		$quotes = $dataproxy->get_quotes(null, null, null, $orderby, $order, QUOTES_PER_PAGE, 1, "", $group["id"]);

		render_template('quotes.html.twig', [
			"list_title" => "Alle uitspraken in de groep <span class=\"em\">{$params["slug"]}</span>",
			"list_url" => site_url('quotes/group/' . $params["slug"]),
			"slide_url" => site_url('slide/group/' . $params["slug"]),
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

		if (!in_array($params["filter"], ["by", "from", "tag", "group"])) {
			$f3->error(404);
		}

		/**
		 * @todo if group and not logged in to group -> redirect to group login
		 */
		if ($params["filter"] == "group") {
			$group = $dataproxy->get_group_by_slug($params["slug"]);

			if (!$group || empty($group)) {
				$f3->error(404);
			}

			if ($f3->get('SESSION.tq_group_id') != $group["id"] || $f3->get('SESSION.tq_group_h') != $group["hash"]) {
				$f3->reroute(site_url('login/' . $params["slug"]));
				exit;
			}
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
			case "group":
				$quotes = $dataproxy->get_quotes(null, null, null, 'random', $order, 50, 1, "", $group["id"]);
				$title_inject = "in de group <span class=\"em\">{$group["name"]}</span>";
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

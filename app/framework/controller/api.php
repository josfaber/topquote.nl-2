<?php

namespace Controller;

class Api {
	function vote(\Base $f3, $params) {
		
		$id = $f3->get('POST.id'); 
		if (!$id) ajax_output([ "success" => false ]);
		
		global $dataproxy;
		$result = $dataproxy->vote($id);

		ajax_output(array_merge([ "success" => true ], $result));
	}

	function quote(\Base $f3, $params) {
		
		$id = $params["id"]; 
		if (!$id) ajax_output([ "success" => false ]);
		
		global $dataproxy;
		$quote = $dataproxy->get_quote($id);
		if (!$quote) ajax_output([ "success" => false ]);

		ajax_output(array_merge([ "success" => true ], $quote));
	}

	function quotes(\Base $f3, $params) {

		global $dataproxy;
		
		$orderby = $f3->get('POST.orderby') ?? $dataproxy::$ORDER_CREATED; 
		$order = $f3->get('POST.order') ?? $dataproxy::$ORDER_DESC;
		$filter = $f3->get('POST.filter') ?? null;
		$slug = $f3->get('POST.slug') ?? null;
		$page = (int) ($f3->get('POST.page') ?? 1);
		$per_page = (int) ($f3->get('POST.per_page') ?? QUOTES_PER_PAGE);
		$render = $f3->get('POST.render') == 'true'; 

		// var_dump($orderby, $order, $filter, $slug, $page, $per_page, $render);
		// exit;

		$by = !is_null($filter) && $filter == "by" ? $slug : null;
		$from = !is_null($filter) && $filter == "from" ? $slug : null;
		$tag = !is_null($filter) && $filter == "tag" ? $slug : null;

		// $quotes = $dataproxy->get_quotes($by, $from, $tag, $orderby, $order, QUOTES_PER_PAGE, $page);
		$quotes = $dataproxy->get_quotes($by, $from, $tag, $orderby, $order, $per_page, $page);
		
		if ($render) {

			if (!$quotes) ajax_output([ "EOD" => true, "html" => "" ]);

			ob_start();

			foreach ($quotes["results"] as $quote) {
				render_template('partials/blockquote.html.twig', [
					"quote" => $quote,
				]);
			}

			$html = ob_get_contents();
			ob_end_clean();

			ajax_output([
				"orderby" => $orderby,
				"order" => $order,
				"page" => $page,
				"filter" => $filter,
				"slug" => $slug,
				"html" => $html,
			]);
		}

		if (!$quotes) ajax_output([ "EOD" => true, "quotes" => $quotes ]); 

		ajax_output([
			"orderby" => $orderby,
			"order" => $order,
			"page" => $page,
			"filter" => $filter,
			"slug" => $slug,
			"quotes" => $quotes["results"],
		]);
	}

	function last(\Base $f3)
	{
		global $dataproxy;

		$quotes = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_CREATED, $dataproxy::$ORDER_DESC, 1, 1);

		ajax_output([
			"quote" => $quotes["results"][0]["quote"],
			"sayer" => $quotes["results"][0]["sayer"],
			"submitter" => $quotes["results"][0]["submitter"],
			"created" => $quotes["results"][0]["created"],
		]);
	}

}
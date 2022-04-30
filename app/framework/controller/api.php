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

	function quotes(\Base $f3, $params) {

		global $dataproxy;
		
		$orderby = $f3->get('POST.orderby') ?? $dataproxy::$ORDER_CREATED; 
		$order = $f3->get('POST.order') ?? $dataproxy::$ORDER_DESC;
		$filter = $f3->get('POST.filter') ?? null;
		$slug = $f3->get('POST.slug') ?? null;
		$page = (int) $f3->get('POST.page') ?? 1;
		$render = $f3->get('POST.render') == 'true'; 

		$by = !is_null($filter) && $filter == "by" ? $slug : null;
		$from = !is_null($filter) && $filter == "from" ? $slug : null;
		$tag = !is_null($filter) && $filter == "tag" ? $slug : null;

		$quotes = $dataproxy->get_quotes($by, $from, $tag, $orderby, $order, QUOTES_PER_PAGE, $page);
		
		if ($render) {

			if (!$quotes) ajax_output([ "EOD" => true, "html" => "" ]);

			ob_start();

			foreach ($quotes["results"] as $quote) {
				render_template('partials/blockquote.html', [
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

}
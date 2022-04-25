<?php

namespace Controller;

class Api {

	function quotes(\Base $f3, $params) {

		global $dataproxy;
		
		$orderby = $f3->get('POST.ob') ?? $dataproxy::$ORDER_CREATED; 
		$order = $f3->get('POST.o') ?? $dataproxy::$ORDER_DESC;
		$page = (int) $f3->get('POST.p') ?? 1;
		$render = $f3->get('POST.render') == 'true'; 

		$quotes = $dataproxy->get_quotes(null, null, null, $orderby, $order, QUOTES_PER_PAGE, $page);
		
		if ($render) {

			ob_start();

			foreach ($quotes as $quote) {
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
				"html" => $html,
			]);
		}

		ajax_output([
			"orderby" => $orderby,
			"order" => $order,
			"page" => $page,
			"quotes" => $quotes,
		]);

	}

}
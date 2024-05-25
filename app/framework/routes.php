<?php
$f3->route('GET /', 							'Controller\Home->index');

$f3->route('GET /quotes', 						'Controller\Quotes->index');
$f3->route('GET /quotes/@filter/@slug', 		'Controller\Quotes->@filter');
$f3->route('GET /quotes/search/@terms', 		'Controller\Quotes->search');
$f3->route('GET /slide/@filter/@slug', 			'Controller\Quotes->slide');
$f3->route('GET /quote/@slug', 					'Controller\Quote->detail');
$f3->route('GET /add', 							'Controller\Quote->add');
$f3->route('POST /add', 						'Controller\Quote->store');
$f3->route('GET /mod', 							'Controller\Quote->edit');
$f3->route('POST /mod', 						'Controller\Quote->update');

$f3->route('GET /login/@slug', 					'Controller\Group->login');
$f3->route('GET /login/@slug/@code',			'Controller\Group->login_magic');
$f3->route('POST /login/@slug', 				'Controller\Group->login_handler');
$f3->route('GET /logout', 						'Controller\Group->logout_handler');
$f3->route('GET /add-group', 					'Controller\Group->add');
$f3->route('POST /add-group', 					'Controller\Group->store');
$f3->route('GET /mod-group', 					'Controller\Group->edit');
$f3->route('POST /mod-group', 					'Controller\Group->update');

$f3->route('GET /feedback',						'Controller\Tools->feedback');
$f3->route('POST /feedback',					'Controller\Tools->save_feedback');

$f3->route('POST /api/quotes [ajax]',			'Controller\Api->quotes');
$f3->route('POST /api/vote [ajax]',				'Controller\Api->vote');
$f3->route('POST /api/quote/@id [ajax]',		'Controller\Api->quote');
$f3->route('POST /api/last',					'Controller\Api->last');

$f3->route('GET /by/@sayer', function ($f3, $params) {
	$f3->reroute(site_url("quotes/by/{$params["sayer"]}"));
});
$f3->route('GET /from/@submitter', function ($f3, $params) {
	$f3->reroute(site_url("quotes/from/{$params["submitter"]}"));
});

$f3->route('GET /img/@id',					'Controller\Service->img');

$f3->route('GET /poster/@id',				'Controller\Service->poster');

// $f3->route('GET /phpinfo',				'Controller\Home->phpinfo');

$f3->set('ONERROR', function ($f3) {

	// !d($f3->ERROR["code"]);
	global $assets_manifest, $dataproxy;

	$quotes = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 12, 1, "
		AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
")["results"] ?? [];

	$said_last_week = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
		 AND (`created` > DATE_SUB(now(), INTERVAL 30 DAY)) AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
	")["results"] ?? [];

	render_template('error.html.twig', [
		"quotes" => $quotes,
		"code" => $f3->ERROR["code"] ?? 0
	]);
});

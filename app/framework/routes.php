<?php 
$f3->route('GET /', 						'Controller\Home->index');

$f3->route('GET /quotes', 					'Controller\Quotes->index');
$f3->route('GET /quotes/@filter/@slug', 	'Controller\Quotes->@filter');
$f3->route('GET /quotes/search/@terms', 	'Controller\Quotes->search');
$f3->route('GET /quote/@slug', 				'Controller\Quote->detail');

// $f3->route('GET /img/@id', 					'Controller\Tools->img');

$f3->route('GET /add', 						'Controller\Quote->add');
$f3->route('POST /add', 					'Controller\Quote->store');

$f3->route('GET /feedback',					'Controller\Tools->feedback');
$f3->route('POST /feedback',				'Controller\Tools->save_feedback');

$f3->route('GET /mod', 						'Controller\Quote->edit');
$f3->route('POST /mod', 					'Controller\Quote->update');

// $f3->route('GET /import',  					'Controller\Tools->import');
$f3->route('GET /t-clear',					'Controller\Tools->clear_cache');
$f3->route('GET /t-sitemap',				'Controller\Tools->create_sitemaps');

$f3->route('POST /api/quotes [ajax]',		'Controller\Api->quotes');
$f3->route('POST /api/vote [ajax]',			'Controller\Api->vote');
$f3->route('POST /api/quote/@id [ajax]',	'Controller\Api->quote');

// $f3->route('GET /sitemap.xml',				'Controller\Tools->sitemap');

$f3->route('GET /by/@sayer', function($f3, $params) {
	$f3->reroute(site_url("quotes/by/{$params["sayer"]}"));
});
$f3->route('GET /from/@submitter', function($f3, $params) {
	$f3->reroute(site_url("quotes/from/{$params["submitter"]}"));
});


    // location /tile {
    //     rewrite ^/tile/(.*)$ /poster.php?id=$1 last;
    // }
    // location /thumb {
    //     rewrite ^/thumb/(.*)$ /poster.php?id=$1&thumb=1 last;
    // }
    // location /img {
    //     rewrite ^/img/(.*)$ /img.php?id=$1 last;
    // } 
    // location /img2 {
    //     rewrite ^/img2/(.*)$ /img2.php?id=$1 last;
    // }
    // location /poster {
    //     rewrite ^/poster/(.*)$ /poster.php?id=$1 last;
    // }

$f3->set('ONERROR', function($f3) {
		
	// !d($f3->ERROR["code"]);
	global $assets_manifest, $dataproxy;
	
	$quotes = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 12, 1, "
		AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
")["results"];
	
	$said_last_week = $dataproxy->get_quotes(null, null, null, $dataproxy::$ORDER_RANDOM, null, 9, 1, "
		 AND (`created` > DATE_SUB(now(), INTERVAL 30 DAY)) AND LENGTH(`quote`) > 16 AND LENGTH(`quote`) < 120
	")["results"];
		
	render_template('error.html', [
		"quotes" => $quotes,
		"code" => $f3->ERROR["code"] ?? 0
	]);
});
<?php 
$f3->route('GET /', 						'Controller\Home->index');

$f3->route('GET /quotes', 					'Controller\Quotes->index');
$f3->route('GET /quotes/@filter/@slug', 	'Controller\Quotes->@filter');
$f3->route('GET /quotes/search/@terms', 	'Controller\Quotes->search');
$f3->route('GET /quote/@slug', 				'Controller\Quote->detail');

$f3->route('GET /add', 						'Controller\Quote->add');
$f3->route('POST /add', 					'Controller\Quote->store');

$f3->route('GET /feedback',					'Controller\Tools->feedback');
$f3->route('POST /feedback',				'Controller\Tools->save_feedback');

$f3->route('GET /mod', 						'Controller\Quote->edit');
$f3->route('POST /mod', 					'Controller\Quote->update');

// $f3->route('GET /import',  					'Controller\Tools->import');
$f3->route('GET /t-rank',					'Controller\Tools->rank');
$f3->route('GET /t-clear',					'Controller\Tools->clear_cache');

$f3->route('POST /api/quotes [ajax]',		'Controller\Api->quotes');
$f3->route('POST /api/vote [ajax]',			'Controller\Api->vote');

// $f3->set('ONERROR', function($f3) {
// 	// !d(\Template::instance());
// 	echo \Template::instance()->render('error.html');
// });
<?php 
$f3->route('GET /', 						'Controller\Home->index');

$f3->route('GET /quotes', 					'Controller\Quotes->index');
$f3->route('GET /quotes/@filter/@slug', 	'Controller\Quotes->@filter');
$f3->route('GET /quote/@slug', 				'Controller\Quote->detail');

$f3->route('GET /add', 						'Controller\Quote->add');
$f3->route('POST /add', 					'Controller\Quote->store');

$f3->route('GET /import',  					'Controller\Tools->import');
$f3->route('GET /t-rank',					'Controller\Tools->rank');

$f3->route('POST /api/quotes [ajax]',		'Controller\Api->quotes');
<?php 
define("BASE_DIR", 		__DIR__ . "/..");
define("FW_DIR", 		__DIR__ . "/../framework");
define("PUBLIC_DIR", 	__DIR__ . "/../public");

require BASE_DIR . '/vendor/autoload.php';

require FW_DIR . '/dataproxy.php';
require FW_DIR . '/defines.php';
require FW_DIR . '/functions.php';

$dataproxy = new TopQuote\DataProxy();

$now = date("Y-m-d\TH:i:sP");
$sitemap_header = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL; 
$sitemap_footer = '</urlset>';

function write_sitemap($filename, $content) {
	// !s($filename, $content);
	$fp = gzopen($filename, 'w9');
	gzwrite ($fp, $content);
	gzclose($fp);
}

// Algemeen 
$sitemap = $sitemap_header; 
$sitemap .= '<url>' . PHP_EOL . '	<loc>https://topquote.nl</loc>' . PHP_EOL . '	<lastmod>' . $now . '	</lastmod>' . PHP_EOL . '</url>' . PHP_EOL;
foreach([ "frikandellenbos", "poep", "rusland", "amerika", "kleuter", "opvoeding", "eten", "radio", "tv", "internet", "maandag", "dinsdag", "woensdag", "vrijdag",
	"aarde", "natuur", "geweld", "sex", "game", "bijbel", "geloof", "jinek", "britt", "dekker", "food", "voetbal", "jan smit", "nederland", "bekend", "geld", "porno",
	"idee"
] as $term) {
	$sitemap .= '<url>' . PHP_EOL . '	<loc>https://topquote.nl/search/' . $term . '</loc>' . PHP_EOL . '	<lastmod>' . $now . '	</lastmod>' . PHP_EOL . '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_general.xml.gz", $sitemap);

// Slugs 
$all_quotes = $dataproxy->get_all_quotes_slugs();
$sitemap = $sitemap_header; 
foreach ($all_quotes as $quote) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quote/' . $quote["slug"] . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_slugs.xml.gz", $sitemap);

// Tags
$all_single_tags = $dataproxy->get_all_tags_slugs();
$sitemap = $sitemap_header; 
foreach($all_single_tags as $tag) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quotes/tag/' . $tag . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_tags.xml.gz", $sitemap);

// Sayers 
$all_sayers = $dataproxy->get_all_sayers_slugs();
$sitemap = $sitemap_header; 
foreach($all_sayers as $quote) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quotes/by/' . $quote["sayer_slug"] . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_sayers.xml.gz", $sitemap);

// Submitters
$all_submitters = $dataproxy->get_all_submitters_slugs();
$sitemap = $sitemap_header; 
foreach($all_submitters as $quote) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quotes/from/' . $quote["submitter_slug"] . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_submitters.xml.gz", $sitemap);
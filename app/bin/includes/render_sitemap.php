<?php
$now = date("Y-m-d\TH:i:sP");
$sitemap_header = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
$sitemap_footer = '</urlset>';
$max_urls_per_map = 40000;

function write_sitemap($filename, $content)
{
	echo "Writing sitemap " . $filename . PHP_EOL;
	$fp = gzopen($filename, 'w9');
	gzwrite($fp, $content);
	gzclose($fp);
}



// Algemeen 
// ================================
$sitemap = $sitemap_header;
$sitemap .= '<url>' . PHP_EOL . '	<loc>https://topquote.nl</loc>' . PHP_EOL . '	<lastmod>' . $now . '</lastmod>' . PHP_EOL . '</url>' . PHP_EOL;
foreach ([
	"aandelen", "aarde", "ABN%20AMRO", "afvallen", "Albert%20Heijn", "Amerika", "ANWB", "anxiety", "auto%20kopen", "autoverzekering",
	"basisscholen", "bekend", "bekende%20Nederlanders", "belastingaangifte", "belastingdienst", "beleggen", "bijbaan", "bijbel",
	"biologisch", "boeken", "bol.com", "Britt%20Dekker", "budgetteren", "budgettips", "cabaret", "cadeau%20ideeën", "concerten",
	"coronavirus", "crypto", "depressie", "diëten", "dinsdag", "DIY", "donderdag", "duurzame%20producten",
	"energie%20vergelijken", "eten", "examens", "Facebook", "festivals", "filosofie", "fitness", "food", "frikandellenbos",
	"game", "gaslicht.com", "geld", "geld%20besparen", "geloof", "geschiedenis", "geweld", "gezond%20eten", "gezonde%20recepten",
	"glutenvrij", "goedkoopste%20energieleverancier", "H&M", "HEMA", "hotels", "hypotheek", "idee", "IKEA", "ING", "Instagram",
	"interieur", "internet", "Jan%20Smit", "Jinek", "Jumbo", "kinderopvang", "kleding", "kleuter", "klimaatverandering",
	"koolhydraatarm", "kunst", "lactosevrij", "laptop", "leningen", "lezen", "maandag", "makelaar", "Marktplaats", "meditatie",
	"middelbare%20scholen", "milieubewust%20leven", "mindfulness", "muziek", "natuur", "Nederland", "Nederlandse", "Netflix",
	"nieuws", "NS", "online%20cursussen", "oorlog", "opvoeding", "OV-chipkaart", "pensioen", "poep", "poëzie", "porno", "PostNL",
	"Primark", "psychologie", "radio", "recepten", "recycling", "reizen", "rente", "restaurants", "ruimtevaart", "Rusland",
	"salaris", "schoenen", "schrijven", "schulden", "scriptie", "sex", "smartphone", "sollicitatiebrief", "songfestival",
	"sparen", "sport", "studenten%20ov", "studeren", "studiefinanciering", "suikervrij", "superfoods", "taalcursussen",
	"talkshow", "technologie", "tentamen", "thuiswerk", "tuinieren", "tv", "tweedehands%20auto", "universiteiten", "vacatures",
	"vakantie", "vakantie", "veganistisch", "vegetarisch", "voetbal", "voetbal", "vrijdag", "weekend", "weer", "werk%20zoeken",
	"wetenschap", "WhatsApp", "WK", "woensdag", "woontrends", "yoga", "YouTube", "Zalando", "zaterdag", "zelfhulp",
	"zelfontwikkeling", "zondag", "zorgtoeslag"
] as $term) {
	$sitemap .= '<url>' . PHP_EOL . '	<loc>https://topquote.nl/search/' . $term . '</loc>' . PHP_EOL . '	<lastmod>' . $now . '</lastmod>' . PHP_EOL . '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_general.xml.gz", $sitemap);



// Slugs 
// ================================
$all_quotes = $dataproxy->get_all_quotes_slugs();
$sitemap = $sitemap_header;
!d("all_quotes", count($all_quotes));
$num_slug_map = 1;
$cur = 1;
foreach ($all_quotes as $quote) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quote/' . $quote["slug"] . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
	if ($cur++ > $max_urls_per_map) {
		$sitemap .= $sitemap_footer;
		write_sitemap(PUBLIC_DIR . "/sitemap_slugs_" . $num_slug_map . ".xml.gz", $sitemap);
		$num_slug_map++;
		$cur = 1;
		$sitemap = $sitemap_header;
	}
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_slugs_" . $num_slug_map . ".xml.gz", $sitemap);



// Sayers 
// ================================
$all_sayers = $dataproxy->get_all_sayers_slugs();
// !d("all_sayers", count($all_sayers));
$sitemap = $sitemap_header;
foreach ($all_sayers as $quote) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quotes/sayer/' . $quote["sayer_slug"] . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_sayers.xml.gz", $sitemap);



// Submitters
// ================================
$all_submitters = $dataproxy->get_all_submitters_slugs();
// !d("all_submitters", count($all_submitters));
$sitemap = $sitemap_header;
foreach ($all_submitters as $quote) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quotes/submitter/' . $quote["submitter_slug"] . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_submitters.xml.gz", $sitemap);



// Tags
// ================================
$all_single_tags = $dataproxy->get_all_tags_slugs();
$num_tags = count($all_single_tags);
!d("all_single_tags", $num_tags);
$num_tag_map = 1;
$cur = 1;
$sitemap = $sitemap_header;
foreach ($all_single_tags as $tag) {
	$sitemap .= '<url>' . PHP_EOL;
	$sitemap .= '	<loc>https://topquote.nl/quotes/tag/' . $tag . '</loc>' . PHP_EOL;
	$sitemap .= '	<lastmod>' . $now . '</lastmod>' . PHP_EOL;
	$sitemap .= '</url>' . PHP_EOL;
	if ($cur++ > $max_urls_per_map) {
		$sitemap .= $sitemap_footer;
		write_sitemap(PUBLIC_DIR . "/sitemap_tags_" . $num_tag_map . ".xml.gz", $sitemap);
		$num_tag_map++;
		$cur = 1;
		$sitemap = $sitemap_header;
	}
}
$sitemap .= $sitemap_footer;
write_sitemap(PUBLIC_DIR . "/sitemap_tags_" . $num_tag_map . ".xml.gz", $sitemap);



// Index
// ================================
$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
$sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_general.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
// $sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_slugs.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
for ($n = 1; $n <= $num_slug_map; $n++) {
	$sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_slugs_' . $n . '.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
}
$sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_sayers.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
$sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_submitters.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
// $sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_tags.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
for ($n = 1; $n <= $num_tag_map; $n++) {
	$sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_tags_' . $n . '.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
}
// foreach(range('a','z') as $char) {
// 	$sitemap .= '	<sitemap>' . PHP_EOL . '		<loc>https://topquote.nl/sitemap_tags_' . $char . '.xml.gz</loc>' . PHP_EOL . '		<lastmod>' . $now . '</lastmod>' . PHP_EOL . '	</sitemap>' . PHP_EOL;
// }
$sitemap .= '</sitemapindex>';
$handle = fopen(PUBLIC_DIR . "/sitemap.xml", "w") or die("Unable to open file!");
fwrite($handle, $sitemap);
fclose($handle);

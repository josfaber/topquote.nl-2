<?php 
define("BASE_DIR", 		__DIR__ . "/..");
define("FW_DIR", 		__DIR__ . "/../framework");

require BASE_DIR . '/vendor/autoload.php';
// require FW_DIR . '/dataproxy.php';
require FW_DIR . '/defines.php';
require FW_DIR . '/functions.php';


$start_url = "https://citaten.net/zoeken/citaten_willekeurig.html";

function scrape($url) {
	echo "Scraping {$url}" . PHP_EOL;

	$allowed_tags = ["aandacht", "afgunst", "aforisme", "afscheid", "alleen", "anderen", "angst", "antwoord", "armoede", "bang", "basis", "bedenken", "begin", "begrijpen", "behoefte", "beloven", "bescheidenheid", "bestaan", "bevolking", "bewustzijn", "boek", "bouwen", "chaos", "cultuur", "daad", "denken", "deur", "dichter", "dief", "diplomaat", "dom", "dood", "dromen", "droom", "econoom", "eenzaam", "eerlijk", "eerste", "eigen", "elkaar", "ervaring", "europa", "familie", "fantasie", "feiten", "gast", "geboorte", "gebrek", "gedicht", "geduld", "geheim", "geld", "gelijk", "gelijk", "geloof", "geluk", "genoegen", "geschenk", "gesloten", "gewoonte", "gezond", "god", "gouden", "haat", "hart", "heelal", "helemaal", "hemel", "herinnering", "hersenen", "hoofd", "houden", "humor", "huwelijk", "ideaal", "idioot", "ijdel", "ijdelheid", "instinct", "jaar", "jeugd", "jong", "journalistiek", "kenmerk", "kennis", "kiezen", "kind", "kinderen", "krant", "krijgen", "kunst", "kwaad", "kwetsen", "land", "laster", "leger", "leider", "lelijke", "leren", "leven", "lezen", "lichaam", "liefde", "literatuur", "lui", "maagd", "maatschappij", "macht", "man", "mannen", "massa", "meisje", "mening", "mensen", "midden", "minister", "misdaad", "missie", "moeite", "moord", "muziek", "naaste", "natuur", "nieuw", "nieuws", "nood", "noodzakelijk", "nutteloos", "oceaan", "ogen", "omloop", "onaangenaam", "onbegrepen", "onderwijs", "ongeluk", "oorlog", "opvoeding", "ouders", "paradijs", "persoon", "pessimist", "plaats", "plicht", "poëzie", "politiek", "praten", "probleem", "publiek", "raad", "ramp", "rede", "reizen", "religie", "revolutie", "rijk", "roem", "roem", "roman", "rust", "ruzie", "schilder", "school", "schoonheid", "schrijver", "schuld", "slaaf", "slapen", "slecht", "slechter", "smart", "spelen", "spreken", "staatsman", "sterven", "stilte", "student", "succes", "talent", "thuis", "toekomst", "toeval", "toneel", "tong", "trouw", "twijfel", "uitleg", "uitspraken", "vader", "veilig", "veranderen", "verdienen", "verdriet", "vergeten", "verhaal", "verleden", "verliefd", "verlies", "vermoeid", "verschil", "verstand", "verzet", "vijand", "vluchten", "volk", "vooroordelen", "vormen", "vragen", "vrees", "vreugde", "vrienden", "vrijheid", "vrouw", "waanzin", "waard", "waarheid", "wensen", "wereld", "werkelijkheid", "werken", "weten", "wetenschap", "willen", "wiskunde", "woede", "wraak", "zeggen", "zichzelf", "ziek", "ziekte", "ziel", "zien", "zoeken", "zoon", "zwakheden", "zwakte"];
	
	$content = file_get_contents($url);

	$dom = new DOMDocument();
	@$dom->loadHTML($content);

	// vind tags 
	$citatenwordlist = $dom->getElementById('citaten-wordlist');
	$tags = [];
	if (!is_null($citatenwordlist)) {
		foreach($citatenwordlist->getElementsByTagName('li') as $li) {
			foreach($li->getElementsByTagName('a') as $a) {
				// if (in_array(strtolower($a->nodeValue), $allowed_tags)) {
				$tags[] = $a->nodeValue;
				// }
			}
		}
	}

	// vind citaten 
	$citatenrijen = $dom->getElementById('citatenrijen');
	if (!is_null($citatenrijen)) {
		foreach($citatenrijen->getElementsByTagName('li') as $citaat) {
			$id = $citaat->getAttribute('id');
			if ( ! empty($id) ) {
				$cid = "cit-{$id}";
				foreach($citaat->childNodes as $node) {
					// !s($node->nodeName);
					if ($node->nodeName == 'div' && $node->hasAttribute('class') && $node->getAttribute('class') == 'citatenlijst-auteur-container') {
						// !s('AUTEUR-CONTAINER');
						foreach($node->childNodes as $inner_node) {
							// !s('INNERNODE');
							if ($inner_node->nodeName == 'div' && $inner_node->hasAttribute('class') && $inner_node->getAttribute('class') == 'citatenlijst-auteur') {
								// !s($inner_node->getAttribute('class'));
								// !s('AUTEUR', $inner_node->nodeValue);
								foreach($inner_node->getElementsByTagName('a') as $a) {
									// !s($a->nodeName);
									if ($a->hasAttribute('class') && $a->getAttribute('class') == "auteurfbnaam") {
										$auteur = strip_tags(trim($a->nodeValue));
									}
								}
							}
						}
					}
					if ($node->nodeName == 'q') {
						$quote = strip_tags(trim($node->nodeValue));
					}
				}
				if (isset($quote) && isset($auteur)) {
					$result = importQuote($cid, $auteur, $quote, implode(",", $tags));
					if ($result) {
						echo $cid . " | " . $auteur . " | " . $quote . " | " . implode(",", $tags) . PHP_EOL;
					}
				}
			}
		}
	}

	tryNewUrl($dom);
}

function importQuote($cid, $auteur, $quote, $tags) {
	$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

	$db_quote = new \DB\SQL\Mapper($db, 'quotes');

	$time = time();
	$slug = slugify($quote, 200);
	$hits = 0;
	$likes = 0;

	$db_quote->reset();
	$db_quote->load(array('import_id=?', $cid));

	if (!$db_quote->dry()) {
		// exists
		return false;
	}

	$db->exec('INSERT INTO quotes (
		import_id, 
		created, 
		slug, 
		quote, 
		quote_lc, 
		sayer, 
		sayer_lc, 
		sayer_slug, 
		submitter, 
		submitter_lc, 
		submitter_slug, 
		tags, 
		tags_lc,
		hits,
		likes
		) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
		$cid,
		date('Y-m-d H:i:s', $time),
		$slug,
		$quote,
		strtolower($quote),
		$auteur,
		strtolower($auteur),
		slugify($auteur),
		'Jos',
		strtolower('Jos'),
		slugify('Jos'),
		$tags,
		strtolower($tags),
		$hits,
		$likes
	]);

	return true;
}

function tryNewUrl($dom) {

	$urls = $dom->getElementsByTagName('a');
	$links = [];
	
	foreach ($urls as $url)
	{
		$links[] = $url;
	}

	shuffle($links);
	
	foreach($links as $url) {
		//echo "<br> {$url->getAttribute('href')} , {$url->getAttribute('title')}";
		
		$a_attr = [];
		foreach ($url->attributes as $attr) {
			$a_attr[] = $attr->value;
		}
		shuffle($a_attr);
		foreach ($a_attr as $attr)
		{
			if (strpos($attr, "/zoeken") ) {
				usleep(500);
				scrape($attr);
				break 2;
			}
		}
	}
}

scrape($start_url);


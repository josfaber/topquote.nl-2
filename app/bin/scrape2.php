<?php
define("BASE_DIR", 		__DIR__ . "/..");
define("FW_DIR", 		__DIR__ . "/../framework");

require BASE_DIR . '/vendor/autoload.php';
// require FW_DIR . '/dataproxy.php';
require FW_DIR . '/defines.php';
require FW_DIR . '/functions.php';

function scrape($url)
{
	// echo "Scraping {$url}" . PHP_EOL;

	$content = file_get_contents($url);
	$dom = new DOMDocument();
	@$dom->loadHTML($content);

	// vind citaten 
	$postlisting = $dom->getElementById('post-listing');
	if (!is_null($postlisting)) {
		foreach ($postlisting->getElementsByTagName('article') as $article) {
			$id = $article->getAttribute('id');
			// !s($id);
			if (!empty($id)) {
				$cid = "spr-{$id}";
				foreach ($article->childNodes as $node) {
					// !s($node->nodeName);
					if ($node->nodeName == 'h2' && $node->hasAttribute('class') && $node->getAttribute('class') == 'post-title') {
						// !s($node->nodeName);
						foreach ($node->childNodes as $inner_node) {
							// !s($inner_node->nodeName);
							if ($inner_node->nodeName == 'a') {
								// !s($inner_node->nodeValue);
								$quote = strip_tags(trim($inner_node->nodeValue, " \t\n\r\0\x0B.\""));
								// !s($quote);
							}
						}
					}

					if ($node->nodeName == 'div' && $node->hasAttribute('class') && $node->getAttribute('class') == 'post-author-title') {
						// !s('author-title');
						foreach ($node->childNodes as $inner_node) {
							// !s($inner_node->nodeName);
							if ($inner_node->nodeName == 'a') {
								$auteur = strip_tags(trim($inner_node->nodeValue, " \t\n\r\0\x0B.\""));
								// !s($auteur);
							}
						}
					}

					// div.meta / div.tags / div.tag-listing / a 
					$tags = [];
					if ($node->nodeName == 'div' && $node->hasAttribute('class') && $node->getAttribute('class') == 'meta') {
						// !s('meta');
						foreach ($node->childNodes as $inner_node) {
							if ($inner_node->nodeName == 'div' && $inner_node->hasAttribute('class') && $inner_node->getAttribute('class') == 'tags') {
								// !s('tags');
								foreach ($inner_node->childNodes as $core_node) {
									if ($core_node->nodeName == 'div' && $core_node->hasAttribute('class') && strpos($core_node->getAttribute('class'), 'tag-listing') >= 0) {
										// !s('tag-listing');
										foreach ($core_node->getElementsByTagName('a') as $a) {
											$tags[] = $a->nodeValue;
										}
										// !s($tags);
									}
								}
							}
						}
					}
				}

				if (isset($quote) && isset($auteur)) {
					$result = importQuote($cid, $auteur, $quote, implode(",", $tags));
					if ($result) {
						echo $cid . " ";
					}
					// !s($cid, $quote, $auteur, implode(",", $tags));
				}
			}
		}
	}
}

$start_url = "https://www.spreukenengezegdes.nl/auteurs/";

libxml_use_internal_errors(true);

$content = file_get_contents($start_url);
$dom = new DOMDocument();
@$dom->loadHTML($content);

$urls = $dom->getElementsByTagName('a');
foreach ($urls as $url) {
	foreach ($url->attributes as $attr) {
		if ($attr->name == "href" && strpos($attr->value, "/auteur/")) {
			scrape($attr->value);
			// break 2;
		}
	}
}

function importQuote($cid, $auteur, $quote, $tags)
{
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

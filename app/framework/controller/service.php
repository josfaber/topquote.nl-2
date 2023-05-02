<?php

namespace Controller;

use \imagettfbox;

class Service
{
	function poster(\Base $f3, $params)
	{
		if (!is_dir(CACHE_DIR)) {
			die('cache dir missing');
		}

		$id = $params["id"];

		if (!$id) {
			die('"missing data"');
		}

		$filename 		= "p{$id}.jpg";
		$filepath 		= CACHE_DIR . DIRECTORY_SEPARATOR . $filename;

		// 
		if (!file_exists($filepath) || isset($_GET["regen"])) {

			// $URL = "http://192.168.2.108:3000/api/quote";
			// $URL = "https://topquote.nl/api/quote";
			$URL = API_URL . "/quote";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, "{$URL}/{$id}");
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Requested-With: XMLHttpRequest']);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			$result = curl_exec($ch);
			$err = curl_error($ch);
			curl_close($ch);
			if ($err) {
				var_dump($err);
			}
			if (!$result) {
				die('"error getting quote data"');
			}

			$quote = json_decode($result, true);
			if (!$quote) {
				die('"error parsing quote data"');
			}

			$width 	= 2480;
			$height = 3508;
			$font	= BASE_DIR . '/assets/NHaasGroteskDSPro-75Bd.otf';

			$im = imagecreate($width, $height);

			$bg	= imagecolorallocate($im, 255, 255, 255);
			$adclr = imagecolorallocate($im, 229, 0, 124);
			$fg = imagecolorallocate($im, 5, 5, 5);

			imagefilledrectangle($im, 0, 0, $width, $height, $bg);

			$wrapping		= 32;
			$padding		= 240;

			$wrapped_quote = wordwrap($quote["quote"], $wrapping, "\n");
			$quoteText = $this->tryText(200, $font, $wrapped_quote, $width - 2 * $padding, $height - 2 * $padding);
			$sayer 		= $this->tryText(80, $font, $quote["sayer"], 0.5 * $width, $height - 4 * $padding);

			// quote
			imagettftext($im, $quoteText["size"], 0, round(0.5 * ($width - $quoteText["tw"])), round(0.5 * ($height - $quoteText["th"] + 3 * 36)), $fg, $font, $wrapped_quote);

			// sayer
			imagettftext($im, $sayer["size"], 0, $padding, $height - 320, $fg, $font, $quote["sayer"]);

			// ad
			imagettftext($im, 40, 0, $padding, $height - 200, $adclr, $font, "topquote.nl");

			// create
			imagejpeg($im, $filepath, 95);
			imagedestroy($im);
		}

		// output 
		header('Content-type: image/jpeg');
		readfile("$filepath");
	}

	function img(\Base $f3, $params)
	{
		if (!is_dir(CACHE_DIR)) {
			die('cache dir missing');
		}

		$id = $params["id"];

		if (!$id) {
			die('"missing data"');
		}

		$filename 		= "q{$id}.jpg";
		$filepath 		= CACHE_DIR . DIRECTORY_SEPARATOR . $filename;

		// 
		if (!file_exists($filepath) || isset($_GET["regen"])) {

			// $URL = "http://192.168.2.108:3000/api/quote";
			// $URL = "https://topquote.nl/api/quote";
			$URL = API_URL . "/quote";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, "{$URL}/{$id}");
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Requested-With: XMLHttpRequest']);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			$result = curl_exec($ch);
			$err = curl_error($ch);
			curl_close($ch);
			if ($err) {
				var_dump($err);
			}
			if (!$result) {
				die('"error getting quote data"');
			}

			$quote = json_decode($result, true);
			if (!$quote) {
				die('"error parsing quote data"');
			}

			$width 	= 1920;
			$height = 1080;
			$font	= BASE_DIR . '/assets/NHaasGroteskDSPro-75Bd.otf';

			$im = imagecreate($width, $height);

			$bg	= imagecolorallocate($im, 0, 0, 0);
			$fg = imagecolorallocate($im, 229, 0, 124);
			$adclr = imagecolorallocate($im, 60, 60, 60);

			imagefilledrectangle($im, 0, 0, $width, $height, $bg);

			$wrapping		= 40;
			$padding_w		= 280;
			$padding_h		= 240;

			$wrapped_quote = wordwrap($quote["quote"], $wrapping, "\n");
			$quoteText = $this->tryText(50, $font, $wrapped_quote, $width - 2 * $padding_w, $height - 2 * $padding_h);
			$sayer 		= $this->tryText(35, $font, $quote["sayer"], 0.5 * $width, $height - 4 * $padding_h);

			// quote
			imagettftext($im, $quoteText["size"], 0, round(0.5 * ($width - $quoteText["tw"])), round(0.5 * ($height - $quoteText["th"] + 3 * 36)), $fg, $font, $wrapped_quote);

			// sayer
			imagettftext($im, $sayer["size"], 0, round(0.5 * ($width - $sayer["tw"])), 180, $fg, $font, $quote["sayer"]);

			// ad
			imagettftext($im, 20, 0, 100, $height - 80, $adclr, $font, "topquote.nl");

			// create
			imagejpeg($im, $filepath, 95);
			imagedestroy($im);
		}

		// output 
		header('Content-type: image/jpeg');
		readfile("$filepath");
	}

	function tryText($size, $font, $text, $w, $h)
	{
		// !d(function_exists('imageftbbox'));
		$box 	= imageftbbox($size, 0, $font, $text);
		$box_h 	= imageftbbox($size, 0, $font, "Wdp");
		// $tw 	= abs(max($box[2], $box[4]));
		// $th 	= abs(max($box[5], $box[7]));

		$tw = round($box[4] - $box[6]);
		$th = round($box[3] - $box[5]);
		// 0	lower left corner, X position
		// 1	lower left corner, Y position
		// 2	lower right corner, X position
		// 3	lower right corner, Y position
		// 4	upper right corner, X position
		// 5	upper right corner, Y position
		// 6	upper left corner, X position
		// 7	upper left corner, Y position

		if ($tw < $w && $th < $h) {
			return array(
				"size" => $size,
				"tw" => $tw,
				"th" => $th,
			);
		} else {
			return $this->tryText($size - 1, $font, $text, $w, $h);
		}
	}
}

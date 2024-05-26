<?php

namespace Controller;

use TopQuote\Model\QuoteModel;

use Controller\Base;

class Group extends Base
{
	function login(\Base $f3, $params)
	{
		global $dataproxy;

		$group = $dataproxy->get_group_by_slug($params["slug"]);

		if (!$group || empty($group)) {
			$f3->error(404);
		}

		render_template('group-login.html.twig', [
			"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
			"group" => $group,
		]);
	}

	function login_handler(\Base $f3, $params)
	{
		global $dataproxy;

		$group = $dataproxy->get_group_by_slug($params["slug"]);

		if (!$group || empty($group)) {
			$f3->error(404);
		}

		// validate google recaptcha response
		$verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=" . $_POST["rtoken"] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$response = json_decode(file_get_contents($verify_url), true);

		if ($response['success'] == true) {

			if (!password_verify($_POST["password"], $group["password"])) {
				$f3->set('SESSION.tq_group_id', null);
				$f3->set('SESSION.tq_group_h', null);
				$f3->set('SESSION.tq_group_name', null);
				$f3->set('SESSION.tq_group_slug', null);

				render_template('group-login.html.twig', [
					"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
					"group" => $group,
				]);
				exit;
			}

			$f3->set('SESSION.tq_group_id', $group["id"]);
			$f3->set('SESSION.tq_group_h', $group["hash"]);
			$f3->set('SESSION.tq_group_name', $group["name"]);
			$f3->set('SESSION.tq_group_slug', $group["slug"]);
			$f3->reroute(site_url('quotes/group/' . $params["slug"]));
			exit;
		} else {
			render_template('group-login.html.twig', [
				"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
				"group" => $group,
			]);
		}
	}

	function logout_handler(\Base $f3, $params)
	{

		$f3->set('SESSION.tq_group_id', null);
		$f3->set('SESSION.tq_group_h', null);
		$f3->set('SESSION.tq_group_name', null);
		$f3->set('SESSION.tq_group_slug', null);
		$f3->reroute(site_url(''));
	}

	function login_magic(\Base $f3, $params)
	{
		global $dataproxy;

		$group = $dataproxy->get_group_by_slug($params["slug"]);

		if (!$group || empty($group)) {
			$f3->error(404);
		}

		if ($group["login_hash"] != $params["code"]) {
			$f3->reroute(site_url('login/' . $params["slug"]));
			exit;
		}

		$f3->set('SESSION.tq_group_id', $group["id"]);
		$f3->set('SESSION.tq_group_h', $group["hash"]);
		$f3->set('SESSION.tq_group_name', $group["name"]);
		$f3->set('SESSION.tq_group_slug', $group["slug"]);
		$f3->reroute(site_url('quotes/group/' . $params["slug"]));
		exit;
	}

	function add(\Base $f3, $params)
	{
		render_template('add-group.html.twig', [
			"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
		]);
	}

	function store(\Base $f3, $params)
	{
		global $dataproxy;

		$verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response=" . $_POST["rtoken"] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$response = json_decode(file_get_contents($verify_url), true);

		if ($response['success'] == true) {

			$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

			$name = trim($_POST["group"]);
			$slug = slugify($name, 200);

			$email = trim($_POST["email"]);
			// @todo validate email 
			// $modkey = Uuid::uuid4();
			$modkey = uniqid("mod", true);
			$hash = uniqid("grp", true);
			$login_hash = uniqid("L", true);
			$group_link = site_url('/login/' . $slug . '/' . $login_hash);

			$db_group = new \DB\SQL\Mapper($db, 'groups');
			$db_group->name = $name;
			$db_group->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$db_group->slug = $slug;
			$db_group->hash = $hash;
			$db_group->login_hash = $login_hash;
			$db_group->created = date('Y-m-d H:i:s');
			$db_group->save();

			$group_id = $db_group->id;

			$db_group_owner = new \DB\SQL\Mapper($db, 'group_owner');
			$db_group_owner->group_id = $group_id;
			$db_group_owner->email = $email;
			$db_group_owner->ip = $_SERVER['REMOTE_ADDR'];
			$db_group_owner->modkey = $modkey;
			$db_group_owner->save();

			$mod_link = site_url('mod-group') . "?key={$modkey}&id={$group_id}";

			$html = "<blockquote><p>{$name}</p><cite>{$email}</cite></blockquote><ul>";

			// mail to topquote
			try {
				$mail = $dataproxy->get_mailer();
				$mail->addAddress(TO_EMAIL, 'topquote');
				$mail->Subject = "Nieuwe group aangemaakt: '{$name}'";
				$mail->msgHTML($html);
				$mail->send();
			} catch (\Exception $e) {
				error_log("Mailer Error: {$mail->ErrorInfo}");
			}

			// mail to submitter
			$html = "
				<blockquote>
					<p>{$name}</p>
				</blockquote>
				<hr>
				<p>&#128279; De link naar je groep. Met deze link word je automatisch ingelogd op de groep. Delen maar! &#128522;
				<br><a href=\"{$group_link}\">{$group_link}</a></p>
				
				<p>&#9881;&#65039; De link om te beheren. Iedereen met deze link kan aanpassingen aan de groep maken en deze ook verwijderen.:
				<br><a href=\"{$mod_link}\">{$mod_link}</a></p>
				";

			try {
				$mail = $dataproxy->get_mailer();
				$mail->addAddress($email);
				$mail->Subject = "Je opgeslagen groep '{$name}' (beheer link)";
				$mail->msgHTML($html);
				$mail->send();
			} catch (\Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}

			render_template('jump.html.twig', [
				"message" => "Groep opgeslagen.",
				"jump_url" => $group_link,
				"jump_url_text" => "Bekijk de groep"
			]);
		} else {

			render_template('add-group.html.twig', array_merge($_POST, [
				"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
			]));
		}
	}

	function edit(\Base $f3, $params)
	{
		if (!isset($_GET["id"]) || !isset($_GET["key"])) {
			$f3->error(404);
		}

		global $dataproxy;
		/** @var QuoteModel */
		$group = $dataproxy->get_group_by_id($_GET["id"], true);
		$group_owner = $dataproxy->get_group_owner($_GET["id"], $_GET["key"]);

		if (!$group || !$group_owner || $group_owner[0]["modkey"] != $_GET["key"]) {
			$f3->error(404);
		}

		render_template('add-group.html.twig', [
			"edit_url" => site_url('mod-group'),
			"group_id" => $group["id"],
			"modkey" => $_GET["key"],
			"name" => $group["name"],
			"edit" => true
		]);
	}

	function update(\Base $f3, $params)
	{

		if (!isset($_POST["group_id"]) || !isset($_POST["modkey"])) {
			$f3->error(404);
		}

		global $dataproxy;

		/** @var QuoteModel */
		$group = $dataproxy->get_group_by_id($_POST["group_id"], true);

		$group_owner = $dataproxy->get_group_owner($_POST["group_id"], $_POST["modkey"]);

		if (!$group || !$group_owner || $group_owner[0]["modkey"] != $_POST["modkey"]) {
			$f3->error(404);
		}

		$db = new \DB\SQL('mysql:host=' . DB_HOST . ';port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

		$db_group = new \DB\SQL\Mapper($db, 'groups');
		$db_group->load(array('id=?', $_POST["group_id"]));

		if ($db_group->dry()) {
			// not exists
			$f3->error(404);
		}

		if (isset($_POST["is_delete"]) && $_POST["is_delete"] == "1") {

			$db_group_owner = new \DB\SQL\Mapper($db, 'group_owner');
			$db_group_owner->load(array('group_id=?', $db_group->id));
			if (!$db_group->dry()) {
				$db_group_owner->erase();
			}

			// remove quotes in group
			$db->exec("
				DELETE FROM quotes 
				WHERE group_id = ? 
				AND is_private = 1 
			", [$db_group->id]);

			// $dataproxy->removeGroupFromCache($db_group);
			$db_group->erase();

			// clear session login data
			if ($f3->get('SESSION.tq_group_id') == $_POST["group_id"]) {
				$f3->set('SESSION.tq_group_id', null);
				$f3->set('SESSION.tq_group_h', null);
			}

			render_template('jump.html.twig', [
				"message" => "Groep verwijderd.",
				"jump_url" => site_url(),
				"jump_url_text" => "Naar home"
			]);

			exit(0);
		}

		// $naam = trim($_POST["naam"]);

		// $db_group->naam = $naam;
		$db_group->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$db_group->save();

		render_template('jump.html.twig', [
			"message" => "Groep geüpdatet.",
			"jump_url" => site_url('/login/' . $db_group["slug"] . '/' . $db_group["login_hash"]),
			"jump_url_text" => "Bekijk de groep"
		]);
	}
}

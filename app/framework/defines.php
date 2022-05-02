<?php

define("SITE_URL", 					rtrim(getenv('SITE_URL'), '/'));
define("ENVIRONMENT",				getenv('ENVIRONMENT'));

define("USE_TWIG_CACHE", 			getenv('USE_TWIG_CACHE') == "true");

define("DB_HOST", 					getenv('DB_HOST'));
define("DB_NAME", 					getenv('DB_NAME'));
define("DB_USER", 					getenv('DB_USER'));
define("DB_PASSWORD",				getenv('DB_PASSWORD'));

define("QUOTES_PER_PAGE",			48);

define("MAILCHIMP_URL",				getenv("MAILCHIMP_URL"));
define("MAILCHIMP_API_KEY",			getenv("MAILCHIMP_API_KEY"));
define("MAILCHIMP_LIST_ID",			getenv("MAILCHIMP_LIST_ID"));
define("MAILCHIMP_SERVER_PREFIX",	getenv("MAILCHIMP_SERVER_PREFIX"));

define("RECAPTCHA_SITE_KEY",		getenv("RECAPTCHA_SITE_KEY"));
define("RECAPTCHA_SECRET_KEY",		getenv("RECAPTCHA_SECRET_KEY"));
	
define("SITE_TITLE",				'topquote');
define("SITE_DESCRIPTION",			'Hilarische, ontroerende en betekenisvolle quotes, citaten en uitspraken van je collega s, kinderen, vrienden en (on)bekenden.');
	
define("SMTP_HOST",					getenv("SMTP_HOST"));
define("SMTP_USER",					getenv("SMTP_USER"));
define("SMTP_PASS",					getenv("SMTP_PASS"));
define("SMTP_SECURE",				getenv("SMTP_SECURE"));
define("SMTP_PORT",					getenv("SMTP_PORT"));
	
define("FROM_EMAIL",				getenv("FROM_EMAIL"));

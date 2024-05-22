<?php

define("SITE_URL", 					rtrim(getenv('SITE_URL'), '/'));
define("API_URL", 					rtrim(getenv('API_URL'), '/'));
define("SERVICE_URL",				rtrim(getenv('SERVICE_URL'), '/'));
define("ENVIRONMENT",				getenv('ENVIRONMENT'));

define('CACHE_DIR', 			 	getenv('CACHE_DIR') ?: '/var/www/cache');

define("USE_TWIG_CACHE", 			getenv('USE_TWIG_CACHE') == "true");

define("DB_HOST", 					getenv('DB_HOST'));
define("DB_NAME", 					getenv('DB_NAME'));
define("DB_USER", 					getenv('DB_USER'));
define("DB_PASSWORD",				getenv('DB_PASSWORD'));

define("QUOTES_PER_PAGE",			48);

define("REDIS_HOST",				getenv('REDIS_HOST'));
define("REDIS_PORT",				getenv('REDIS_PORT') ?: 6379);

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
define("TO_EMAIL",					getenv("TO_EMAIL"));

define("ADSENSE_CLIENT_ID",			getenv("ADSENSE_CLIENT_ID"));
define("ADSENSE_SLOT_INBETWEEN",	getenv("ADSENSE_SLOT_INBETWEEN"));

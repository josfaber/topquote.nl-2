<?php

define("SITE_URL", 				rtrim(getenv('SITE_URL'), '/'));

define("USE_TWIG_CACHE", 		getenv('USE_TWIG_CACHE') == "true");

define("DB_HOST", 				getenv('DB_HOST'));
define("DB_NAME", 				getenv('DB_NAME'));
define("DB_USER", 				getenv('DB_USER'));
define("DB_PASSWORD",			getenv('DB_PASSWORD'));

define("QUOTES_PER_PAGE",		48);

define("MAILCHIMP_URL",			getenv("MAILCHIMP_URL"));
define("RECAPTCHA_SITE_KEY",	getenv("RECAPTCHA_SITE_KEY"));
define("RECAPTCHA_SECRET_KEY",	getenv("RECAPTCHA_SECRET_KEY"));
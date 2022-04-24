<?php

namespace Controller;

class Quotes {

	function index(\Base $f3, $params) {
		!d( "Hello Quotes.", $params);
	}

	function by(\Base $f3, $params) {
		!d( "Hello Quotes by.", $params);
	}

	function from(\Base $f3, $params) {
		!d( "Hello Quotes from.", $params);
	}

	function tag(\Base $f3, $params) {
		!d( "Hello Quotes with tag.", $params);
	}

}
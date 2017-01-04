<?php

namespace App\Config;

class Auth
{
	function get_auth_token() {
	    $arg = json_encode($_REQUEST);
	    $path = dirname(dirname(dirname(__FILE__))).'/web/registermo';
	    return `$path $arg`;
	}
}
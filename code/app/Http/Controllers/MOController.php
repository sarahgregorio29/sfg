<?php

namespace App\Http\Controllers;
use App\Config\Auth;
use App\Http\MO;

class MOController
{
    public function addMO()
    {
    	return $token = (new Auth)->get_auth_token();
    	// $token = (new Auth)->get_auth_token();
    	// return (new MO)->save($token);
    }
}
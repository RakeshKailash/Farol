<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * summary
 */
class Authhandler
{
	function isLogged()
	{
		return (isset($_SESSION['username']) && $_SESSION['username'] != "" && isset($_SESSION['cod']) && $_SESSION['cod'] != "");
	}
}
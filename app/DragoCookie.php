<?php
namespace App;


class DragoCookie
{
	public static function setCookie($token,$expire,$secure)
	{
		setcookie("dragoCookie",$token, time()+ $expire,
		null,  null,  $secure,  true);
		
	}
	
	
	public static function getCookie()
	{
		
		if (isset($_COOKIE["dragoCookie"]))
				return $_COOKIE["dragoCookie"];
		else
			return null;
	
	}
	public static function removeCookie()
	{
		
		setcookie("dragoCookie", '', time() - 3600);
		
	}
}
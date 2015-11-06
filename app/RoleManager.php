<?php
namespace App;

use Illuminate\Support\Facades\Auth;

use Log;

class RoleManager
{
	private $roles=array();
	
	public function __construct($user)
	{
		foreach (RolePermission::where('profileid', $user->getAttribute("profileid"))->get() as $value)
				$this->roles[$value->getAttribute("action")]=$value->getAttribute("permission");
		
	}

	public function canDo($action)
	{
		Log::debug($action);
		Log::debug(print_r( $this->roles,true));
		Log::debug(array_search($action, $this->roles));
		if (array_key_exists($action, $this->roles))
		 	return $this->roles[$action]!='d';
		else
			return false;
	}
	
	
	public static function hasRole($role)
	{
	
		$user=Auth::user();
		if (isset($user))
    		if ($user->hasRole($role))
    			return $user;
		return null;
	}
	
	
}
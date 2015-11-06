<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use App\User;
use DB;
use App\RoleManager;

class UserDataController extends Controller
{
   
	public function __construct()
	{
		
		$this->middleware('App\Http\Middleware\CheckJWT',array(true));
	}
	
	public function createUser(Request $request)
	{
		Log::debug("JWTAuthController.createUser.begin");
		try{
				
			$credentials = $request->json()->all();
				
				
			$credentials['password']=Hash::make($credentials['password']);
				
				
			Log::debug("JWTAuthController.createUser:".print_r($request->json()->all(),true));
			$user=User::create($credentials);
	
			$token = JWTAuth::fromUser($user);
			
				
		}
		catch (Exception $e)
		{
			Log::error("JWTAuthController.createUser.exception:".$e->getMessage());
			return response()->json($e->getMessage());
		}
	
		Log::debug("JWTAuthController.createUser.end");
		return response()->json('ok');
	}
	
    public function getUsers()
    {
    	Log::debug("UserDataController.getUsers.begin");
    	
    	try{
    		
    		
    		
    		
    		
    		$query = DB::table('users')
    		->join('user_profiles', 'users.profileid', '=', 'user_profiles.id');
    		
    		if (RoleManager::hasRole("doctor")!=null)
    			$query=$query->where("user_profiles.name","user");
    		
    		$query=$query->select('users.id','users.username','users.name',
    				'users.lastname',
    				'users.created_at',
    				 'user_profiles.name as profile');
    		
    		 
    		 $users=$query->get();
    		
    		
    		
    		$resp= response()->json($users);
    	 
    	}
    	catch (Exception $e)
    	{
    		
    		Log::error("UserDataController.getUsers.begin");
    		
    		response()->json([errorCode=>100]);
    	}
    	Log::debug("UserDataController.getUsers.end");
    	return $resp;
    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use App\User;
use Illuminate\Support\Facades\Input;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use DB;
use Cookie;
use App\DragoCookie;

class JWTAuthController extends Controller
{
	
	public function logIn(Request $request)
	{
		Log::debug("JWTAuthController.logIn.begin");
		try{
			
			$username="";
			
			if (!$request->isJson())
				$credentials=["username"=>$request->get("username"),"password"=>$request->get("inputPassword")];
			
			else{
				
				Log::debug("JWTAuthController.logIn:".print_r($request->json()->all(),true));
				$credentials = $request->json()->all();
			
			}
			
			Log::debug("JWTAuthController.logIn.password:".$credentials['password']);
				
			$user = DB::table('users')->where('username',$credentials['username'])->first();
			
			Log::debug("JWTAuthController.user:".print_r($user,true));
			
			if ($user==null || !Hash::check($credentials['password'], $user->password))
			{
				
				if ($user==null)
					Log::debug("JWTAuthController.logIn.User Not Found");
				else
					Log::debug("JWTAuthController.logIn.Password Error");
				if ($request->isJson())
					return response()->json(false, 401);
				else
					return view("login",["errorMessage"=>"Wrong User Or Password"]);
			}
			
			$token = JWTAuth::fromUser($user);
			
			DragoCookie::setCookie($token,640,false);
			
		    
		}
		catch (Exception $e)
		{
			Log::error("JWTAuthController.logIn.exception:".$e->getMessage());
			if ($request->isJson())
				return response()->json($e->getMessage());
			else
				return view("login",["errorMessage"=>"Something gone wrong. Please Retry"]);
		}
	
		Log::debug("JWTAuthController.logIn.end");
		if ($request->isJson())
			return response()->json(["jwt"=>$token]);
		else
			return redirect('/');
	}



	public function logOut(Request $request)
	{
		Log::debug("JWTAuthController.logOut.begin");
		
		DragoCookie::removeCookie();
		
		Log::debug("JWTAuthController.logOut.end");
		return view("login");
	}

}
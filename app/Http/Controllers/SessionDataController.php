<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use App\Session;
use DB;
use App\RoleManager;
class SessionDataController extends Controller
{
   
    public function getSessions()
    {
    	Log::debug("SessionDataController.getSessions.begin");
    	
    	try{
    		
    		$params=request()->json()->all();
    		
    		
    		Log::debug("SessionDataController.getSessions.params:".print_r($params,true));
    		
    		
    		$table=DB::table('sessions');

    		$user=RoleManager::hasRole("user");
    		
    		if (isset($params['userid']) || $user!=null)
    		{ 
    			$userId=isset($params['userid'])? $params['userid']:$user->getKey();
    			
    			$devices=$table->join('users', 'userid', '=', 'users.id')
    			->join('devices', 'sessions.deviceid', '=', 'devices.id')
    			->where('users.id',$userId)
    				->select('sessions.id','sessionid','elapsed','sessions.created_at',
    				'users.username',
    				'users.lastname',
    				'devices.deviceid')
    				->get();
    			
    			
    			
    		}
    		else if (isset($params['deviceid']))
    		{
    			
    			$devices=$table->join('users', 'userid', '=', 'users.id')
    			->join('devices', 'sessions.deviceid', '=', 'devices.id')
    			->where('devices.id',$params['deviceid'])
    			->select('sessions.id','sessionid','elapsed','sessions.created_at',
    					'users.username',
    					'users.lastname',
    					'devices.deviceid')
    					->get();
    			
    		}
    		else
    		{
    			$devices=$table->join('users', 'userid', '=', 'users.id')
    			->join('devices', 'sessions.deviceid', '=', 'devices.id')
    			->select('sessions.id','sessionid','elapsed','sessions.created_at',
    					'users.username',
    					'users.lastname',
    					'devices.deviceid')
    					->get();
    			
    		}
    		
    		$resp= response()->json($devices);
    	 
    	}
    	catch (Exception $e)
    	{
    		
    		Log::error("SessionDataController.getSessions.begin");
    		
    		response()->json([errorCode=>100]);
    	}
    	Log::debug("SessionDataController.getSessions.end");
    	return $resp;
    }
    
    
}

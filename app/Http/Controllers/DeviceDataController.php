<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use App\Device;
use DB;
use App\RoleManager;



class DeviceDataController extends Controller
{
   
    public function getDevices()
    {
    	Log::debug("DeviceDataController.getDevices.begin");
    	
    	try{
    		
    		$query= DB::table('devices')->join('users', 'userid', '=', 'users.id');
    		
    		if (($user=RoleManager::hasRole("user"))!=null)
    			$query=$query->where("users.id",$user->getKey());
    		
    		$users=$query->select('devices.id','devices.deviceid','devices.status','users.username',
    				'users.name',
    				'users.lastname',
    				'devices.created_at')->get();
    		
    		
    		
    		$resp= response()->json($users);
    	 
    	}
    	catch (Exception $e)
    	{
    		
    		Log::error("DeviceDataController.getDevices.begin");
    		
    		response()->json([errorCode=>100]);
    	}
    	Log::debug("DeviceDataController.getDevices.end");
    	return $resp;
    }
    
    
}

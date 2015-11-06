<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;


use App\RoleManager;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug("DashboardController.index.begin");
    	
       	$user=Auth::user();
    	$roleManager=new RoleManager($user);
    	
    	$navMenu=array();
    	
    	if ($user->isAdmin() || $roleManager->canDo("Home"))
    		$navMenu[]=['link'=>'#showHome','label'=>'Home'];
    		
    	if ($user->isAdmin() || $roleManager->canDo("Devices"))
    		$navMenu[]=['link'=>'#showDevices','label'=>'Devices'];
    	
    	if ($user->isAdmin() || $roleManager->canDo("Users"))
    		$navMenu[]=['link'=>'#showUsers','label'=>'Users'];
    	
    	if ($user->isAdmin() || $roleManager->canDo("Sessions"))
    		$navMenu[]=['link'=>'#showSessions','label'=>'Sessions'];
    
    	Log::debug("DashboardController.index.menu:".print_r($navMenu,true));
    	
    	$resp= view('dashboard', ['navMenu'=>$navMenu,'user'=>$user,'username' => $user!=null ? $user->username:""]);
    	
    	
    	Log::debug("DashboardController.index.end");
    	return $resp;
    }
}
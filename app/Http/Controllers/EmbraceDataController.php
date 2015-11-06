<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;

class EmbraceDataController extends Controller
{
    
    public function getTEMP()
    {
    	Log::debug("EmbraceDataController.getTEMP.begin");
    	$path = storage_path() . '/app/' . config('app.temp');
    	
    	Log::debug("EmbraceDataController.getTEMP.loading:".$path);
    	
    	
    	$dSource=$this->loadDataSource($path);
    	$resp= response()->json($dSource);
    	
    	Log::debug("EmbraceDataController.getTEMP.end");
    	return $resp;
    }
    public function getACC()
    {
    	Log::debug("EmbraceDataController.getACC.begin");
    	$path = storage_path() . '/app/' . config('app.acc');
    	
    	Log::debug("EmbraceDataController.getACC.loading:".$path);
    	
    	$moduleCalc=function(&$data,&$eventData)
    	{
    		if (count($data)==3)
    			array_push($eventData, sqrt(pow(floatval($data[0])/64,2)+pow(floatval($data[0])/64,2)+pow(floatval($data[0])/64,2)));
    		
    	};
    	$dSource=$this->loadDataSource($path,$moduleCalc);
    	$resp= response()->json($dSource);
    	
    	Log::debug("EmbraceDataController.getACC.end");
    	return $resp;
    }
    public function getEDA()
    {
    	Log::debug("EmbraceDataController.getEDA.begin");
    	$path = storage_path() . '/app/' . config('app.eda');
    	 
    	Log::debug("EmbraceDataController.getEDA.loading:".$path);
    	 
    	$dSource=$this->loadDataSource($path);
    	$resp= response()->json($dSource);
    	 
    	Log::debug("EmbraceDataController.getEDA.end");
    	return $resp;
   	}
    public function getHR()
    {
    	Log::debug("EmbraceDataController.getHR.begin");
    	$path = storage_path() . '/app/' . config('app.hr');
    	
    	Log::debug("EmbraceDataController.getHR.loading:".$path);
    	
    	$dSource=$this->loadDataSource($path);
    	$resp= response()->json($dSource);
    	
    	Log::debug("EmbraceDataController.getHR.end");
    	return $resp;    	 
    	 
    }
    
    
    private function loadDataSource($fName,$transformFunction=null)
    {
    	Log::debug("EmbraceDataController.loadDataSource.begin");
    	Log::debug("EmbraceDataController.loading:".$fName);
    	$handle=null;
    	
    	
    	$dataSource=array();
    	
    	try{
	    	if (($handle = fopen($fName, "r")) !== FALSE) {
	    		
	    		$eventTime=0;
	    		$elapsed=0;
	    		
	    		if (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
	    		{
	    			
	    			$eventTime=floatval($data[0]);
	    			$startTime=$eventTime;
	    			if ($eventTime==0)
	    				throw new Exception("Start Time Wrong Format:".$data[0]);
	    			
	    			Log::debug("Start Time:".date("r",$eventTime));
	    			
	    			if (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
			    		
	    				$frequency=intval($data[0]);
	    				Log::debug("Frequency:".($data[0]));
	    				if ($frequency==0)
	    					throw new Exception("Frequency Wrong Format:".$data[0]);
	    				
	    				
	    				$dataSource["s"]=$eventTime*1000;
	    				$dataSource["f"]=$frequency;
	    				
	    				
	    				//$millis=floatval(1/$frequency);
	    				
	    				//$tz = new DateTimeZone("Etc/UTC");
	    				
	    				$eventData=array();
	    				
	    				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    			
	    						$num = count($data);
			    			
			    				//$milliSeconds=floor(($eventTime-intval($eventTime))*1000);
			    			
			    				
			    				$values=array();
			    				
			    				if ($transformFunction==null){
				    				for ($c=0; $c < $num; $c++) {
				    			
				    					
				    					array_push($eventData, floatval($data[$c]));
				    				}
			    				}
			    				else 
			    					$transformFunction($data,$eventData);
			    				
			    				
			    				
			    				//$eventTime=$eventTime+$millis;
			    				
			    				
			    		}
			    		
			    		$maxCampioni=config('app.maxSamples');
			    		
			    		Log::debug($maxCampioni);
			    		Log::debug(count($eventData));
			    		
			    		if (count($eventData)>$maxCampioni)
			    		{
			    			
			    			$nCamp=round(count($eventData)/$maxCampioni);
			    			
			    			Log::debug($nCamp);
			    			
			    			$addedCamp=0;
			    			$sCamp=0;
			    			$mediaCamp=0;
			    			$newEventData=array();
			    			foreach ($eventData as $value) {
							
			    				if ($addedCamp<=$nCamp){
			    					$addedCamp++;
			    					$sCamp=$sCamp+$value;
			    					$mediaCamp=floatVal($sCamp/$addedCamp);
			    				}
			    				else
			    				{
			    					
			    					$addedCamp=0;
			    					$sCamp=0;
			    					array_push($newEventData,$mediaCamp);
			    				}	
			    			}
			    			if ($addedCamp>0)
			    				array_push($newEventData,$mediaCamp);
			    			
			    			$eventData=$newEventData;
			    			$newFreq=$frequency/$nCamp;
			    			Log::debug($newFreq);
			    			$dataSource["f"]=intval($newFreq);
			    		}
			    		
			    		
			    		$dataSource["d"]=$eventData;
			    		
			    		
	    			}
	    			else
	    				throw new Exception("Frequency Not Found");
	    			
	    		}
	    		else
	    			throw new Exception("Start Time Not Found");
	    		fclose($handle);
	    	}
	    	else
	    		throw new Exception("Data Source Not Found");
	    	
	    	
	    	
	    	
	    	
	    	
    	}
    	catch (Exception $e)
    	{
    		if ($handle!=null)
    			fclose($handle);
    		throw $e;
    		
    	}
    	Log::debug("EmbraceDataController.loadDataSource.end");
    	return $dataSource;
    }
    
    
    
}

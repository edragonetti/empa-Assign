<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

use App\DragoCookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Log;
use Request;


class CheckJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next,$isRest="Rest")
    {
    	Log::debug("CheckJWT.handle.begin");
    	
    	$isAjax=$isRest=="Rest";
    	
    	
    	Log::warning("Rest call:".$isAjax);
    	
    	$jwt=DragoCookie::getCookie();
    	$token=null;
    	if ($jwt!=null)
    		$token=JWTAuth::setToken($jwt);
    	else
    		$token=JWTAuth::getToken();

    	if ($token==null){
    		
    		Log::warning("CheckJWT.handle.token invalid");
    		
    		
    		
    		if ($isAjax)
    			return response("token invalid",401);
    		else
    			return redirect('login');
    	}
        try {
            $user = $token->authenticate();
           
            Log::debug("CheckJWT.handle.user:".print_r($user,true));
            
            
        } catch (TokenExpiredException $e) {
        	Log::warning("CheckJWT.handle.token expired");
            
        	if ($isAjax)
        		return response("token expired",401);
        	else
        		return redirect('login');
        } catch (JWTException $e) {
        	Log::warning("CheckJWT.handle.token invalid");
        	if ($isAjax)
        		return response("token invalid",401);
        	else
        		return redirect('login');
        }

        if (! $user) {
        	Log::warning("CheckJWT.handle.user not found");
        	if ($isAjax)
        		return response("token invalid",401);
        	else
        		return redirect('login');
        }
        
        

        Log::debug("CheckJWT.handle.end");
     	return $next($request);
    }
}

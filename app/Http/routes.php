<?php

use Illuminate\Support\Facades\Auth;
use App\RoleManager;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//login page
Route::get('login', function () {
	return view('login');
});


Route::post('checkLogin', 'JWTAuthController@logIn');

Route::any('logOut', 'JWTAuthController@logOut');

Route::get('/', [
	'middleware' => 'App\Http\Middleware\CheckJWT:',
	'uses' => 'DashboardController@index'
	]);



Route::get('showUsers',['middleware' => 'App\Http\Middleware\CheckJWT:', function () {
	
	if (RoleManager::hasRole("user")!=null || RoleManager::hasRole("operator")!=null)
		return "";
	return view('users');
}]);

Route::get('showDevices', ['middleware' => 'App\Http\Middleware\CheckJWT:',function () {
	
	
	return view('devices');
}	
]);

Route::get('showSessions', function () {
	return view('sessions');
	}
);


Route::get('showHome',['middleware' => 'App\Http\Middleware\CheckJWT:', function () {
	
	$user=Auth::user();
	return view('home',['user'=>$user]);
}
]);

Route::get('viewSession', function () {
		return view('session_view');
	}
);

//REST

Route::post('api/logIn', 'JWTAuthController@logIn');

Route::group(['prefix' => 'api','middleware' => 'App\Http\Middleware\CheckJWT'], function () {
	
	Route::post('getTemp', 'EmbraceDataController@getTEMP');
	Route::post('getEda', 'EmbraceDataController@getEDA');
	Route::post('getAcc', 'EmbraceDataController@getACC');
	Route::post('getHr', 'EmbraceDataController@getHR');
	
	Route::post('getUsers', 'UserDataController@getUsers');
	
	Route::post('getDevices', 'DeviceDataController@getDevices');
	
	Route::post('getSessions', 'SessionDataController@getSessions');
	
	Route::post('createUser', 'UserDataController@createUser');
	
});



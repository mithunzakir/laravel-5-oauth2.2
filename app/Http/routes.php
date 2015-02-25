<?php

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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::any('{provider}/authorize', function($provider) {
    return OAuth::authorize($provider);
});

Route::any('{provider}/login', function($provider) {
    OAuth::login($provider, function($user, $userDetails){
    	// dd($userDetails);die();
  	$user->email = $userDetails->email;
  	$user->name = $userDetails->lastName;
  	$user->save();
    });
    return redirect('/');

});


// Route::get('google/authorize', function() {
//     return OAuth::authorize('google');
// });

// Route::get('google/login', function() {
//     OAuth::login('google', function($user, $userDetails){
//     	dd($userDetails);
//   	// $user->email = $userDetails->email;
//   	// $user->name = $userDetails->nickname;
//   	// $user->save();
//     });
// });
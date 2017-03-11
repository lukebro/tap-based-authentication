<?php

Route::get('/', function () {
    return view('app');
})->name('login');

Route::get('/paper', function () {
	return response()->download('Tapped-based_Authentication_for_Mobile_Device_Security.pdf');
});


Route::group(['prefix' => 'api'], function () {

	Route::post('login', 'Auth\LoginController@login');
	Route::post('register', 'Auth\RegisterController@register');
	Route::get('logout', 'Auth\LoginController@logout');

	Route::post('master', 'HomeController@master');
	Route::post('attempt', 'HomeController@attempt');
	Route::get('statistics', 'HomeController@statistics');
	Route::delete('statistics/reset', 'HomeController@reset');
	Route::get('user', 'HomeController@user');

});

Route::get('global', function () {
	$users = App\User::all();

	return view('global', [
		'users' => $users
	]);

})->middleware(['auth', 'admin']);

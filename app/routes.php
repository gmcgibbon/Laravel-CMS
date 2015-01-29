<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+'); // IDs must be numeric

// universal routes
Route::group([], function()
{
	Route::get('/', 
		[
			'as'   => 'page.index',
			'uses' => 'PageController@index'
		]);

	Route::get('/archive', 
		[
			'as'   => 'page.archive',
			'uses' => 'PageController@archive'
		]);

	Route::get('/{id}/{link?}', 
		[
			'as'     => 'page.show',
			'uses'   => 'PageController@show',
		]);
});

// guest only routes
Route::group(['before' => 'auth.guest'], function()
{
	Route::get('/login', 
		[
			'as'   => 'page.login',
			'uses' => 'PageController@login'
		]);
	
	Route::post('/login',
		[
			'as'   => 'auth.login',
			'uses' => 'AuthController@login'
		]);
});

// user only routes
Route::group(['before' => 'auth.user'], function()
{
	Route::delete('/logout',
		[
			'as'   => 'auth.logout',
			'uses' => 'AuthController@logout'
		]);

	Route::get('/admin', 
		[
			'as'   => 'page.admin',
			'uses' => 'PageController@admin'
		]);

	Route::get('/page/create', 
		[
			'as'   => 'page.create',
			'uses' => 'PageController@create'
		]);

	Route::post('/page/add', 
		[
			'as'     => 'page.add',
			'uses'   => 'PageController@add',
			'before' => [ 'csrf', 'permalink.slugify' ]
		]);

	Route::get('/page/edit/{id}', 
		[
			'as'   => 'page.edit',
			'uses' => 'PageController@edit'
		]);

	Route::put('/page/update/{id}',
		[
			'as'     => 'page.update',
			'uses'   => 'PageController@update',
			'before' => [ 'csrf', 'permalink.slugify' ]
		]);

	Route::delete('/page/delete/{id}',
		[
			'as'   => 'page.delete',
			'uses' => 'PageController@delete'
		]);

	Route::post('/page/index/set',
		[
			'as'   => 'page.index.set',
			'uses' => 'PageController@setIndex'
		]);
});

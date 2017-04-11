<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index');

Route::group(['as' => 'logins.', 'prefix' => 'login'], function(){
	Route::get('facebook', 'Auth\LoginController@redirectToProvider');
	Route::get('facebook/callback', 'Auth\LoginController@handleProviderCallback');
});

Route::group(['as' => 'championships.', 'prefix' => 'Campeonatos', 'middleware' => 'auth'], function(){

	Route::get('/', ['as' => 'index', 'uses' => 'ChampionshipController@index']);	
	Route::get('/cadastrar', ['as' => 'create', 'uses' => 'ChampionshipController@create']);	
	Route::post('/salvar', ['as' => 'store', 'uses' => 'ChampionshipController@store']);
	Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'ChampionshipController@destroy']);	
	Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'ChampionshipController@edit']);
	Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'ChampionshipController@update']);
	
});

Route::group(['as' => 'games.', 'prefix' => 'Jogos', 'middleware' => 'auth'], function(){

	Route::get('/', ['as' => 'index', 'uses' => 'GameController@index']);	
	Route::get('/cadastrar', ['as' => 'create', 'uses' => 'GameController@create']);	
	Route::post('/salvar', ['as' => 'store', 'uses' => 'GameController@store']);
	Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'GameController@destroy']);	
	Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'GameController@edit']);
	Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'GameController@update']);
	
});

Route::group(['as' => 'teams.', 'prefix' => 'Times', 'middleware' => 'auth'], function(){

	Route::get('/', ['as' => 'index', 'uses' => 'TeamController@index']);	
	Route::get('/cadastrar', ['as' => 'create', 'uses' => 'TeamController@create']);	
	Route::post('/salvar', ['as' => 'store', 'uses' => 'TeamController@store']);
	Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'TeamController@destroy']);	
	Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'TeamController@edit']);
	Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'TeamController@update']);
	
});

Route::group(['as' => 'standings.', 'prefix' => 'Classificacao', 'middleware' => 'auth'], function(){

	Route::get('/{championshipId?}', ['as' => 'index', 'uses' => 'StandingsController@index']);	
	
	
});
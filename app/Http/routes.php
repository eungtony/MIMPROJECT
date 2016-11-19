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

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::auth();

Route::group(['middleware' => ['web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

//User
    Route::get('/user', 'userController@index')->name('user');
    Route::post('/user/{id}', 'userController@edit');

//Projet
    Route::get('/projet/{id}/{ida}', 'projetController@index')->name('projet');
    Route::post('/projet/add', 'projetController@add')->name('add.projet');
    Route::post('/projet/{id}/edit', 'projetController@edit')->name('edit.projet');

//Agence
    Route::get('/agence/{id}', 'agenceController@index')->name('agence');
    Route::post('/agence/{id}', 'agenceController@addFile')->name('file.agence');

//Tâches
    Route::post('/tache/add', 'tacheController@add')->name('add.tache');
    Route::post('/modify/{id}/{pid}', 'tacheController@edit')->name('edit.tache');
    Route::resource('tache', 'tacheController');
});

Route::group(['middleware' => ['restrict']], function () {

//Agence
    Route::get('/agence/edit/{id}', 'agenceController@editForm')->name('edit.form.agence');
    Route::get('/agence/{id}/edit/', 'agenceController@edit')->name('edit.agence');

//Projet
    Route::get('/projet/{id}', 'projetController@addForm')->name('form.add.projet');
    Route::get('/projet/edit/{id}/{idp}', 'projetController@editForm')->name('edit.form.projet');

//Tâches
    Route::get('/tache/add/{id}/{idp}', 'tacheController@addForm')->name('form.add.tache');

});
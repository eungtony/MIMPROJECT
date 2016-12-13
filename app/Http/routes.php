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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

//User
Route::get('/user', 'userController@index')->name('user');
Route::get('/user/{id}', 'userController@user')->name('profile');
Route::get('/user/edit/{id}', 'userController@editForm')->name('edit.user');
Route::post('/user/{id}/edit', 'userController@edit')->name('user.edit');
Route::post('/user/edit/avatar/{id}', 'userController@editAvatar')->name('user.avatar');

//Projet
Route::get('/projet/{id}/{ida}', 'projetController@index')->name('projet');
Route::post('/projet/add', 'projetController@add')->name('add.projet');
Route::post('/projet/{id}/edit', 'projetController@edit')->name('edit.projet');
Route::delete('/projet/delete/{ida}/{id}', 'projetController@destroy')->name('projet.destroy');
Route::post('/projet/{ida}/{id}', 'projetController@addFile')->name('file.projet');
Route::post('/projet/edit/file/{ida}/{pid}/{id}', 'projetController@editFile')->name('file.edit.projet');
Route::delete('/projet/delete/file/{ida}/{pid}/{id}', 'projetController@deleteFile')->name('file.delete.projet');

//Agence
Route::get('/agence/{id}', 'agenceController@index')->name('agence');
Route::post('/agence/{id}', 'agenceController@addFile')->name('file.agence');
Route::post('/agence/edit/file/{ida}/{id}', 'agenceController@editFile')->name('file.edit');
Route::delete('/agence/delete/file/{ida}/{id}', 'agenceController@deleteFile')->name('file.delete');
Route::post('/agence/message/{ida}/{id}', 'agenceController@addMessage')->name('message.agence');
Route::post('/message/edit/{id}', 'agenceController@editMessage')->name('message.edit');
Route::delete('/agence/delete/message/{ida}/{id}', 'agenceController@deleteMessage')->name('message.delete');
Route::get('agence/show/{id}', 'agenceController@show')->name('show.agence');


//Tâches
Route::get('/tache/{ida}/{pid}/{id}', 'tacheController@index')->name('index.tache');
Route::post('/tache/add', 'tacheController@add')->name('add.tache');
Route::post('/modify/{id}/{pid}', 'tacheController@edit')->name('edit.tache');
Route::post('/tache/check', 'tacheController@checkTask')->name('check.tache');
Route::post('/tache/uncheck', 'tacheController@uncheckTask')->name('uncheck.tache');
Route::resource('tache', 'tacheController');
Route::post('/addcommentaire', 'tacheController@addCommentaire')->name('add.tache.commentaire');

//Supervisor
Route::get('/supervisor', 'agenceController@supervisor')->name('supervisor');
Route::post('/supervisor/add/agence', 'agenceController@add')->name('add.agence');
Route::post('/supervisor/addorremovemoney', 'HomeController@addOrRemoveMoney')->name('money');
Route::get('/livret-de-compte', 'HomeController@livret')->name('livret');
Route::post('/livret/edit/{id}', 'HomeController@editMontant')->name('edit.montant');
Route::delete('/livret/delete/{id}', 'HomeController@deleteMontant')->name('delete.montant');

//Notifications
Route::get('add/notif/{type}/{id?}', 'NotificationsController@create')->name('form.add.notif');
Route::post('add/notif/{type}/{id?}', 'NotificationsController@store');
Route::get('show/notif/all', 'NotificationsController@showAll')->name('show.notif.all');
Route::get('delete/notif/{id}', 'NotificationsController@destroy');

Route::group(['middleware' => ['restrict']], function () {

//Agence
    Route::get('/agence/edit/{id}', 'agenceController@editForm')->name('edit.form.agence');
    Route::get('/agence/{id}/edit/', 'agenceController@edit')->name('edit.agence');

//Projet
    Route::get('/projet/{id}', 'projetController@addForm')->name('form.add.projet');
    Route::get('/projet/edit/{id}/{idp}', 'projetController@editForm')->name('edit.form.projet');

//Tâches
    Route::get('/add/tache/{id}/{idp}', 'tacheController@addForm')->name('form.add.tache');
});
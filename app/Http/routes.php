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
Route::get('/waiting', function() {
    //
    return view('waiting');
});
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/add/account', 'userController@add')->name('add.user');

//User
Route::get('/user', 'userController@index')->name('user');
Route::get('/user/{id}', 'userController@user')->name('profile');
Route::get('/user/edit/{id}', 'userController@editForm')->name('edit.user');
Route::post('/user/{id}/edit', 'userController@edit')->name('user.edit');
Route::post('/user/edit/avatar/{id}', 'userController@editAvatar')->name('user.avatar');
Route::post('/user/description/{id}', 'userController@editDescription')->name('user.description');
Route::post('/user/edit/parameters/{id}', 'userController@editParameters')->name('user.parameters');
Route::get('users/validation', 'userController@validation');
Route::get('users/valid/{id}', 'userController@valid')->where('id', '[0-9]+')->name('users.validation');
Route::get('users/unvalid/{id}', 'userController@unvalid')->where('id', '[0-9]+')->name('users.unvalidation');
Route::post('/add/account', 'userController@addAction')->name('add.user.action');
Route::delete('/delete/{userid?}/delete', 'userController@destroy')->name('destroy.user');

//Projet
Route::get('/projet/{id}/{ida}', 'projetController@index')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('projet');
Route::post('/projet/add', 'projetController@add')->name('add.projet');
Route::post('/projet/{id}/edit', 'projetController@edit')->where('id', '[0-9]+')->name('edit.projet');
Route::delete('/projet/delete/{ida}/{id}', 'projetController@destroy')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('projet.destroy');
Route::post('/projet/{ida}/{id}', 'projetController@addFile')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('file.projet');
Route::post('/projet/edit/file/{ida}/{pid}/{id}', 'projetController@editFile')->name('file.edit.projet');
Route::delete('/projet/delete/file/{ida}/{pid}/{id}', 'projetController@deleteFile')->name('file.delete.projet');
Route::post('/projet/{projet_id?}/agence/{agence_id}', 'projetController@addProjetAgence')->name('add.projet.agence')->where(['projet_id' => '[0-9]+', 'agence_id' => '[0-9]+']);
Route::delete('/projet/{id?}/agence/delete', 'projetController@deleteProjetAgence')->name('delete.projet.agence')->where(['id' => '[0-9]+']);
Route::post('/projet/attribute/{projetid?}', 'projetController@attributeProject')->name('attribute.project')->where(['projet_id' => '[0-9]+']);
Route::post('/project/{projetid?}/free/edit/', 'projetController@editFreeProject')->name('edit.free.project')->where(['projetid' => '[0-9]+']);

//Agence
Route::get('/agence/{id}', 'agenceController@index')->where('id', '[0-9]+')->name('agence');
Route::post('/agence/{id}', 'agenceController@addFile')->where('id', '[0-9]+')->name('file.agence');
Route::post('/agence/edit/file/{ida}/{id}', 'agenceController@editFile')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('file.edit');
Route::delete('/agence/delete/file/{ida}/{id}', 'agenceController@deleteFile')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('file.delete');
Route::post('/agence/message/{ida}/{id}', 'agenceController@addMessage')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('message.agence');
Route::post('/message/edit/{id}', 'agenceController@editMessage')->where('id', '[0-9]+')->name('message.edit');
Route::delete('/agence/delete/message/{ida}/{id}', 'agenceController@deleteMessage')->where(['id' => '[0-9]+', 'ida' => '[0-9]+'])->name('message.delete');
Route::get('agence/show/{id}', 'agenceController@show')->where('id', '[0-9]+')->name('show.agence');


//Tâches
Route::get('/tache/{ida}/{pid}/{id}', 'tacheController@index')->name('index.tache');
Route::post('/tache/add', 'tacheController@add')->name('add.tache');
Route::post('/modify/{id}/{pid}', 'tacheController@edit')->where(['id' => '[0-9]+', 'pid' => '[0-9]+'])->name('edit.tache');
Route::post('/tache/check', 'tacheController@checkTask')->name('check.tache');
Route::post('/tache/uncheck', 'tacheController@uncheckTask')->name('uncheck.tache');
Route::resource('tache', 'tacheController');
Route::post('/addcommentaire', 'tacheController@addCommentaire')->name('add.tache.commentaire');
Route::post('/editcommentaire/{tid}/{id}', 'tacheController@editCommentaire')->where(['id' => '[0-9]+', 'tid' => '[0-9]+'])->name('edit.tache.commentaire');
Route::delete('/destroy/commentary/{tid}/{id}', 'tacheController@deleteCommentaire')->where(['id' => '[0-9]+', 'tid' => '[0-9]+'])->name('destroy.tache.commentaire');
Route::post('/task/add/hours', 'tacheController@addHours')->name('add.hours');
Route::post('task/{id}/edit', 'tacheController@editHours')->where(['id' => '[0-9]+'])->name('edit.hours');
Route::delete('task/delete/{id}', 'tacheController@deleteHours')->where(['id' => '[0-9]+'])->name('delete.hours');

//Supervisor
Route::get('/supervisor', 'agenceController@supervisor')->name('supervisor');
Route::post('/supervisor/add/agence', 'agenceController@add')->name('add.agence');
Route::post('/supervisor/addorremovemoney', 'HomeController@addOrRemoveMoney')->name('money');
Route::get('/livret-de-compte', 'HomeController@livret')->name('livret');
Route::post('/livret/edit/{id}', 'HomeController@editMontant')->where('id', '[0-9]+')->name('edit.montant');
Route::delete('/livret/delete/{id}', 'HomeController@deleteMontant')->where('id', '[0-9]+')->name('delete.montant');

//Notifications
Route::get('add/notif/{type}/{id?}', 'NotificationsController@create')->where('id', '[0-9]+')->name('form.add.notif');
Route::post('add/notif/{type}/{id?}', 'NotificationsController@store')->where('id', '[0-9]+');
Route::get('show/notif/all', 'NotificationsController@showAll')->name('show.notif.all');
Route::get('delete/notif/{id}', 'NotificationsController@destroy')->where('id', '[0-9]+')->name('delete.notif');

Route::get('new-login', function () {
    return view('auth.new-login');
});

// Events
Route::get('show/event', 'EventsController@index')->name('index.event');
Route::post('add/event', 'EventsController@add')->name('add.event');
Route::post('edit/event/{id}', 'EventsController@edit')->where('id', '[0-9]+')->name('edit.event');
Route::get('register/event/{event}/{student}', 'EventsController@register')->name('register.event');
Route::get('unregister/event/{event}/{student}', 'EventsController@unregister')->name('unregister.event');
Route::get('delete/event/{id}', 'EventsController@delete')->where('id', '[0-9]+')->name('delete.event');

// Devis
Route::post('/devis/{agenceid?}/{projetid?}/{userid?}', 'DevisController@addDevis')->name('add.devis')->where(['agenceid' => '[0-9]+', 'projetid' => '[0-9]+', 'userid' => '[0-9]+']);
Route::post('/devis/taches/{agenceid?}/{projetid?}/{devisid?}', 'DevisController@addTask')->name('add.devis.task')->where(['agenceid' => '[0-9]+', 'projetid' => '[0-9]+', 'devisid' => '[0-9]+']);
Route::delete('/devis/delete/taches/{agenceid?}/{projetid?}/{devisid?}', 'DevisController@deleteTask')->name('delete.devis.task')->where(['agenceid' => '[0-9]+', 'projetid' => '[0-9]+', 'devisid' => '[0-9]+']);
Route::post('/devis/edit/taches/{agenceid?}/{projetid?}/{devisid?}', 'DevisController@editTask')->name('edit.devis.task')->where(['agenceid' => '[0-9]+', 'projetid' => '[0-9]+', 'devisid' => '[0-9]+']);
Route::post('/devis/valide/{devisid?}', 'DevisController@valideDevis')->name('valide.devis')->where(['devisid' => '[0-9]+']);
Route::post('/devis/devalide/{devisid?}', 'DevisController@devalideDevis')->name('devalide.devis')->where(['devisid' => '[0-9]+']);
Route::post('/devis/valide/cp/{devisid?}/', 'DevisController@cpValideDevis')->name('cp.valide.devis')->where(['devisid' => '[0-9]+']);

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

Route::get('test/v2', 'HomeController@indexTest');
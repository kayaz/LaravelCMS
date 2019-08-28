<?php

// Front
Route::get('/', 'Front\IndexController@index')->name('front.index');
Route::get('/kontakt', 'Front\KontaktController@index')->name('front.kontakt');
Route::post('/kontakt', 'Front\KontaktController@send')->name('front.kontakt.send');
//
Route::get('/aktualne-inwestycje', 'Front\InwestycjaController@index')->name('front.inwestycje');

// Aktualności
Route::group(['namespace' => 'Front', 'prefix'=>'/aktualnosci/', 'as' => 'front.news.'], function() {
    Route::get('/', 'NewsController@index', function() {return View::make('content');})->name('index');
    Route::get('/{slug}', 'NewsController@show')->name('wpis');
});

// Logowanie
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Robimy admina
Route::get('/admin', 'AdminUstawienia\IndexController@index')->name('admin.ustawienia.dashboard')->middleware('auth');

Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/ustawienia/', 'as' => 'admin.ustawienia.', 'middleware' => 'auth'], function() {
    Route::get('/', 'UstawieniaController@index')->name('index');
    Route::put('update', 'UstawieniaController@update')->name('update');
    Route::get('social', 'UstawieniaController@social')->name('social');
    Route::put('social/update', 'UstawieniaController@socialupdate')->name('social.update');
});

// Robimy menu
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/menu/', 'as' => 'admin.menu.', 'middleware' => 'auth'], function() {
    Route::get('/', 'MenuController@index')->name('index');

    Route::get('dodaj', 'MenuController@create')->name('dodaj');
    Route::post('zapisz', 'MenuController@store')->name('zapisz');
    Route::get('edytuj/{menu}', 'MenuController@edit')->name('edytuj');
    Route::put('update/{menu}', 'MenuController@update')->name('update');
    Route::delete('usun/{menu}', 'MenuController@destroy')->name('usun');
});

//// Robimy inwestycje
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/inwestycja/', 'as' => 'admin.inwestycja.', 'middleware' => 'auth'], function() {
    Route::get('/', 'InwestycjaController@index')->name('index');

    Route::get('dodaj', 'InwestycjaController@create')->name('dodaj');
    Route::post('zapisz', 'InwestycjaController@store')->name('zapisz');
    Route::get('edytuj/{inwestycja}', 'InwestycjaController@edit')->name('edytuj');
    Route::put('update/{inwestycja}', 'InwestycjaController@update')->name('update');
    Route::delete('usun/{inwestycja}', 'InwestycjaController@destroy')->name('usun');
});
//
// Robimy slider
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/slider/', 'as' => 'admin.slider.', 'middleware' => 'auth'], function() {
        Route::get('/', 'SliderController@index')->name('index');

        Route::get('dodaj', 'SliderController@create')->name('dodaj');
        Route::post('zapisz', 'SliderController@store')->name('zapisz');
        Route::get('edytuj/{slider}', 'SliderController@edit')->name('edytuj');
        Route::put('update/{slider}', 'SliderController@update')->name('update');
        Route::delete('usun/{slider}', 'SliderController@destroy')->name('usun');
        Route::post('ustaw', 'SliderController@sort')->name('sort');
});

// Robimy boksy
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/boks/', 'as' => 'admin.boks.', 'middleware' => 'auth'], function() {
        Route::get('/', 'BoksController@index')->name('index');

        Route::get('dodaj', 'BoksController@create')->name('dodaj');
        Route::post('zapisz', 'BoksController@store')->name('zapisz');
        Route::get('edytuj/{boks}', 'BoksController@edit')->name('edytuj');
        Route::put('update/{boks}', 'BoksController@update')->name('update');
        Route::delete('usun/{boks}', 'BoksController@destroy')->name('usun');
        Route::post('ustaw', 'BoksController@sort')->name('sort');
});

// Robimy aktualnosci
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/news/', 'as' => 'admin.news.', 'middleware' => 'auth'], function() {
        Route::get('/', 'NewsController@index')->name('index');

        Route::get('dodaj', 'NewsController@create')->name('dodaj');
        Route::post('zapisz', 'NewsController@store')->name('zapisz');
        Route::get('edytuj/{news}', 'NewsController@edit')->name('edytuj');
        Route::put('update/{news}', 'NewsController@update')->name('update');
        Route::delete('usun/{news}', 'NewsController@destroy')->name('usun');
});

// Robimy galerie
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/galeria/', 'as' => 'admin.galeria.', 'middleware' => 'auth'], function() {
        Route::get('/', 'GaleriaController@index')->name('index');

        Route::get('dodaj-katalog', 'GaleriaController@create')->name('dodaj');
        Route::post('zapisz-katalog', 'GaleriaController@store')->name('zapisz');
        Route::get('edytuj-katalog/{galeria}', 'GaleriaController@edit')->name('edytuj');
        Route::put('update/{galeria}', 'GaleriaController@update')->name('update');
        Route::delete('usun-katalog/{galeria}', 'GaleriaController@destroy')->name('usun');

    // Zdjecia galerii
        Route::get('pokaz-katalog/{id}', 'GaleriaController@show')->name('pokaz');
        Route::post('upload/{id}', 'GaleriaController@upload')->name('upload');
        Route::delete('usun-zdjecie/{id}/{gal}', 'GaleriaController@destroyphoto')->name('usunzdjecie');
        Route::post('ustaw', 'GaleriaController@sort')->name('sort');

});

// Robimy uzytkownikow
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/users/', 'as' => 'admin.users.', 'middleware' => 'auth'], function() {
    Route::get('/', 'UsersController@index')->name('index');

    Route::get('dodaj', 'UsersController@create')->name('dodaj');
    Route::post('zapisz', 'UsersController@store')->name('zapisz');
    Route::get('edytuj/{users}', 'UsersController@edit')->name('edytuj');
    Route::get('haslo/{users}', 'UsersController@password')->name('haslo');
    Route::delete('usun/{users}', 'UsersController@destroy')->name('usun');
    Route::put('update/{users}', 'UsersController@update')->name('update');
    Route::put('zmienhaslo/{users}', 'UsersController@updatepassword')->name('updatepass');
});

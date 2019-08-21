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

// Front
Route::get('/', 'IndexController@index')->name('front.index');
Route::get('/kontakt', 'Kontakt\IndexController@index')->name('front.kontakt');
Route::post('/kontakt', 'Kontakt\IndexController@send')->name('front.kontakt.send');

// Aktualności
Route::group(['namespace' => 'News', 'prefix'=>'/aktualnosci/', 'as' => 'front.news.'], function() {
    Route::get('/', 'IndexController@index', function() {return View::make('content');})->name('index');
    Route::get('/{slug}', 'IndexController@show')->name('wpis');
});


// Logowanie
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin', 'AdminUstawienia\IndexController@index')->name('admin.ustawienia.dashboard')->middleware('auth');

// Robimy admina
Route::group(['namespace' => 'AdminUstawienia', 'prefix'=>'/admin/ustawienia/', 'as' => 'admin.ustawienia.', 'middleware' => 'auth'], function() {
    Route::get('/', 'IndexController@index')->name('index');
    Route::put('update', 'IndexController@update')->name('update');
    Route::get('social', 'IndexController@social')->name('social');
    Route::put('social/update', 'IndexController@socialupdate')->name('social.update');
});

// Robimy menu
Route::group(['namespace' => 'AdminMenu', 'prefix'=>'/admin/menu/', 'as' => 'admin.menu.', 'middleware' => 'auth'], function() {
    Route::get('/', 'IndexController@index')->name('index');

    Route::get('dodaj', 'IndexController@create')->name('dodaj');
    Route::post('zapisz', 'IndexController@store')->name('zapisz');
    Route::get('edytuj/{id}', 'IndexController@edit')->name('edytuj');
    Route::put('update/{id}', 'IndexController@update')->name('update');
    Route::delete('usun/{id}', 'IndexController@destroy')->name('usun');
});

// Robimy slider
Route::group(['namespace' => 'AdminSlider', 'prefix'=>'/admin/slider/', 'as' => 'admin.slider.', 'middleware' => 'auth'], function() {
        Route::get('/', 'IndexController@index')->name('index');

        Route::get('dodaj', 'IndexController@create')->name('dodaj');
        Route::post('zapisz', 'IndexController@store')->name('zapisz');
        Route::get('edytuj/{id}', 'IndexController@edit')->name('edytuj');
        Route::put('update/{id}', 'IndexController@update')->name('update');
        Route::delete('usun/{id}', 'IndexController@destroy')->name('usun');
        Route::post('ustaw', 'IndexController@sort')->name('sort');
});

// Robimy boksy
Route::group(['namespace' => 'AdminBoksy', 'prefix'=>'/admin/boksy/', 'as' => 'admin.boksy.', 'middleware' => 'auth'], function() {
        Route::get('/', 'IndexController@index')->name('index');

        Route::get('dodaj', 'IndexController@create')->name('dodaj');
        Route::post('zapisz', 'IndexController@store')->name('zapisz');
        Route::get('edytuj/{id}', 'IndexController@edit')->name('edytuj');
        Route::put('update/{id}', 'IndexController@update')->name('update');
        Route::delete('usun/{id}', 'IndexController@destroy')->name('usun');
        Route::post('ustaw', 'IndexController@sort')->name('sort');
});

// Robimy aktualnosci
Route::group(['namespace' => 'AdminNews', 'prefix'=>'/admin/news/', 'as' => 'admin.news.', 'middleware' => 'auth'], function() {
        Route::get('/', 'IndexController@index')->name('index');

        Route::get('dodaj', 'IndexController@create')->name('dodaj');
        Route::post('zapisz', 'IndexController@store')->name('zapisz');
        Route::get('edytuj/{id}', 'IndexController@edit')->name('edytuj');
        Route::put('update/{id}', 'IndexController@update')->name('update');
        Route::delete('usun/{id}', 'IndexController@destroy')->name('usun');
});

// Robimy galerie
Route::group(['namespace' => 'AdminGaleria', 'prefix'=>'/admin/galeria/', 'as' => 'admin.galeria.', 'middleware' => 'auth'], function() {
        Route::get('/', 'IndexController@index')->name('index');

        Route::get('dodaj-katalog', 'IndexController@create')->name('dodaj');
        Route::post('zapisz-katalog', 'IndexController@store')->name('zapisz');
        Route::get('edytuj-katalog/{id}', 'IndexController@edit')->name('edytuj');
        Route::put('update/{id}', 'IndexController@update')->name('update');
        Route::delete('usun-katalog/{id}', 'IndexController@destroy')->name('usun');

    // Zdjecia galerii
        Route::get('pokaz-katalog/{id}', 'IndexController@show')->name('pokaz');
        Route::post('upload/{id}', 'IndexController@upload')->name('upload');
        Route::delete('usun-zdjecie/{id}/{gal}', 'IndexController@destroyphoto')->name('usunzdjecie');
        Route::post('ustaw', 'IndexController@sort')->name('sort');

});

// Robimy uzytkownikow
Route::group(['namespace' => 'AdminUzytkownicy', 'prefix'=>'/admin/users/', 'as' => 'admin.users.', 'middleware' => 'auth'], function() {
    Route::get('/', 'IndexController@index')->name('index');

    Route::get('dodaj', 'IndexController@create')->name('dodaj');
    Route::post('zapisz', 'IndexController@store')->name('zapisz');
    Route::get('edytuj/{id}', 'IndexController@edit')->name('edytuj');
    Route::get('haslo/{id}', 'IndexController@password')->name('haslo');
    Route::delete('usun/{id}', 'IndexController@destroy')->name('usun');
    Route::put('update/{id}', 'IndexController@update')->name('update');
    Route::put('zmienhaslo/{id}', 'IndexController@updatepassword')->name('updatepass');
});

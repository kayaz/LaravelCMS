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
        Route::get('/', 'SliderController@index')->name('index');

        Route::get('dodaj', 'SliderController@create')->name('dodaj');
        Route::post('zapisz', 'SliderController@store')->name('zapisz');
        Route::get('edytuj/{id}', 'SliderController@edit')->name('edytuj');
        Route::put('update/{id}', 'SliderController@update')->name('update');
        Route::delete('usun/{id}', 'SliderController@destroy')->name('usun');
        Route::post('ustaw', 'SliderController@sort')->name('sort');
});

// Robimy aktualnosci
Route::group(['namespace' => 'AdminNews', 'prefix'=>'/admin/news/', 'as' => 'admin.news.', 'middleware' => 'auth'], function() {
        Route::get('/', 'NewsController@index')->name('index');

        Route::get('dodaj', 'NewsController@create')->name('dodaj');
        Route::post('zapisz', 'NewsController@store')->name('zapisz');
        Route::get('edytuj/{id}', 'NewsController@edit')->name('edytuj');
        Route::put('update/{id}', 'NewsController@update')->name('update');
        Route::delete('usun/{id}', 'NewsController@destroy')->name('usun');
});

// Robimy galerie
Route::group(['namespace' => 'AdminGaleria', 'prefix'=>'/admin/galeria/', 'as' => 'admin.galeria.', 'middleware' => 'auth'], function() {
        Route::get('/', 'GaleriaController@index')->name('index');

        Route::get('dodaj-katalog', 'GaleriaController@create')->name('dodaj');
        Route::post('zapisz-katalog', 'GaleriaController@store')->name('zapisz');
        Route::get('edytuj-katalog/{id}', 'GaleriaController@edit')->name('edytuj');
        Route::put('update/{id}', 'GaleriaController@update')->name('update');
        Route::delete('usun-katalog/{id}', 'GaleriaController@destroy')->name('usun');

    // Zdjecia galerii
        Route::get('pokaz-katalog/{id}', 'GaleriaController@show')->name('pokaz');
        Route::post('upload/{id}', 'GaleriaController@upload')->name('upload');
        Route::delete('usun-zdjecie/{id}/{gal}', 'GaleriaController@destroyphoto')->name('usunzdjecie');
        Route::post('ustaw', 'GaleriaController@sort')->name('sort');

});

// Robimy uzytkownikow
Route::group(['namespace' => 'AdminUzytkownicy', 'prefix'=>'/admin/users/', 'as' => 'admin.users.', 'middleware' => 'auth'], function() {
    Route::get('/', 'UsersController@index')->name('index');

    Route::get('dodaj', 'UsersController@create')->name('dodaj');
    Route::post('zapisz', 'UsersController@store')->name('zapisz');
    Route::get('edytuj/{id}', 'UsersController@edit')->name('edytuj');
    Route::get('haslo/{id}', 'UsersController@password')->name('haslo');
    Route::delete('usun/{id}', 'UsersController@destroy')->name('usun');
    Route::put('update/{id}', 'UsersController@update')->name('update');
    Route::put('zmienhaslo/{id}', 'UsersController@updatepassword')->name('updatepass');
});

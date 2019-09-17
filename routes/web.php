<?php

// Front
Route::get('/',                                 'Front\IndexController@index')->name('front.index');
Route::get('/kontakt',                          'Front\KontaktController@index')->name('front.kontakt');
Route::post('/kontakt',                         'Front\KontaktController@send')->name('front.kontakt.send');

// Aktualne inwestycje
Route::get('/aktualne-inwestycje',              'Front\InvestmentsController@index')->name('front.inwestycje');
Route::get('/i/{slug}',                         'Front\InvestmentsController@show')->name('front.inwestycja');
Route::get('/i/{slug}/{floorslug}',             'Front\InvestmentsFloorController@index')->name('front.inwestycja.pietro');
Route::get('/i/{slug}/{floorslug}/{roomslug}',  'Front\InvestmentsRoomController@index')->name('front.inwestycja.mieszkanie');

// Aktualności
Route::group(['namespace' => 'Front', 'prefix'=>'/aktualnosci/', 'as' => 'front.news.'], function() {

    Route::get('/',                             'NewsController@index', function() {return View::make('content');})->name('index');
    Route::get('/{slug}',                       'NewsController@show')->name('wpis');

});

// Logowanie
Route::get('login',                             'Auth\LoginController@showLoginForm')->name('login');
Route::post('login',                            'Auth\LoginController@login');
Route::post('logout',                           'Auth\LoginController@logout')->name('logout');

// Robimy admina
Route::get('/admin',                            'Admin\SettingsController@index')->name('admin.ustawienia.dashboard')->middleware('auth');

Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/settings/', 'as' => 'admin.settings.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'SettingsController@index')->name('index');
    Route::put('update',                        'SettingsController@update')->name('update');
    Route::get('social',                        'SettingsController@social')->name('social');
    Route::put('social/update',                 'SettingsController@socialupdate')->name('social.update');

});

// Robimy menu
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/menu/', 'as' => 'admin.menu.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'MenuController@index')->name('index');
    Route::get('add',                           'MenuController@create')->name('dodaj');
    Route::post('save',                         'MenuController@store')->name('zapisz');
    Route::get('edit/{menu}',                   'MenuController@edit')->name('edytuj');
    Route::put('update/{menu}',                 'MenuController@update')->name('update');
    Route::delete('delete/{menu}',              'MenuController@destroy')->name('usun');

});

// Robimy inwestycje
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/investments/', 'as' => 'admin.investments.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'InvestmentsController@index')->name('index');
    Route::get('add',                           'InvestmentsController@create')->name('dodaj');
    Route::post('save',                         'InvestmentsController@store')->name('zapisz');
    Route::get('edit/{investment}',             'InvestmentsController@edit')->name('edytuj');
    Route::put('update/{investment}',           'InvestmentsController@update')->name('update');
    Route::delete('delete/{investment}',        'InvestmentsController@destroy')->name('usun');

    Route::get('plan/{investment}',             'InvestmentsPlanController@index')->name('planindex');
    Route::post('upload/{investment}',          'InvestmentsPlanController@update')->name('planupdate');

    Route::get('floors/{investment}',           'InvestmentsFloorController@index')->name('pietroindex');
    Route::get('add-floor/{investment}',        'InvestmentsFloorController@create')->name('pietrododaj');
    Route::post('save-floor/{investment}',      'InvestmentsFloorController@store')->name('pietrozapisz');
    Route::get('edit-floor/{floor}',            'InvestmentsFloorController@edit')->name('pietroedytuj');
    Route::put('update-floor/{floor}',          'InvestmentsFloorController@update')->name('pietroupdate');
    Route::delete('delete-floor/{floor}',       'InvestmentsFloorController@destroy')->name('pietrousun');
    Route::get('show/{floor}',                  'InvestmentsFloorController@show')->name('pietropokaz');


    Route::get('rooms/{floor}',                 'InvestmentsRoomController@index')->name('roomindex');
    Route::get('rooms/{floor}/create',          'InvestmentsRoomController@create')->name('roomdodaj');
    Route::get('rooms/{floor}/edit',            'InvestmentsRoomController@edit')->name('roomedytuj');
    Route::put('rooms/{room}',                  'InvestmentsRoomController@update')->name('roomupdate');
    Route::post('rooms/{floor}',                'InvestmentsRoomController@store')->name('roomzapisz');
});
//
// Robimy slider
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/slider/', 'as' => 'admin.slider.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'SliderController@index')->name('index');
    Route::get('add',                           'SliderController@create')->name('dodaj');
    Route::post('save',                         'SliderController@store')->name('zapisz');
    Route::get('edit/{slider}',                 'SliderController@edit')->name('edytuj');
    Route::put('update/{slider}',               'SliderController@update')->name('update');
    Route::delete('delete/{slider}',            'SliderController@destroy')->name('usun');
    Route::post('set',                          'SliderController@sort')->name('sort');

});

// Robimy boksy
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/boks/', 'as' => 'admin.boxes.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'BoxesController@index')->name('index');
    Route::get('add',                           'BoxesController@create')->name('dodaj');
    Route::post('save',                         'BoxesController@store')->name('zapisz');
    Route::get('edit/{box}',                    'BoxesController@edit')->name('edytuj');
    Route::put('update/{box}',                  'BoxesController@update')->name('update');
    Route::delete('delete/{box}',               'BoxesController@destroy')->name('usun');
    Route::post('set',                          'BoxesController@sort')->name('sort');

});

// Robimy aktualnosci
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/news/', 'as' => 'admin.news.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'NewsController@index')->name('index');
    Route::get('add',                           'NewsController@create')->name('dodaj');
    Route::post('save',                         'NewsController@store')->name('zapisz');
    Route::get('edit/{news}',                   'NewsController@edit')->name('edytuj');
    Route::put('update/{news}',                 'NewsController@update')->name('update');
    Route::delete('delete/{news}',              'NewsController@destroy')->name('usun');

});

// Robimy galerie
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/galeria/', 'as' => 'admin.gallery.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'GalleryController@index')->name('index');
    Route::get('add',                           'GalleryController@create')->name('dodaj');
    Route::post('save',                         'GalleryController@store')->name('zapisz');
    Route::get('edit/{gallery}',                'GalleryController@edit')->name('edytuj');
    Route::put('update/{gallery}',              'GalleryController@update')->name('update');
    Route::delete('delete/{gallery}',           'GalleryController@destroy')->name('usun');
    Route::get('show/{gallery}',                'GalleryController@show')->name('pokaz');

// Zdjecia galerii
    Route::post('upload/{gallery}',             'GalleryPhotosController@update')->name('upload');
    Route::delete('delete-photo/{photos}',      'GalleryPhotosController@destroy')->name('usunzdjecie');
    Route::post('ustaw',                        'GalleryPhotosController@sort')->name('sort');

});

// Robimy uzytkownikow
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/users/', 'as' => 'admin.users.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'UsersController@index')->name('index');
    Route::get('add',                           'UsersController@create')->name('dodaj');
    Route::post('save',                         'UsersController@store')->name('zapisz');
    Route::get('edit/{users}',                  'UsersController@edit')->name('edytuj');
    Route::put('update/{users}',                'UsersController@update')->name('update');
    Route::delete('delete/{users}',             'UsersController@destroy')->name('usun');

    Route::get('haslo/{users}',                 'UsersController@password')->name('haslo');
    Route::put('zmienhaslo/{users}',            'UsersController@updatepassword')->name('updatepass');

});

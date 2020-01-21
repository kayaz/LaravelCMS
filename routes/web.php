<?php

// Front
Route::get('/',                                 'Front\IndexController@index')->name('home');

Route::get('/kontakt',                          'Front\ContactController@index')->name('front.contact');
Route::post('/kontakt',                         'Front\ContactController@send')->name('front.contact.send');

Route::get('/mapa',                             'Front\MapController@index')->name('front.mapa');

// Aktualne inwestycje
Route::get('/aktualne-inwestycje',              'Front\InvestmentsController@index')->name('front.inwestycje');
Route::get('/i/{slug}',                         'Front\InvestmentsController@show')->name('front.inwestycja');
Route::get('/i/{slug}/{floorslug}',             'Front\InvestmentsFloorController@index')->name('front.inwestycja.pietro');
Route::get('/i/{slug}/{floorslug}/{roomslug}',  'Front\InvestmentsRoomController@index')->name('front.inwestycja.mieszkanie');

Route::post('/i/{slug}/{floorslug}/{roomslug}',  'Front\InvestmentsRoomController@send')->name('front.inwestycja.mieszkanie.send');

// Aktualności
Route::group(['namespace' => 'Front', 'prefix'=>'/aktualnosci/', 'as' => 'front.news.'], function() {
    Route::get('/',                             'NewsController@index', function() {return View::make('content');})->name('index');
    Route::get('/{slug}',                       'NewsController@show')->name('wpis');
});

// Galeria
Route::group(['namespace' => 'Front', 'prefix'=>'/galeria/', 'as' => 'front.galeria.'], function() {
    Route::get('/',                             'GalleryController@index')->name('index');
    Route::get('/{gallery}',                    'GalleryController@show')->name('katalog');
});

// Inline
Route::group(['namespace' => 'Front', 'prefix'=>'/inline/', 'as' => 'front.inline.'], function() {
    Route::get('/',                              'InlineController@index')->name('index');
    Route::get('/loadinline/{inline}',           'InlineController@show')->name('show');
    Route::post('/update/{inline}',              'InlineController@update')->name('update');
});

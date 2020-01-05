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
    Route::get('/',                             'InlineController@index')->name('index');
    Route::get('/loadinline/{inline}',           'InlineController@show')->name('show');
    Route::post('/update/{inline}',              'InlineController@update')->name('update');
});

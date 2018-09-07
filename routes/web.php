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

Auth::routes();

Route::get('/', 'DefaultsController@index')->name('defaults.index');

Route::get('combination', 'DefaultsController@goodsAttributeCombination')->name('defaults.combination');

# markdown composer 
Route::get('markdowns', 'MarkdownsController@index')->name('makerdowns.index');

# excel composer 
Route::get('excels', 'ExcelsController@index')->name('excels.index');
Route::post('excels/import', 'ExcelsController@import')->name('excels.import');
Route::post('excels/export', 'ExcelsController@export')->name('excels.export');

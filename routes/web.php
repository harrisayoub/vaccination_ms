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

//Routes for all pages
Route::get('/', 'PagesController@scheduler');

//Routes for Finances
Route::get('/finance/create', 'FinanceController@create');
Route::get('/finance/show', 'FinanceController@show');
Route::resource('/finance', 'FinanceController');

//Routes for Stocks
Route::get('/inventory', 'StockController@index');
Route::get('/inventory/{stock}/delete', 'StockController@destroy');
Route::patch('/inventory/{stock}/update', 'StockController@update');
Route::get('/inventory/{stock}/edit', 'StockController@edit');
Route::get('/inventory/create', [
  'uses' => 'StockController@create',
]);
Route::resource('/inventory', 'StockController');

//Routes for Mobs and Activities
Route::resource('/mobs', 'MobsController');
Route::get('mobs/{mob}/activities/create', 'MobsActivitiesController@create');
Route::get('mobs/{mob}/activities/schedule', 'MobsActivitiesController@scheduleDates');
Route::get('mobs/{mob}/activities/{activity}', 'MobsActivitiesController@show');

//Routes for Activities and Actions
Route::get('mobs/{mob}/activities/{activity}/actions/create', 'ActivityActionsController@create');
Route::get('mobs/{mob}/activities/{activity}/actions/{action}', 'ActivityActionsController@show');
Route::patch('mobs/{mob}/activities/{activity}/actions/{action}/updateAnimals', 'ActivityActionsController@updateAnimals');
Route::patch('mobs/{mob}/activities/{activity}/actions/{action}/updateTreatments', 'ActivityActionsController@updateTreatments');
Route::get('mobs/{mob}/activities/{activity}/actions/{action}/{stock}/delete', 'ActivityActionsController@destroy');

//Routes for user authentication
Auth::routes();

//Routes for exporting CSV for finances
Route::get('/export', 'FinanceController@export')->name('export');
Route::get('/exportcsv', 'FinanceController@exportcsv')->name('exportcsv');

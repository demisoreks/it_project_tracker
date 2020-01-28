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

$link_id = 5;

Route::get('/', [
    'as' => 'welcome', 'uses' => 'WelcomeController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager,Report']);

Route::get('vendors/{vendor}/disable', [
    'as' => 'vendors.disable', 'uses' => 'VendorsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('vendors/{vendor}/enable', [
    'as' => 'vendors.enable', 'uses' => 'VendorsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::resource('vendors', 'VendorsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('vendors', function($value, $route) {
    return App\IptVendor::findBySlug($value)->first();
});

Route::get('projects/{project}/breakdown', [
    'as' => 'projects.breakdown', 'uses' => 'ProjectsController@breakdown'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager,Report']);
Route::resource('projects', 'ProjectsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('projects', function($value, $route) {
    return App\IptProject::findBySlug($value)->first();
});

Route::resource('projects.components', 'ComponentsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('projects.components', function($value, $route) {
    return App\IptComponent::findBySlug($value)->first();
});

Route::resource('projects.expenses', 'ExpensesController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('projects.expenses', function($value, $route) {
    return App\IptComponent::findBySlug($value)->first();
});

Route::resource('projects.updates', 'UpdatesController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('projects.updates', function($value, $route) {
    return App\IptUpdate::findBySlug($value)->first();
});

Route::get('summary', [
    'as' => 'summary', 'uses' => 'ProjectsController@summary'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Report']);
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', 'ManufacturerController', [
    'names' => [
        'index' => 'man.index',
        'store' => 'man.store',
    ]
]);


Route::resource('/car', 'CarController', [
    'names' => [
        'index' => 'car.index',
        'store' => 'car.store',
    ]
]);

Route::get('/inventory', 'InventoryController@index')->name('inventory_index');
Route::post('/sold', 'InventoryController@sold')->name('inventory_sold');
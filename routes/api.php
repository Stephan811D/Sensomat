<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'App\Http\Controllers\LoginController@login');
Route::post('logout', 'App\Http\Controllers\LoginController@logout');

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    //Dashboard
    Route::get('automats/status', 'App\Http\Controllers\Api\AutomatController@indexStatus');
    
    //Detailansicht
    Route::get('automat/{id}', 'App\Http\Controllers\Api\AutomatController@show');
    
    //Automaten-Ansicht: Übersicht
    Route::get('automats/basic', 'App\Http\Controllers\Api\AutomatController@indexBasic');
    
    //Automaten-Ansicht: Automat bearbeiten
    Route::get('automat/basic/{id}', 'App\Http\Controllers\Api\AutomatController@index');
    
    //Automaten-Ansicht: Schächte konfigurieren + Zuweisen
    Route::get('automat/shafts/{id}', 'App\Http\Controllers\Api\AutomatController@indexDetailed');
    Route::post('automat/shafts', 'App\Http\Controllers\Api\AutomatController@storeShaftProducts');
    Route::post('automat/shafts/config', 'App\Http\Controllers\Api\AutomatController@storeShaftConfigs');
    
    //Produkte-Ansicht: 
    Route::get('productTypes/basic', 'App\Http\Controllers\Api\ProductTypeController@indexBasic');

    //Sidebar: Auflistung
    Route::get('automats/names', 'App\Http\Controllers\Api\AutomatController@getAutomatNames');

    //Product, ProduktType, Automat
    Route::apiResources([
        'product' => 'App\Http\Controllers\Api\ProductController',
        'productType' => 'App\Http\Controllers\Api\ProductTypeController',
        'automat' => 'App\Http\Controllers\Api\AutomatController'
    ]);
});

Route::get('products', 'App\Http\Controllers\Api\ProductController@index');


/*
Route::get('productTypes', 'App\Http\Controllers\Api\ProductTypeController@index');

//Products
Route::get('products', 'App\Http\Controllers\Api\ProductController@index');

Route::apiResources(
    [
        'product' => 'App\Http\Controllers\Api\ProductController',
        'productType' => 'App\Http\Controllers\Api\ProductTypeController',
        'automat' => 'App\Http\Controllers\Api\AutomatController'
    ]
);

Route::get('automat/fillingLevel/{id}', 'App\Http\Controllers\Api\AutomatController@getFillingLevel');
Route::get('automat/shaftStates/{id}', 'App\Http\Controllers\Api\AutomatController@getShaftStates');
Route::get('automat/networkState/{id}', 'App\Http\Controllers\Api\AutomatController@getNetworkState');
Route::get('automat/doorState/{id}', 'App\Http\Controllers\Api\AutomatController@getDoorState');
*/

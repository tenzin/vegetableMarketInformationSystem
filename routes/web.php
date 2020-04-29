<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',['as'=>'login','uses'=>'LoginController@login']);
Route::post('extensiondashboard',['as'=>'extensiondashboard','uses'=>'PrototypeController@extensiondashboard']);

//Extension Supply Information Route

Route::get('extension_supply',['as'=>'extension_supply','uses'=>'ExtensionSupplyController@extension_supply']);
Route::post('submit_supply_form',['as'=>'submit_supply_form','uses'=>'ExtensionSupplyController@submit_supply_form']);
Route::post('submit_supply_details',['as'=>'submit_supply_details','uses'=>'ExtensionSupplyController@submit_supply_details']);
Route::get('view_supply_details',['as'=>'view_supply_details','uses'=>'ExtensionSupplyController@view_supply_details']);
Route::get('viewall_supply_details',['as'=>'viewall_supply_details','uses'=>'ExtensionSupplyController@viewall_supply_details']);
Route::get('addmore_supply_details',['as'=>'addmore_supply_details','uses'=>'ExtensionSupplyController@addmore_supply_details']);

//Extension Demand Information Route
Route::get('extension_demand',['as'=>'extension_demand','uses'=>'ExtensionDemandController@extension_demand']);
Route::post('submit_demand_form',['as'=>'submit_demand_form','uses'=>'ExtensionDemandController@submit_demand_form']);
Route::post('submit_demand_details',['as'=>'submit_demand_details','uses'=>'ExtensionDemandController@submit_demand_details']);
Route::get('view_demand_details',['as'=>'view_demand_details','uses'=>'ExtensionDemandController@view_demand_details']);
Route::get('viewall_demand_details',['as'=>'viewall_demand_details','uses'=>'ExtensionDemandController@viewall_demand_details']);
Route::get('addmore_demand_details',['as'=>'addmore_demand_details','uses'=>'ExtensionDemandController@addmore_demand_details']);

//Extension Under Cultivation
Route::get('extension_cultivation',['as'=>'extension_cultivation','uses'=>'ExtensionUnderCultiavtionController@extension_cultivation']);
Route::post('submit_cultivation_form',['as'=>'submit_cultivation_form','uses'=>'ExtensionUnderCultiavtionController@submit_cultivation_form']);
Route::post('submit_cultivation_details',['as'=>'submit_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@submit_cultivation_details']);
Route::get('view_cultivation_details',['as'=>'view_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@view_cultivation_details']);
Route::get('viewall_cultivation_details',['as'=>'viewall_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@viewall_cultivation_details']);
Route::get('addmore_cultivation_details',['as'=>'addmore_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@addmore_cultivation_details']);



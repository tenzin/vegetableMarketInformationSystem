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
Route::get('login', 'AuthController@loginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::get('logout', 'AuthController@logout');

Route::get('/', function () {
    return view('index');
});

// Dashboard
Route::group(['middleware' => 'auth'], function () {

Route::get('/national',['as'=>'national','uses'=>'DashboardController@national']);
Route::get('/extension',['as'=>'extension','uses'=>'DashboardController@extension']);
Route::get('/aggregator',['as'=>'aggregator','uses'=>'DashboardController@aggregator']);

//Extension Supply Information Route
Route::get('extension_supply',['as'=>'extension_supply','uses'=>'ExtensionSupplyController@extension_supply']);
Route::post('submit_supply_details',['as'=>'submit_supply_details','uses'=>'ExtensionSupplyController@submit_supply_details']);
Route::get('view_supply_details',['as'=>'view_supply_details','uses'=>'ExtensionSupplyController@view_supply_details']);

//Extension Under Cultivation
Route::get('extension_cultivation',['as'=>'extension_cultivation','uses'=>'ExtensionUnderCultiavtionController@extension_cultivation']);
Route::post('submit_cultivation_details',['as'=>'submit_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@submit_cultivation_details']);
Route::get('view_cultivation_details',['as'=>'view_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@view_cultivation_details']);

//Commercial Aggregator Supply Surplus Information Route
Route::get('ca_surplus',['as'=>'ca_surplus','uses'=>'CASurplusController@ca_surplus']);
Route::post('submit_surplus_detail',['as'=>'submit_surplus_detail','uses'=>'CASurplusController@submit_surplus_detail']);
Route::get('view_surplus_details',['as'=>'view_surplus_details','uses'=>'CASurplusController@view_surplus_details']);

//Commercial Aggregator Demand Surplus Information Route
Route::get('ca_surplus_demand',['as'=>'ca_surplus_demand','uses'=>'CADemandController@ca_surplus_demand']);
Route::post('submit_surplus_demand_detail',['as'=>'submit_surplus_demand_detail','uses'=>'CADemandController@submit_surplus_demand_detail']);
Route::get('view_surplus_demand_details',['as'=>'view_surplus_demand_details','uses'=>'CADemandController@view_surplus_demand_details']);


//scope filter for Commercial Aggregator Route
Route::get('scopefilter',['as'=>'scopefilter','uses'=>'CAFilterController@scopefilter']);
Route::get('view_claim',['as'=>'view_claim','uses'=>'CAFilterController@view_claim']);


//User profile Route
Route::get('profile',['as'=>'profile','uses'=>'AccessControlListController@userprofile']);

//user role and permission
Route::get('role',['as'=>'role','uses'=>'AccessControlListController@role']);
Route::get('permission',['as'=>'permission','uses'=>'AccessControlListController@permission']);


//user management
Route::get('system-user',['as'=>'system-user','uses'=>'AccessControlListController@user']);
Route::get('userview',['as'=>'userview','uses'=>'AccessControlListController@userview']);
Route::get('adduser',['as'=>'adduser','uses'=>'AccessControlListController@add']);
Route::post('new-user',['as'=>'new-user','uses'=>'AccessControlListController@insert']);



//Contact US
Route::get('contact-us',['as'=>'contact-us','uses'=>'ContactUsController@contact']);
});

Route::get('/home', 'HomeController@index')->name('home');

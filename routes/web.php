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

/* Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
//Sonamg010------------
Route::resource('/demand','DemandController');
Route::get('demand-delete/{id}','DemandController@destroy');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/demand_temp', 'DemandController@demand_temp')->name('demand_temp');
Route::get('/demand_view', 'DemandController@demand_view')->name('demand_view');
Route::get('/data_show', 'DemandController@data_show')->name('data_show');
Route::get('/submitted_show', 'DemandController@show_submit')->name('submitted_show');
Route::get('/json-product_type','DemandController@product_type');
Route::get('/json-submit-demand','DemandController@submit_demand');
Route::get('/json-product-exist','DemandController@product_exists');
Route::get('/edit_submitted/{id}','DemandController@edit_submitted')->name('edit-submitted');
Route::get('/update_submitted/{id}','DemandController@update_submitted')->name('update_submitted');

//--------------------------------------------------------------

// Dashboard
Route::group(['middleware' => 'auth'], function () {

Route::get('/national',['as'=>'national','uses'=>'DashboardController@national'])->middleware('can:view_national_dashboard,Auth::user()');
Route::get('/extension',['as'=>'extension','uses'=>'DashboardController@extension'])->middleware('can:view_extension_dashboard,Auth::user()');
Route::get('/aggregator',['as'=>'aggregator','uses'=>'DashboardController@aggregator'])->middleware('can:view_aggregator_dashboard,Auth::user()');

Route::group(['middleware' => 'can:extension_level, Auth::user()'], function() {

//Extension Supply Information Route
Route::get('extension_supply',['as'=>'extension_supply','uses'=>'ExtensionSupplyController@extension_supply'])->middleware('can:extension_add_surplus,Auth::user()');
Route::post('submit_supply_details',['as'=>'submit_supply_details','uses'=>'ExtensionSupplyController@submit_supply_details']);
Route::get('view_supply_details',['as'=>'view_supply_details','uses'=>'ExtensionSupplyController@view_supply_details'])->middleware('can:view_extension_surplus,Auth::user()');

//Extension Under Cultivation
Route::get('extension_cultivation',['as'=>'extension_cultivation','uses'=>'ExtensionUnderCultiavtionController@extension_cultivation'])->middleware('can:extension_add_under_cultivation,Auth::user()');
Route::post('submit_cultivation_details',['as'=>'submit_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@submit_cultivation_details']);
Route::get('view_cultivation_details',['as'=>'view_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@view_cultivation_details'])->middleware('can:extension_view_under_cultivation,Auth::user()');

});

Route::group(['middleware' => 'can:aggregator_level, Auth::user()'], function() {

//Commercial Aggregator Supply Surplus Information Route
Route::get('ca_surplus',['as'=>'ca_surplus','uses'=>'CASurplusController@ca_surplus'])->middleware('can:aggregator_add_surplus,Auth::user()');
Route::post('submit_surplus_detail',['as'=>'submit_surplus_detail','uses'=>'CASurplusController@submit_surplus_detail']);
Route::get('view_surplus_details',['as'=>'view_surplus_details','uses'=>'CASurplusController@view_surplus_details'])->middleware('can:aggregator_view_surplus,Auth::user()');

//Commercial Aggregator Demand Surplus Information Route
Route::get('ca_surplus_demand',['as'=>'ca_surplus_demand','uses'=>'CADemandController@ca_surplus_demand'])->middleware('can:aggregator_demand_surplus,Auth::user()');
Route::post('submit_surplus_demand_detail',['as'=>'submit_surplus_demand_detail','uses'=>'CADemandController@submit_surplus_demand_detail']);
Route::get('view_surplus_demand_details',['as'=>'view_surplus_demand_details','uses'=>'CADemandController@view_surplus_demand_details'])->middleware('can:aggregator_view_demand_surplus,Auth::user()');

//scope filter for Commercial Aggregator Route
Route::get('scopefilter',['as'=>'scopefilter','uses'=>'CAFilterController@scopefilter'])->middleware('can:aggregator_search_surplus,Auth::user()');
Route::get('view_claim',['as'=>'view_claim','uses'=>'CAFilterController@view_claim'])->middleware('can:aggregator_view_search_surplus,Auth::user()');

});

Route::group(['middleware' => 'can:access_control_list, Auth::user()'], function() {

    //Role Route
    Route::get('view-role',['as'=>'view-role','uses'=>'AccessControlListController@indexRole']);
    Route::get('add-role',['as'=>'add-role','uses'=>'AccessControlListController@addRole']);
    Route::post('store-role',['as'=>'store-role','uses'=>'AccessControlListController@storeRole']);
    Route::get('edit-role/{id}',['as'=>'edit-role','uses'=>'AccessControlListController@editRole']);
    Route::post('update-role',['as'=>'update-role','uses'=>'AccessControlListController@updateRole']);
    Route::get('destroy-role/{id}',['as'=>'destroy-role','uses'=>'AccessControlListController@destroyRole']);
    
    //Permission Route
    Route::get('view-permission',['as'=>'view-permission','uses'=>'AccessControlListController@indexPermission']);
    Route::get('add-permission',['as'=>'add-permission','uses'=>'AccessControlListController@addPermission']);
    Route::post('store-permission',['as'=>'store-permission','uses'=>'AccessControlListController@storePermission']);
    Route::post('update-permission',['as'=>'update-permission','uses'=>'AccessControlListController@updatePermission']);
    Route::get('edit-permission/{id}',['as'=>'edit-permission','uses'=>'AccessControlListController@editPermission']);
    Route::get('destroy-permission/{id}',['as'=>'destroy-permission','uses'=>'AccessControlListController@destroyPermission']);
   
    //User Route
    Route::get('system-user',['as'=>'system-user','uses'=>'AccessControlListController@user']);
    Route::get('userview',['as'=>'userview','uses'=>'AccessControlListController@userview']);
    Route::get('adduser',['as'=>'adduser','uses'=>'AccessControlListController@add']);
    Route::post('new-user',['as'=>'new-user','uses'=>'AccessControlListController@insert']);

    

  }); // end of acl group list


//User profile Route
Route::get('profile',['as'=>'profile','uses'=>'ProfileController@userprofile']);

//change Password & Email & Contact Route
  Route::post('/changePassword','UpdateDetailsController@changePassword');
  Route::post('/changeEmail','UpdateDetailsController@changeEmail');
  Route::post('/changeContact','UpdateDetailsController@changeContact');


  Route::post('/changePassword','UpdateDetailsController@changePassword')->name('changePassword');
  Route::post('/changeEmail','UpdateDetailsController@changeEmail')->name('changeEmail');
  Route::post('/changeContact','UpdateDetailsController@changeContact')->name('changeContact');

  //Image Route
  Route::post('/avatar', 'UserController@update_avatar');

  //Contact US
  Route::get('contact-us',['as'=>'contact-us','uses'=>'ContactUsController@contact']);
});

//Master product type.
Route::get('product-type',['as' => 'product-type','uses'=>'ProductTypeController@producttype']);
Route::post('product-type-store',['as'=>'product-type-store','uses'=>'ProductTypeController@producttypestore']);
Route::get('product-type-edit/{id}',['as'=>'product-type-edit','uses'=>'ProductTypeController@producttypeedit']);
Route::post('product-type-update/{id}',['as'=>'product-type-update','uses'=>'ProductTypeController@producttypeupdate']);
Route::get('product-type-delete/{id}',['as'=>'product-type-delete','uses'=>'ProductTypeController@producttypedelete']);

//master product.
Route::get('product-create',['as'=>'product-create','uses'=>'ProductController@productcreate']);
Route::post('product-store',['as'=>'product-store','uses'=>'ProductController@productstore']);
Route::get('product-edit/{id}',['as'=>'product-edit','uses'=>'ProductController@productedit']);
Route::post('product-update/{id}',['as'=>'product-update','uses'=>'ProductController@productupdate']);
Route::get('product-delete/{id}',['as'=>'product-delete','uses'=>'ProductController@Productdestroy']);

//master units.
Route::get('unit-create',['as'=>'unit-create','uses'=>'UnitController@unitcreate']);
Route::post('unit-store',['as'=>'unit-store','uses'=>'UnitController@unitstore']);
Route::get('unit-edit/{id}',['as'=>'unit-edit','uses'=>'UnitController@unitedit']);
Route::post('unit-update/{id}',['as'=>'unit-update','uses'=>'UnitController@unitupdate']);
Route::get('unit-delete/{id}',['as'=>'unit-delete','uses'=>'UnitController@unitdelete']);

//master cultivation units.
Route::get('cunit-create',['as'=>'cunit-create','uses'=>'CUnitController@cunitcreate']);
Route::post('cunit-store',['as'=>'cunit-store','uses'=>'CUnitController@cunitstore']);
Route::get('cunit-edit/{id}',['as'=>'cunit-edit','uses'=>'CUnitController@cunitedit']);
Route::post('cunit-update/{id}',['as'=>'cunit-update','uses'=>'CUnitController@cunitupdate']);
Route::get('cunit-delete/{id}',['as'=>'cunit-delete','uses'=>'CUnitController@cunitdelete']);

//master dzongkhag
Route::get('dzongkhag-list',['as'=>'dzongkhag-list','uses'=>'DzongkhagThromdeController@index']);


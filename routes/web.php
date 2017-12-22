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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('branch')->group(function () {
    Route::get('/','BranchController@index')->name('branches');
    Route::post('save','BranchController@saveBranch')->name('saveBranch');
    Route::post('add','BranchController@addBranch')->name('addBranch');
    Route::post('edit','BranchController@editBranch')->name('editBranch');
    Route::post('delete','BranchController@deleteBranch')->name('deleteBranch');
    Route::get('getPostOffice','BranchController@getBranches')->name('getPostOffice');


});
Route::prefix('parcel')->group(function () {
    Route::get('/','ParcelController@index')->name('parcels');
    Route::get('/{id?}','ParcelController@details')->name('parcelDetails');
    Route::post('save','ParcelController@saveParcel')->name('saveParcel');

    Route::post('add','ParcelController@addParcel')->name('addParcel');
    Route::post('edit','ParcelController@editParcel')->name('editParcel');
    Route::post('delete','ParcelController@deleteParcel')->name('deleteParcel');


});
Route::prefix('moneyorder')->group(function () {
    Route::get('/','ParcelController@moneyOrders')->name('moneyOrders');

    Route::post('save','ParcelController@saveMoneyOrder')->name('saveMoneyOrder');

    Route::post('add','ParcelController@addMoneyOrder')->name('addMoneyOrder');
    Route::post('edit','ParcelController@editMoneyOrder')->name('editMoneyOrder');



});
Route::prefix('user')->group(function () {
    Route::post('/changePassword', 'UserController@changePassword')->name('changePassowrd');
    Route::post('/changeProfile', 'UserController@changeProfile')->name('changeProfile');
    Route::get('/settings', 'UserController@settings')->name('settings');
    //Route::post('add', 'UserController@addSurcharge')->name('addSurcharge');


});
Route::prefix('track')->group(function () {
    Route::post('add','ParcelController@addTrack')->name('addTrack');
    Route::post('delete','ParcelController@deleteTrack')->name('deleteTrack');
    Route::post('showinmap','ParcelController@showInMap')->name('showInMap');
    Route::get('parceltrack','ParcelTrackController@index')->name('trackForUser');
    Route::post('track','ParcelTrackController@track')->name('trackParcel');

});


Route::prefix('manager')->group(function () {
    Route::get('/','ManagerController@index')->name('managers');
    Route::post('save','ManagerController@saveManager')->name('saveManager');
    Route::post('add','ManagerController@addManager')->name('addManager');
    Route::post('edit','ManagerController@editManager')->name('editManager');
    Route::post('delete','ManagerController@deleteManager')->name('deleteManager');
    Route::post('getavailablebranches','ManagerController@getAvailableBranches')->name('branchForManager');

});

Route::get('/home', 'HomeController@index')->name('home');

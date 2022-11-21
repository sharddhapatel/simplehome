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

Route::get('/adminlogin','AdminLoginController@index');
Route::post('admin_login','AdminLoginController@adminlogin');
Route::get('adminforgotpass','AdminLoginController@forgotpass');

Route::post('adminresendmail','AdminLoginController@adminresendmail');
Route::get('/adminresetpass/{token}','AdminLoginController@adminresetpass');
Route::post('/adminreset','AdminLoginController@adminresetpass1');

// Route::get('admindemo','AdminLoginController@demo');



	Route::group(['middleware' => 'admin'], function () 
	{
	Route::get('admindashboard','AdminLoginController@admindash');
	Route::get('adminprofile','AdminLoginController@profileindex');
	Route::post('profileupdate','AdminLoginController@profileupdate');
	Route::get('adminlogout','AdminLoginController@adminlogout');
	Route::get('showuser','AdminLoginController@showuser');
	Route::get('changeStatus','AdminLoginController@userchangestatus');
	Route::get('showads','AdminLoginController@showads');
	
	Route::get('changestatusads/{id}','AdminLoginController@changestatusads');
	Route::get('changestatusadsdec/{id}','AdminLoginController@changestatusadsdec');

	Route::get('categoryindex','AdminCategoryController@categoryindex');
	Route::get('showcategory','AdminCategoryController@showcategory');
	Route::post('insertcategory','AdminCategoryController@insertcategory');
	Route::get('update/{id}','AdminCategoryController@update');
	Route::post('adminedit','AdminCategoryController@adminedit');
	Route::get('admindelete/{id}','AdminCategoryController@admindelete');
	Route::get('changestatuscategory/{id}','AdminCategoryController@changestatus');
	
	Route::get('adminitemdetail/{id}','AdminCategoryController@adminitemdetail');

	Route::get('ordertrack','AdminOrderTrack@index');
	Route::get('showorder/{id}','AdminOrderTrack@showorder');
	Route::get('changestatus/{id}','AdminOrderTrack@changestatus');
	
	// Route::post('updateorder/{id}','AdminOrderTrack@updateorder');
});


 Route::get('/','SimpleHomeController@index');
Route::post('getData','SimpleHomeController@getData');
Route::get('demo','SimpleHomeController@demo');
// Route::get('/product/{productname}','SimpleHomeController@pizza');
 // Route::get('salad','SimpleHomeController@salad');
// Route::get('noodle','SimpleHomeController@noodle');

Route::get('userlogin','SignupController@userloginindex');
Route::get('loginuser','SignupController@loginuser');
Route::get('logoutuser','SignupController@logoutuser');
Route::get('signup','SignupController@index');
Route::post('signup','SignupController@insertuser');
Route::get('forgotpassword','ForgotPasswordController@index');
Route::post('resendmail','ForgotPasswordController@resendmail');
Route::get('/resetpass/{token}','ForgotPasswordController@resetpass');
Route::post('/reset','ForgotPasswordController@resetpass1');

Route::get('itemdetail/{id}','SimpleHomeController@itemdetail');

Route::get('about','SimpleHomeController@about');
Route::get('contact','ContactUs@contact');
Route::post('insertcontact','ContactUs@insertcontact');
// Route::get('stripe','StripePaymentController@stripe');


Route::group(['middleware' => 'user'], function () 
{
	Route::get('additem','SimpleHomeController@additemindex');
	Route::post('additem','SimpleHomeController@additem');
	Route::get('myitem','SimpleHomeController@myitem');
	Route::get('deleteitem/{id}','SimpleHomeController@deleteitem');
	Route::get('updatemyitem/{id}','SimpleHomeController@updatemyitem');
	Route::post('editmyitem','SimpleHomeController@editmyitem');


	Route::get('declineitem','ItemController@declineitem');
	Route::get('deletedeclineitem/{id}','ItemController@deletedeclineitem');
	Route::get('updatedeclineitem/{id}','ItemController@updatedeclineitem');
	Route::post('editdeclineitem','ItemController@editdeclineitem');
	
Route::get('addtocart/{id}','SimpleHomeController@addToCart');
Route::get('cart','SimpleHomeController@cart');
Route::get('update-cart','SimpleHomeController@updateCart');
Route::get('remove-from-cart','SimpleHomeController@deleteCart');
Route::get('removeitem','SimpleHomeController@removeitem');

Route::get('checkout','SimpleHomeController@checkout');
Route::post('addorder','SimpleHomeController@addorder');

Route::get('myorder','SimpleHomeController@myorder');
Route::get('ordercancel/{id}','SimpleHomeController@ordercancel');
Route::get('notification','ItemController@notification');

});
// use App\Http\Controllers\QrCodeGeneratorController;

// Route::get('/qr-code', [QrCodeGeneratorController::class, 'index'])->name('qr.code.index');
Route::get('qr-code','QrCodeGeneratorController@index');


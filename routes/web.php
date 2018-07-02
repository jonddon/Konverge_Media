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

Route::get('/home', 'HomeController@index');

Route::get('/dashboard','CompanyController@index');
Route::get('/newsletter','CompanyController@newsletter');
Route::get('/profile', 'ProfileController@index');
Route::post('/saveuserprofile', 'ProfileController@store');
Route::post('/AddTeamMember', 'CompanyController@store');
Route::get('/table', 'CompanyController@table');

//upload pages
Route::get('/upload', function(){
    return view('upload');
});
Route::get('/uploadmany', function(){
    return view('uploadmany');
});
Route::get('/uploadsms', function(){
    return view('uploadsms');
});


//Upload route
Route::post('import-file', 'ExcelController@importFile');
Route::post('import-file-many', 'ExcelController@importFileMany');
Route::post('newsletter', 'NewsletterController@newsletter');
Route::post('importsms', 'ExcelController@importsms');

//Uploaded batch
Route::get('/inserted/{batch_id}', 'ExcelController@index');
Route::get('/insertedmany/{batch_id}/{email}', 'ExcelController@many');
Route::get('/inserted/sms/{batch_id}', 'ExcelController@sms');

//Send Email
Route::get('/sendemails/{batch_id}', 'ExcelController@sendEmail');
Route::get('/sendmanyemails/{batch_id}/{email}', 'ExcelController@sendmanyemails');
Route::get('/sendsms/{batch_id}', 'ExcelController@sendsms');

Route::get('/sendnewsletter', 'NewsletterController@send');
//Resend Email
Route::get('/resendemail/{id}', 'ExcelController@resendEmail');
Route::get('/resendemail/{id}', 'ExcelController@resendEmail');

//Tracking Email
Route::post('getfailedemails', 'CompanyController@bounces');

Route::get('showbounces', 'CompanyController@showbounces');
Route::get('downloadtext', 'CompanyController@downloadTxt');



/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminAuth\LoginController@showLoginForm');

});



Route::get('sendemail', 'CompanyController@sendmail');
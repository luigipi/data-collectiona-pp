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

Auth::routes();
Route::get('/', function() {
	return view('index');
	//return 'Welcome Techinnover';
}); 
Route::get('/home', 'HomeController@index')->name('home');
// Route::post('seminarReg', 'SeminarController@store');
// Route::get('/support', 'SeminarController@seminarDonation');
// Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
// Route::get('paynow', 'SeminarController@payNow');
// Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
// Route::get('/payment-confirmation/{msg}', 'SeminarController@paymentConfirmation');
// Route::post('/send-email/{user_id}', 'SeminarController@sendMail')->name('send-mail');
// Route::post('/feedback-form', 'SeminarController@feedback');
// Route::get('/export', 'SeminarController@export');


// Route::post('/registration', 'RegistrationController@store');
// Route::get('/show/{id}', 'RegistrationController@show');
// Route::put('/update/{id}', 'RegistrationController@edit')->name('user.update');
// Route::delete('/delete/{id}', 'RegistrationController@delete');
// Route::get('/edit/{id}', 'RegistrationController@create');

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
    return view('auth.login');
});
Route::get('instructions', function () {
    return view('instruction');
});
Route::get('customers/login' , '\App\Http\Controllers\CustomersController@customerLoginForm');

Route::group(['middleware' => ['auth']], function () { 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    
    Route::resource('customers' , '\App\Http\Controllers\CustomersController');
    Route::resource('statistics' , '\App\Http\Controllers\StatisticsController');
    Route::get('aus-statistics' , '\App\Http\Controllers\StatisticsController@ausStats');

    
    Route::get('edit-finance/{id}/edit' , '\App\Http\Controllers\FinanceController@EditFinance');
    Route::post('update-finance/{id}' , '\App\Http\Controllers\FinanceController@UpdateFinance');
    Route::get('client-details/{id}' , '\App\Http\Controllers\FinanceController@viewClientsHistory');
    Route::get('finance/{id}' , '\App\Http\Controllers\FinanceController@GetFinance');
    Route::post('finance/{id}' , '\App\Http\Controllers\FinanceController@PostFinanceMK');
    Route::get('deleteFentry/{f_id}/{c_id}' , '\App\Http\Controllers\FinanceController@DeleteFinance');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('customers/logeddIn' , '\App\Http\Controllers\CustomersController@customerLoginPost');
Route::get('customers/dashboard/{id}' , '\App\Http\Controllers\CustomersController@customerDashboard');
Route::get('customers/profile/{id}' , '\App\Http\Controllers\CustomersController@customerProfile');
Route::get('client/profile/{id}' , '\App\Http\Controllers\CustomersController@editClientProfile');
Route::post('client/profile/update/{id}' , '\App\Http\Controllers\CustomersController@updateClientProfile');

Route::get('currency/{currency}/{id}','\App\Http\Controllers\CurrencyController@exchangeCurrency');


Route::get('stats' , function (){
    return view('statistics');
});



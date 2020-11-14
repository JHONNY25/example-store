<?php

use App\User;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-products', 'ProductController@getProducts')->name('getProducts');
Route::get('/setup-card', function(){
    $user = User::find(auth()->user()->id);

    return view('update-payment-method', [
        'intent' => $user->createSetupIntent()
    ]);
})->name('setup-card');


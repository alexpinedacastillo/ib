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

Auth::routes();

Route::get(
    '/inventory',
    'HomeController@index'
)->name('home');

Route::post(
    '/inventory/product_create_post',
    'HomeController@createPost'
)->name('product_create_post');

Route::get(
    '/inventory/product_delete/{productId}',
    'HomeController@destroy'
)->name('product_delete');

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/quiz', function () {
//     // return view('Quiz/quiz');
// })->name('quiz');
Route::get('/quiz','QuizController@getQuiz')->name('quiz');
Route::post('/quizsubmit','QuizController@store')->name('quizsubmit');
Route::get('/user', 'UserDetailsController@index')->name('user');
Route::get('/search', 'UserDetailsController@search')->name('search');
Route::get('sort/{type}', 'UserDetailsController@sort')->name('sort');
Route::resource('categories', CategoryController::class);
Route::post('delete-category', 'CategoryController@destroy');
Route::resource('products', ProductController::class);
Route::post('delete-product', 'ProductController@destroy');
Route::get('showproduct', 'ProductsController@index')->name('showproduct');
Route::get('cart', 'ProductsController@cart');
Route::get('add-to-cart/{id}', 'ProductsController@addToCart');
Route::patch('update-cart', 'ProductsController@update');
Route::delete('remove-from-cart', 'ProductsController@remove');
Route::get('order', 'ProductsController@order');
Route::get('orderlist', 'ProductsController@orderlist')->name('orderlist');
Route::get('myorders', 'ProductsController@myorders')->name('myorders');

<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\HomeController;
// use app\Http\Controllers\IndexController;

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

Route::get('/', [App\Http\Controllers\IndexController::class,'home'])->name('homepage');
Route::get('/lien-he', [App\Http\Controllers\IndexController::class,'lien_he'])->name('lien_he');
Route::get('/gioi-thieu', [App\Http\Controllers\IndexController::class,'introduce'])->name('introduce');
Route::get('/khieu-nai-ban-quyen', [App\Http\Controllers\IndexController::class,'khieu_nai'])->name('khieu_nai');

Route::get('/danh-muc/{slug}', [App\Http\Controllers\IndexController::class,'category'])->name('category');
Route::get('/the-loai/{slug}', [App\Http\Controllers\IndexController::class,'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [App\Http\Controllers\IndexController::class,'country'])->name('country');
Route::get('/phim/{slug}', [App\Http\Controllers\IndexController::class,'movie'])->name('movie');
Route::get('/all_reviewphim', [App\Http\Controllers\IndexController::class,'reviewphim'])->name('reviewphim');
Route::get('/xem-reviewphim/{slug}', [App\Http\Controllers\IndexController::class,'watch_reviewphim'])->name('watch_reviewphim');
Route::get('/xem-phim/{slug}/{tap}', [App\Http\Controllers\IndexController::class,'watch']);
Route::get('/episode', [App\Http\Controllers\IndexController::class,'episode'])->name('espisode');
Route::get('/tap-phim', [App\Http\Controllers\IndexController::class,'episode'])->name('tap-phim');
Route::get('/nam/{year}',[App\Http\Controllers\IndexController::class,'year']);
Route::get('/tag/{tag}',[App\Http\Controllers\IndexController::class,'tag']);
Route::get('/director/{director}',[App\Http\Controllers\IndexController::class,'director']);
Route::get('/actor/{actor}',[App\Http\Controllers\IndexController::class,'actor']);
Route::get('/search',[App\Http\Controllers\IndexController::class,'search'])->name('search');
Route::get('/locphim',[App\Http\Controllers\IndexController::class,'locphim'])->name('locphim');
Route::post('/rating',[App\Http\Controllers\IndexController::class,'add_rating'])->name('add_rating');




Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('resorting', [App\Http\Controllers\CategoryController::class, 'resorting_category'])->name('resorting_category');

//Route Admin 
Route::resource('/category',App\Http\Controllers\CategoryController::class);
Route::resource('/reviewphim',App\Http\Controllers\ReviewPhimController::class);
Route::resource('/genre',App\Http\Controllers\GenreController::class);
Route::resource('/country',App\Http\Controllers\CountryController::class);
Route::resource('/movie',App\Http\Controllers\MovieController::class);
Route::get('/update-year-phim',[App\Http\Controllers\MovieController::class,'update_year']);
Route::get('/update-season-phim',[App\Http\Controllers\MovieController::class,'update_season']);
Route::resource('/episode',App\Http\Controllers\EpisodeController::class);
Route::get('/select-movie',[App\Http\Controllers\EpisodeController::class,'select_movie'])->name('select-movie');



//resource đã bao gồm các phương thức get , post, put , ... 
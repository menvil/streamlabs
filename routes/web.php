<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TwitchController;
use App\Http\Controllers\TwitchAuthController;

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

//Route::resource('twitch', TwitchController::class);

//Route::get('/login', [TwitchAuthController::class, 'redirectToProvider'])->name('login');
//Route::get('/login_callback', [TwitchAuthController::class, 'handleProviderCallback']);
//
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('streams',  [TwitchController::class, 'streams'])->name('streams');
    Route::get('total-number-for-each-game',  [TwitchController::class, 'totalNumbers'])->name('total-number-for-each-game');
    Route::get('top-games-by-viewers-count',  [TwitchController::class, 'topGames'])->name('top-games-by-viewers-count');
    Route::get('median-number',  [TwitchController::class, 'medianNumber'])->name('median-number');
    Route::get('top-100-streams-by-viewer-count',  [TwitchController::class, 'top100Streams'])->name('top-100-streams-by-viewer-count');
    Route::get('streams-by-start-date',  [TwitchController::class, 'streamsByStartDate'])->name('streams-by-start-date');
    Route::get('user-following',  [TwitchController::class, 'userFollowing'])->name('user-following');
    Route::get('how-many',  [TwitchController::class, 'howMany'])->name('how-many');
    Route::get('shared-tags',  [TwitchController::class, 'sharedTags'])->name('shared-tags');

    Route::get('dashboard',  function () {
        return view('dashboard');
    })->name('dashboard');
});


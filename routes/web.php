<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\TournamentController;
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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/',[GeneralController::class, 'index']);
Route::get('/home',[GeneralController::class, 'index']);
Route::get('/setTournament',[TournamentController::class, 'index']);
Route::get('/reportDashboard',[TournamentController::class, 'report_dashboard']);
Route::post('/generate_input',[TournamentController::class, 'generate_input']);
Route::post('/save_players',[TournamentController::class, 'save_players']);

Route::post('/save_players', [TournamentController::class, 'save_players'])->name('savePlayer');
Route::post('/search_tournament', [TournamentController::class, 'search_tournament']);
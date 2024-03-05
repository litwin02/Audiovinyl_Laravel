<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VinylsController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\GenresController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/vinyls/list', [VinylsController::class, 'ListAllVinyls']);
Route::post('/vinyls/add', [VinylsController::class, 'AddVinyl']);
Route::get('/vinyls/search', [VinylsController::class, 'SearchVinyls']);
Route::get('/vinyls/{id}', [VinylsController::class, 'GetVinyl']);
Route::put('/vinyls/{id}', [VinylsController::class, 'UpdateVinyl']);
Route::delete('/vinyls/{id}', [VinylsController::class, 'DeleteVinyl']);

Route::get('/artists/list', [ArtistsController::class, 'ListAllArtistsJson']);
Route::get('/artists/{id}', [ArtistsController::class, 'GetArtist']);
Route::post('/artists/add', [ArtistsController::class, 'AddArtist']);
Route::put('/artists/{id}', [ArtistsController::class, 'UpdateArtist']);
Route::delete('/artists/{id}', [ArtistsController::class, 'DeleteArtist']);

Route::get('/genres/list', [GenresController::class, 'ListAllGenresJson']);
Route::get('/genres/{id}', [GenresController::class, 'GetGenre']);
Route::post('/genres/add', [GenresController::class, 'AddGenre']);
Route::put('/genres/{id}', [GenresController::class, 'UpdateGenre']);
Route::delete('/genres/{id}', [GenresController::class, 'DeleteGenre']);
<?php
use App\Http\Controllers\BasicController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VinylsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\VinylImagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/o-sklepie', [BasicController::class, 'returnAboutPage']);
Route::get('/kontakt', [BasicController::class, 'returnContactPage']);

Route::get('/', [VinylsController::class, 'ListAllNewVinyls']);
Route::get('/plyty', [VinylsController::class, 'ListAllVinylsAlphabetically']);
Route::get('/szukaj', [VinylsController::class, 'SearchVinyls']);


Route::get('/kategorie', [GenresController::class, 'ShowAllGenres']);
Route::get('/kategorie/{id}', [VinylsController::class, 'ListAllVinylsByGenre']);


Route::get('/artysci', [ArtistsController::class, 'ShowAllArtists']);
Route::get('/artysci/{id}', [VinylsController::class, 'ListAllVinylsByArtist']);


Route::get('/dodaj_obrazek', [VinylImagesController::class, 'AddVinylImage']);
Route::post('/dodaj_obrazek', [VinylImagesController::class, 'AddImage']);



Route::get('/koszyk', [CartController::class, 'cartList'])->name('cart.list');
Route::post('/koszyk', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('/aktualizuj_koszyk', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/usun_produkt', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/wyczysc_koszyk', [CartController::class, 'clearAllCart'])->name('cart.clear');
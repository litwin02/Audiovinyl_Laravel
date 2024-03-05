<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\VinylsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\VinylImagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/wyloguj', [BasicController::class, 'zmienStanUwierzytelnienia']);
});

// Rejestrowanie użytkownika
Route::get('/zaloguj', [BasicController::class, 'zmienStanUwierzytelnienia']);
Route::get('/rejestracja', [BasicController::class, 'returnRegisterPage']);


// Podstawowe ścieżki
Route::get('/', [VinylsController::class, 'ListAllNewVinyls'])->name('home');
Route::get('/plyty', [VinylsController::class, 'ListAllVinylsAlphabetically']);
Route::get('/szukaj', [VinylsController::class, 'SearchVinyls']);
Route::get('/o-sklepie', [BasicController::class, 'returnAboutPage']);
Route::get('/kontakt', [BasicController::class, 'returnContactPage']);

// Pokaż winyle
Route::get('/winyl/{id}', [VinylsController::class, 'ShowVinylDetails']);

// Pokaż kategorie
Route::get('/kategorie', [GenresController::class, 'ShowAllGenres']);
Route::get('/kategorie/{id}', [VinylsController::class, 'ListAllVinylsByGenre']);

//Pokaż artystów
Route::get('/artysci', [ArtistsController::class, 'ShowAllArtists']);
Route::get('/artysci/{id}', [VinylsController::class, 'ListAllVinylsByArtist']);

// Obsługa zamówień
Route::get('/moje-zamowienia/{id}', [OrdersController::class, 'GetOrdersOfUser'])->name('user.orders');
Route::post('/anuluj_zamowienie', [OrderStatusController::class, 'CancelOrder'])->name('cancel.order');



// Obsługa koszyka
Route::get('/koszyk', [CartController::class, 'cartList'])->name('cart.list');
Route::post('/koszyk', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('/aktualizuj_koszyk', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/usun_produkt', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/wyczysc_koszyk', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('/zloz_zamowienie', [OrdersController::class, 'ShowOrderForm'])->name('cart.placeOrder');
Route::post('/zloz_zamowienie', [OrdersController::class, 'StoreOrder'])->name('cart.storeOrder');


Route::middleware('admin')->group(function () {
// Ścieżki administracyjne
//Winyle
Route::get('/dodaj_winyl', [VinylsController::class, 'ShowAddVinylForm']);
Route::post('/dodaj_winyl', [VinylsController::class, 'AddVinyl']);

Route::get('/modyfikuj_winyl/{id}', [VinylsController::class, 'ShowVinylDetailsToUpdate']);
Route::post('/modyfikuj_winyl', [VinylsController::class, 'UpdateVinyl']);

Route::get('/usun_winyl/{id}', [VinylsController::class, 'ShowVinylDetailsToDelete']);
Route::delete('/usun_winyl/{id}', [VinylsController::class, 'DeleteVinyl']);


Route::get('/zarzad_zdjeciami/{id}', [VinylImagesController::class, 'ManageVinylImages']);
Route::post('/dodaj_zdjecie', [VinylImagesController::class, 'AddImage'])->name('add.image');
Route::delete('/usun_zdjecie', [VinylImagesController::class, 'DeleteImage'])->name('delete.image');


//Kategorie
Route::get('/dodaj_kategorie', [GenresController::class, 'ShowAddGenreForm']);
Route::post('/dodaj_kategorie', [GenresController::class, 'AddGenre']);

Route::get('/modyfikuj_kategorie/{id}', [GenresController::class, 'ShowGenreDetailsToUpdate']);
Route::post('/modyfikuj_kategorie', [GenresController::class, 'UpdateGenre']);

Route::get('/usun_kategorie/{id}', [GenresController::class, 'ShowGenreDetailsToDelete']);
Route::delete('/usun_kategorie/{id}', [GenresController::class, 'DeleteGenre']);


//Artyści
Route::get('/dodaj_artyste', [ArtistsController::class, 'ShowAddArtistForm']);
Route::post('/dodaj_artyste', [ArtistsController::class, 'AddArtist']);

Route::get('/modyfikuj_artyste/{id}', [ArtistsController::class, 'ShowArtistDetailsToUpdate']);
Route::post('/modyfikuj_artyste', [ArtistsController::class, 'UpdateArtist']);

Route::get('/usun_artyste/{id}', [ArtistsController::class, 'ShowArtistDetailsToDelete']);
Route::delete('/usun_artyste/{id}', [ArtistsController::class, 'DeleteArtist']);


//Użytkownicy
Route::get('/edit-user/{id}', [UsersController::class, 'EditUser'])->name('admin.users.edit');
Route::post('/edit-user', [UsersController::class, 'UpdateUser'])->name('admin.users.update');
Route::delete('/delete-user/{id}', [UsersController::class, 'DeleteUser'])->name('admin.users.delete');


// Zarządzanie
Route::get('/zarzad-winyle', [AdminController::class, 'returnVinylManagementView'])->name('admin.vinyls');
Route::get('/zarzad-kategorie', [AdminController::class, 'returnGenreManagementView'])->name('admin.genres');
Route::get('/zarzad-artysci', [AdminController::class, 'returnArtistsManagementView'])->name('admin.artists');
Route::get('/zarzad-zamowienia', [AdminController::class, 'returnOrdersManagementView'])->name('admin.orders');
Route::get('/zarzad-uzytkownicy', [AdminController::class, 'returnUsersManagementView'])->name('admin.users');


// Obsługa zamówień
Route::post('/potwierdz_zamowienie', [OrderStatusController::class, 'ConfirmOrder'])->name('confirm.order');
});
require __DIR__.'/auth.php';

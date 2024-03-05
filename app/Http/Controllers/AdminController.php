<?php

namespace App\Http\Controllers;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\VinylsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\UsersController;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function returnVinylManagementView()
    {
        $controller = new VinylsController();
        return view('management.vinylManagement', ['vinyls' => $controller->GetAllVinyls()]);
    }

    public function returnGenreManagementView()
    {
        $controller = new GenresController();
        return view('management.genreManagement', ['genres' => $controller->GetAllGenres()]);
    }

    public function returnArtistsManagementView()
    {
        $controller = new ArtistsController();
        return view('management.artistsManagement', ['artists' => $controller->GetAllArtists()]);
    }

    public function returnOrdersManagementView()
    {
        $controller = new OrdersController();
        return view('management.ordersManagement', ['orders' => $controller->GetAllOrders()]);
    }

    public function returnUsersManagementView()
    {
        $controller = new UsersController();
        return view('management.usersManagement', ['users' => $controller->GetAllUsers()]);
    }
}

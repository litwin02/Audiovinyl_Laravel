<?php

namespace App\Http\Controllers;

use App\Models\Vinyls;
use App\Http\Requests\VinylsRequest;
use App\Http\Controllers\VinylImagesController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\GenresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class VinylsController extends Controller
{

    public function AddImagesToResults($vinyls)
    {
        foreach ($vinyls as $vinyl) {
            $vinylImagesController = new VinylImagesController(); // Create an instance of VinylImagesController
            $images = $vinylImagesController->GetVinylImages($vinyl->id); // Call the GetVinylImages() method on the instance
            $vinyl->image_paths = $images;
        }
        return $vinyls;
    }

    public function AddImageToResult($vinyl)
    {
        $vinylImagesController = new VinylImagesController(); // Create an instance of VinylImagesController
        $images = $vinylImagesController->GetVinylImages($vinyl->id); // Call the GetVinylImages() method on the instance
        $vinyl->image_paths = $images;
        return $vinyl;
    }

    public function GetAllVinyls()
    {
        $vinyls = DB::table('vinyls')
            ->join('artists', 'vinyls.artist_id', '=', 'artists.id')
            ->join('genres', 'vinyls.genre_id', '=', 'genres.id')
            ->select('vinyls.*', 'artists.name as artist_name', 'genres.description as genre_description')
            ->get();
        $vinyls = $this->AddImagesToResults($vinyls);
        return $vinyls;
    }

    public function ListAllNewVinyls()
    {
        $vinyls = $this->GetAllVinyls();
        $vinyls = $vinyls->sortByDesc('created_at');
        return view('home', ['vinyls' => $vinyls]);
    }

    public function ListAllVinylsAlphabetically()
    {
        $vinyls = $this->GetAllVinyls();
        $vinyls = $vinyls->sortBy('title');
        return view('plyty', ['vinyls' => $vinyls, 'header' => 'Wszystkie płyty']);
    }

    public function ListAllVinylsByGenre($genre_id)
    {
        $vinyls = $this->GetAllVinyls();
        $vinyls = $vinyls->where('genre_id', $genre_id);
        $genre = DB::table('genres')->where('id', $genre_id)->first();
        return view('plyty', ['vinyls' => $vinyls, 'header' => 'Płyty gatunku ' . $genre->description]);
    }

    public function ShowVinylDetails($id)
    {
        $vinyl = $this->GetVinyl($id);
        return view('plyta', ['vinyl' => $vinyl, 'header' => 'Płyta ' . $vinyl->title . ' - ' . $vinyl->artist_name]);
    }

    public function SearchVinyls(Request $request)
    {
        $search = $request->search;
        $vinyls = DB::table('vinyls')
            ->join('artists', 'vinyls.artist_id', '=', 'artists.id')
            ->join('genres', 'vinyls.genre_id', '=', 'genres.id')
            ->select('vinyls.*', 'artists.name as artist_name', 'genres.description as genre_description')
            ->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(vinyls.title) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(artists.name) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(genres.description) LIKE ?', ['%' . strtolower($search) . '%']);
            })->get();

        $vinyls = $this->AddImagesToResults($vinyls);
        if($vinyls->isEmpty() || $search == null)
        {
            return view('search_result', ['vinyls' => [], 'search' => $search]);
        }
        return view('search_result', ['vinyls' => $vinyls, 'search' => $search]);
    }

    public function ListAllVinylsByArtist($artist_id)
    {
        $vinyls = $this->GetAllVinyls();
        $vinyls = $vinyls->where('artist_id', $artist_id);
        $artist = DB::table('artists')->where('id', $artist_id)->first();
        return view('plyty', ['vinyls' => $vinyls, 'header' => 'Płyty artysty ' . $artist->name]);
    }

    public function ShowAddVinylForm()
    {
        $genresController = new GenresController();
        $artistsController = new ArtistsController();
        $genres = $genresController->GetAllGenres();
        $artists = $artistsController->GetAllArtists();
        return view('management.addVinyl', ['genres' => $genres, 'artists' => $artists]);
    }

    public function AddVinyl(Request $request)
    {
        $vinyl = new Vinyls();
        $data = $request;

        $vinyl->title = $data['title'];
        $vinyl->description = $data['description'];
        $vinyl->artist_id = $data['artist_id'];
        $vinyl->genre_id = $data['genre_id'];
        $vinyl->quantity = $data['quantity'];
        $vinyl->price = $data['price'];
        $vinyl->save();
        
        return redirect()->route('admin.vinyls')->with('success', 'Dodano płytę');
    }

    public function GetVinyl($id)
    {
        $vinyl = DB::table('vinyls')
            ->join('artists', 'vinyls.artist_id', '=', 'artists.id')
            ->join('genres', 'vinyls.genre_id', '=', 'genres.id')
            ->select('vinyls.*', 'artists.name as artist_name', 'genres.description as genre_description')
            ->where('vinyls.id', $id)
            ->first();
        if($vinyl == null)
        {
            return redirect()->route('home')->with('error', 'Nie znaleziono płyty');
        }
        $vinyl = $this->AddImageToResult($vinyl);
        return $vinyl;
    }

    public function ShowVinylDetailsToUpdate($id)
    {
        $genresController = new GenresController();
        $artistsController = new ArtistsController();
        $genres = $genresController->GetAllGenres();
        $artists = $artistsController->GetAllArtists();
        $vinyl = Vinyls::find($id);
        if($vinyl == null)
        {
            return redirect()->route('admin.vinyls')->with('error', 'Nie znaleziono płyty');
        }
        return view('management.editVinyl', ['vinyl' => $vinyl, 'genres' => $genres, 'artists' => $artists]);
    }

    public function UpdateVinyl(Request $request)
    {
        $data = $request;
        $vinyl = Vinyls::find($data['id']);
        if($vinyl == null)
        {
            return redirect()->route('admin.vinyls')->with('error', 'Nie znaleziono płyty');
        }
        $vinyl->title = $data['title'];
        $vinyl->description = $data['description'];
        $vinyl->artist_id = $data['artist_id'];
        $vinyl->genre_id = $data['genre_id'];
        $vinyl->quantity = $data['quantity'];
        $vinyl->price = $data['price'];
        $vinyl->save();
        
        return redirect()->route('admin.vinyls')->with('success', 'Zaktualizowano płytę');
    }

    public function ShowVinylDetailsToDelete($id)
    {
        $vinyl = Vinyls::find($id);
        if($vinyl == null)
        {
            return redirect()->route('admin.vinyls')->with('error', 'Nie znaleziono płyty');
        }
        return view('management.deleteVinyl', ['vinyl' => $vinyl]);
    }

    public function DeleteVinyl($id)
    {
        $vinyl = Vinyls::find($id);
        if($vinyl == null)
        {
            return redirect()->route('admin.vinyls')->with('error', 'Nie znaleziono płyty');
        }
        $vinyl->delete();
        
        return redirect()->route('admin.vinyls')->with('success', 'Usunięto płytę');
    }

    public function UpdateQuantity($id, $quantity)
    {
        $vinyl = Vinyls::find($id);
        if($vinyl == null)
        {
            return redirect()->route('home')->with('error', 'Wystąpił błąd: nie znaleziono płyty');
        }
        $vinyl->quantity = $vinyl->quantity - $quantity;
        $vinyl->save();
    }
    
    public function UpdateQuantityAfterCancel($id, $quantity)
    {
        $vinyl = Vinyls::find($id);
        $vinyl->quantity = $vinyl->quantity + $quantity;
        $vinyl->save();
    }


}

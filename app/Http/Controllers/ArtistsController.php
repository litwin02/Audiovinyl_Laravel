<?php

namespace App\Http\Controllers;


use App\Models\Artists;
use App\Http\Requests\ArtistsRequest;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{

    public function ShowAllArtists()
    {
        $artists = $this->GetAllArtists();
        return view('artists', ['artists' => $artists]);
    }

    public function GetAllArtists()
    {
        $artists = Artists::all();
        return $artists;
    }

    public function ShowAddArtistForm()
    {
        return view('management.addArtist');
    }

    public function AddArtist(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:artists'
        ]);
        $artist = new Artists();
        $artist->name = $data['name'];
        $artist->save();
        return redirect()->route('admin.artists')->with('success', 'Dodano wykonawcę');
    }

    public function ShowArtistDetailsToUpdate($id)
    {
        $artist = Artists::find($id);
        return view('management.editArtist', ['artist' => $artist]);
    }

    public function UpdateArtist(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:artists'
        ]);
        $artist = Artists::find($request->id);

        $artist->name = $data['name'];
        $artist->save();
        return redirect()->route('admin.artists')->with('success', 'Zaktualizowano wykonawcę');
    }
    
    public function ShowArtistDetailsToDelete($id)
    {
        $artist = Artists::find($id);
        return view('management.deleteArtist', ['artist' => $artist]);
    }

    public function DeleteArtist($id)
    {
        $artist = Artists::find($id);
        $artist->delete();
        return redirect()->route('admin.artists')->with('success', 'Usunięto wykonawcę');
    }

    public function ListAllArtistsJson()
    {
        $artists = $this->GetAllArtists();
        return response()->json($artists);
    }
}

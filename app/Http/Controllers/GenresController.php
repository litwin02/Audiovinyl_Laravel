<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Http\Requests\GenresRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenresController extends Controller
{
    public function ShowAllGenres()
    {
        $genres = $this->GetAllGenres();
        return view('genres', ['genres' => $genres]);
    }

    public function GetAllGenres()
    {
        $genres = Genres::all();
        return $genres;
    }

    public function ShowAddGenreForm()
    {
        $genres = $this->GetAllGenres();
        return view('management.addCategory', ['genres' => $genres]);
    }

    public function AddGenre(Request $request)
    {
        $genre = new Genres();
        $request->validate([
            'description' => 'required|min:3|max:255'
        ]);
        if(Genres::where('description', '=', $request->description)->exists()){
            return redirect()->route('admin.genres')->with('error', 'Kategoria już istnieje');
        }
        $genre->description = $request->description;
        $genre->save();
        return redirect()->route('admin.genres')->with('success', 'Dodano kategorię');
    }

    public function ShowGenreDetailsToUpdate($id)
    {
        $genre = Genres::find($id);
        if ($genre == null) {
            return redirect()->route('admin.genres')->with('error', 'Nie znaleziono kategorii');
        }
        return view('management.updateGenre', ['genre' => $genre]);
    }

    public function UpdateGenre(Request $request)
    {
        $genre = Genres::find($request->id);
        if ($genre == null) {
            return redirect()->route('admin.genres')->with('error', 'Kategoria nie istnieje');
        }
        $request->validate([
            'description' => 'required|min:3|max:255'
        ]);
        if(Genres::where('description', '=', $request->description)->exists()){
            return redirect()->route('admin.genres')->with('error', 'Kategoria już istnieje');
        }
        $genre->description = $request->description;
        $genre->save();
        return redirect()->route('admin.genres')->with('success', 'Katgoria została zaktualizowana');
    }

    public function ShowGenreDetailsToDelete($id)
    {
        $genre = Genres::find($id);
        if ($genre == null) {
            return redirect()->route('admin.genres')->with('error', 'Nie znaleziono kategorii');
        }
        return view('management.deleteGenre', ['genre' => $genre]);
    }

    public function DeleteGenre($id)
    {
        $genre = Genres::find($id);
        if ($genre == null) {
            return redirect()->route('admin.genres')->with('error', 'Kategoria nie istnieje');
        }
        $genre->delete();
        return redirect()->route('admin.genres')->with('success', 'Kategoria została usunięta');
    }

    public function ListAllGenresJson()
    {
        $genres = $this->GetAllGenres();
        return response()->json($genres);
    }
}

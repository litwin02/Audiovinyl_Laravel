<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VinylsController;
use App\Models\Vinyls;
use App\Models\Images_Of_Vinyls;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VinylImagesController extends Controller
{
    public function AddImage(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:vinyls,id',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if($request->hasFile('picture') && $validated){
            $picturePath = $request->file('picture')->store('pictures', 'public_uploads');
            $picturePath = "https://foka.umg.edu.pl/~s48455/PROJEKT_PSI_PAW/Audiovinyl/public/uploads/".$picturePath;
            $image = new Images_Of_Vinyls();
            $image->vinyl_id = $request->id;
            $image->path = $picturePath;
            $image->save();
            return back()->with('success','Udało się dodać zdjęcie!');
        }
        else
        {
            return back()->with('error','Nie udało się dodać zdjęcia!');
        }
        
    }

    public function DeleteImage(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:vinyls,id',
            'image_path' => 'required',
        ]);
        
        if($validated){
            $image = Images_Of_Vinyls::where('path', $request->image_path)->first();
            $image->delete();
            return back()->with('success','Udało się usunąć zdjęcie!');
        }
        else
        {
            return back()->with('error','Nie udało się usunąć zdjęcia!');
        }
    }

    public function ManageVinylImages($id)
    {
        $vinylController = new VinylsController();
        $vinyl = $vinylController->GetVinyl($id);
        return view('images', ['vinyl'=> $vinyl]);
    }

    
    public function GetVinylImages($id)
    {
        $paths = DB::table('images_of_vinyls')->where('vinyl_id', $id)->pluck('path')->toArray();
        return $paths;
    }



}

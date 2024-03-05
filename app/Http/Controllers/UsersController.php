<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function GetAllUsers()
    {
        $users = User::all();
        return $users;
    }

    public function DeleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Użytkownik został usunięty');
    }

    public function EditUser($id)
    {
        $user = User::find($id);
        return view('management.editUser', ['user' => $user]);
    }

    public function UpdateUser(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->email = $request->input('email');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        if ($request->input('role') == 'admin') {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }

        $user->save();
        return redirect()->route('admin.users')->with('success', 'Użytkownik został zaktualizowany');
    }
}

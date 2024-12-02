<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function makeAdmin($id) 
    {
        $user = User::findOrFail($id);

        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('success', 'Usuário definido como administrador com sucesso.');
    }
}

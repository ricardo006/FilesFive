<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings() {
        return view('settings.index');
    }

    public function account() {
        return view('account.index');
    }

    public function showUsers()
    {
        $users = User::where('is_admin', false)->orderBy('name')->get(); // Substitua por um filtro caso necessário.
        return view('settings.users', compact('users'));
    }

}

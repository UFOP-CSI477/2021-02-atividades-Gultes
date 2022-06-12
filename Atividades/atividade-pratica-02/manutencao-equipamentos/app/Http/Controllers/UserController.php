<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function relatorio()
    {
        $users = User::with('registros')->orderBy('name')->get();
        return view('user.relatorio', ['users' => $users]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\User;
use App\Models\Unidadeatendimento;
use Exception;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['regional', 'municipio', 'unidadeatendimento'])->orderBy('nome')->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Article;
use App\Signature;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function loadMyHistory()
    {
        $me = User::find(Auth::user()->id);
        $history = $me->getHistory();
        return response()->json(['status' => 'success', 'data' => ['history' => $history ]], 200);
    }
}

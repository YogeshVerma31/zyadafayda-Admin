<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userList = User::all();
            return view('user/list', ['userList' => $userList]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }
}

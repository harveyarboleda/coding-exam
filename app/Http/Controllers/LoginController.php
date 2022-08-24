<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class LoginController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()) {
            return redirect()->route('user');
        }
        return view('login');
    }

    public function store(Request $request)
    {
        if(Auth::check()) {
            return redirect()->route('user');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {


            return ["status" => "Signed in", "code" => 200, "icon" => "success", "title" => "Success!"];
        }
        return ["status" => "Login details are not valid.", "code" => 401, "icon" => "error", "title" => "Error!"];
        
    }
}

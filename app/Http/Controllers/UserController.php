<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        return view("user");
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
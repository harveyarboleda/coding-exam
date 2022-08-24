<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class RegisterController extends Controller {
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

        return view('register');
    }

    public function store(Request $request)
    {
        if(Auth::check()) {
            return redirect()->route('user');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
            'roles_id' => 'required|min:1',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return ["status" => "Created account!", "code" => 200, "icon" => "success", "title" => "Success!"];
    }
    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirm_password' => Hash::make($data['confirm_password']),
            'roles_id' => $data['roles_id']
        ]);
    }
}

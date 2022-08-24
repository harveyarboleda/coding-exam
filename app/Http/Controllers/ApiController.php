<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use App\Models\Roles;
use Hash;

class ApiController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function roles()
    {
        $roles = Roles::all();
        return $roles;
    }

    public function users()
    {
        $users = User::all();
        return $users;
    }

    public function updateAccount(Request $request) {
        $array = [
            'name' => $request->name,
            'email' => $request->email,
            'roles_id' => $request->roles_id,
        ];

        db::table('users')
        ->where('id', $request->id)
        ->update($array);
        return ['success!'];
    }

    public function updateRole(Request $request) {
        $array = [
            'roles_name' => $request->roles_name,
            'roles_description' => $request->roles_description,
        ];

        db::table('roles')
        ->where('id', $request->id)
        ->update($array);
        return ['success!'];
    }

    public function deleteAccount(Request $request) {
        db::table('roles')
        ->where('id', $request->id)
        ->delete();
        return ['success!'];
    }

    public function deleteRole(Request $request) {
        db::table('roles')
        ->where('id', $request->id)
        ->delete();
        return ['success!'];
    }

    public function addRole(Request $request) {
        $array = [
            'roles_name' => $request->roles_name,
            'roles_description' => $request->roles_description,
        ];

        db::table('roles')
        ->insert($array);
        return ['success!'];
    }
    
}
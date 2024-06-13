<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::with(['users' => function($query) {
            $query->select('users.id', 'users.name', 'users.email', 'role_id');
        }])->orderBy('id', 'asc')->get();
        
        $super_admin_users = $roles[0]->users;
        $admin_users = $roles[1]->users;
        $guest_users = $roles[2]->users;
    
        echo($super_admin_users);

        return view('users.index', compact(['super_admin_users', 'admin_users', 'guest_users']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
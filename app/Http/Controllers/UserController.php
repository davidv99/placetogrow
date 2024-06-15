<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\alert;

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
    
        return view('users.index', compact(['super_admin_users', 'admin_users', 'guest_users']));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $role = Role::findByName($request->role);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('status', 'User created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        alert("HOLAAAAAA");
        alert($id);

        $user = User::find($id);

        return view("users.edit", compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:super_admin,admin,guest',
        ]);
        alert("HOLAAAAAA");
    
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ]);
        alert("ASFA.JDSNFADS.F");
    
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('status', 'User deleted successfully');
    }
}
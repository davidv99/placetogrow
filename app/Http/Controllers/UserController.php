<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return redirect()->route('users.index')
            ->with('status', 'User created successfully!')
            ->with('class', 'bg-green-500');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        $role_name = $user->getRoleNames();

        return view("users.show", compact('user', 'role_name'));
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        return view("users.edit", compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:super_admin,admin,guest',
        ]);
        
        if (empty($validatedData['password'])) {
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
        }else{
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);
        }

        $user->syncRoles([$validatedData['role']]);
        
        return redirect()->route('users.index')
            ->with('status', 'User updated successfully')
            ->with('class', 'bg-green-500');
    }

    public function destroy(User $user)
    {
        if($this->valide_last_super_admin($user)){
            $user->delete();

            return redirect()->route('users.index')
                ->with('status', 'User deleted successfully')
                ->with('class', 'bg-green-500');
        }else{
            return redirect()->route('users.index')
                ->with('status', 'User not deleted because not exist more super admins users')
                ->with('class', 'bg-yellow-500');
        }

    }

    private function valide_last_super_admin($user){
        $role_name = $user->getRoleNames();

        if($role_name[0] === 'super_admin'){
            $count = DB::table('model_has_roles')
            ->where('role_id', 1)
            ->count();
            
            return ($count > 1) ? true : false;
        }else{
            return true;
        }
        
    }
}
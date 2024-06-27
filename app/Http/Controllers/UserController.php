<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if ($this->validate_role()) {

            $roles = Cache::get('users.index');
            if (is_null($roles)) {
                $roles = Role::with(['users' => function ($query) {
                    $query->select('users.id', 'users.name', 'users.email', 'role_id');
                }])->orderBy('id', 'asc')->get();

                Cache::put('users.index', $roles);
            }

            $super_admin_users = $roles[0]->users;
            $admin_users = $roles[1]->users;
            $guest_users = $roles[2]->users;

            return view('users.index', compact(['super_admin_users', 'admin_users', 'guest_users']));
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-yellow-500');
    }

    public function create()
    {
        if ($this->validate_role()) {
            return view('users.create');
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-red-500');
    }

    public function store(Request $request)
    {
        if ($this->validate_role()) {
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

            $role = Cache::get('role');
            if (is_null($role)) {
                $role = Role::findByName($request->role);

                Cache::put('role', $role);
            }

            $user->assignRole($role);

            Cache::forget('users.index');

            return redirect()->route('users.index')
                ->with('status', 'User created successfully!')
                ->with('class', 'bg-green-500');
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-red-500');
    }

    public function show(string $id)
    {
        if ($this->validate_role()) {

            $user = Cache::get('user.'.$id);
            if (is_null($user)) {
                $user = User::find($id);

                Cache::put('user.'.$id, $user, $minutes = 1000);
            }

            $role_name = $user->getRoleNames();

            return view('users.show', compact('user', 'role_name'));
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-red-500');
    }

    public function edit(string $id)
    {
        if ($this->validate_role()) {

            $user = Cache::get('user.'.$id);
            if (is_null($user)) {
                $user = User::find($id);

                Cache::put('user.'.$id, $user, $minutes = 1000);
            }

            return view('users.edit', compact("user"));
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-red-500');
    }

    public function update(Request $request, User $user)
    {
        if ($this->validate_role()) {
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
            } else {
                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                ]);
            }

            Cache::forget('user.'.$user->id);
            Cache::forget('users.index');

            $user->syncRoles([$validatedData['role']]);

            return redirect()->route('users.index')
                ->with('status', 'User updated successfully')
                ->with('class', 'bg-green-500');
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-red-500');
    }

    public function destroy(User $user)
    {
        if ($this->validate_role()) {
            if ($this->valide_last_super_admin($user)) {
                $user->delete();

                Cache::forget('user.'.$user->id);
                Cache::forget('users.index');

                return redirect()->route('users.index')
                    ->with('status', 'User deleted successfully')
                    ->with('class', 'bg-green-500');
            } else {
                return redirect()->route('users.index')
                    ->with('status', 'User not deleted because not exist more super admins users')
                    ->with('class', 'bg-yellow-500');
            }
        }

        return redirect()->route('dashboard')
            ->with('status', 'User not authorized for this route')
            ->with('class', 'bg-red-500');
    }

    private function valide_last_super_admin($user)
    {
        $role_name = $user->getRoleNames();

        if ($role_name[0] === 'super_admin') {
            $count = DB::table('model_has_roles')
                ->where('role_id', 1)
                ->count();

            return ($count > 1) ? true : false;
        } else {
            return true;
        }
    }

    private function validate_role()
    {
        $role_name = User::find(auth()->user()->id)->getRoleNames();

        return ($role_name[0] === 'super_admin' || $role_name[0] === 'admin') ? true : false;
    }
}

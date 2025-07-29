<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{



    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);

        return view('admin.user.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.user.create', compact('roles'));
    }


    public function store(StoreUserRequest $request): RedirectResponse
    {

        $data = $request->validated();
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['roles']);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function show(User $user): View
    {
        return view('admin.user.show', compact('user'));
    }


    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.user.edit', compact('user', 'roles', 'userRole'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        $user->syncRoles($data['roles']);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }
    public function updatePassword(Request $request, User $user)
{
    $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->back()->with('success', 'Mot de passe mis à jour.');
}


    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}

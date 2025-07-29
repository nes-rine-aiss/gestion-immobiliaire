<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SuperAdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:superadmin']);
    // }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        
        $recentUsers = User::with('roles')->latest()->take(5)->get();

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'totalRoles', 
            'totalPermissions',
            'recentUsers'
        ));
        
    }
    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('superadmin.users', compact('users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('success', 'Rôle assigné avec succès!');
    }
}

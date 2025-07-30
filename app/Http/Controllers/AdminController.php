<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permissions : manage-users,manage-properties,view-reports,
        create-users,edit-users,delete-users')->only(['users','dashboard']);
    }

    public function dashboard()
    {
        $totalUsers = User::role(['proprietaire', 'locataire'])->count();
        $recentUsers = User::role(['proprietaire', 'locataire'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'recentUsers'));
    }

    public function users()
    {
        $users = User::role(['proprietaire', 'locataire'])->with('roles')->paginate(10);
        return view('admin.users', compact('users'));
    }
}

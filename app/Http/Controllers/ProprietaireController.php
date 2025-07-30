<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ProprietaireController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('permissions:manage-properties,view-reports,create-properties,edit-properties,delete-properties')->only(['dashbord','properties']);
    // }
    public function dashboard()
    {
        $user = Auth::user();
        // Ici vous pouvez ajouter la logique pour récupérer les propriétés du propriétaire
        
        return view('proprietaire.dashboard', compact('user'));
    }

    public function properties()
    {
        // Logique pour afficher les propriétés du propriétaire connecté
        return view('proprietaire.properties');
    }
}

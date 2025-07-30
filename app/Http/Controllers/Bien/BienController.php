<?php

namespace App\Http\Controllers\Bien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BienController extends \App\Http\Controllers\Controller
{
    // public function __construct()
    // {
    //     // Protéger toutes les actions sauf index et show
    //     $this->middleware('auth')->except(['index', 'show']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $types = config('biens.types', []);
        // $equipements = config('biens.equipements', []);
        
        return view('biens.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

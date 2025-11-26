<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Http\Requests\StoredepartemenRequest;
use App\Http\Requests\UpdatedepartemenRequest;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Departemen::all();
        return view('departemen.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departemens'
        ]);

        Departemen::create([
            'nama_departemen' => $request->nama_departemen
        ]);

        return redirect()->back()->with('success', 'Departemen berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_departemen)
    {
        $departemen = Departemen::findOrFail($id_departemen);
        return view('departemen.show', compact('departemen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_departemen)
    {
        $departemen = Departemen::findOrFail($id_departemen);
        return view('departemen.edit', compact('departemen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_departemen)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100'
        ]);

        $departemen = Departemen::findOrFail($id_departemen);
        $departemen->update([
            'nama_departemen' => $request->nama_departemen
        ]);

        return redirect()->back()->with('success', 'Departemen berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_departemen)
    {
        Departemen::findOrFail($id_departemen)->delete();
        return redirect()->back()->with('success', 'Departemen berhasil dihapus!');
    }
}

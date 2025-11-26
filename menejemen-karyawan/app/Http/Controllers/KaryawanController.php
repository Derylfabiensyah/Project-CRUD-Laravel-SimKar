<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Departemen;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Karyawan::with('departemen')->get(); // Mengambil semua karyawan
        $departemens = Departemen::all(); // Mengambil semua departemen
        return view('karyawan.data', compact('data', 'departemens')); // Mengirim data ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'id_departemen' => 'required|exists:departemens,id_departemen',
            'tanggal_masuk' => 'required|date'
        ]);

        Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'id_departemen' => $request->id_departemen,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);

        return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $departemens = Departemen::all();
        return view('karyawan.edit', compact('karyawan', 'departemens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'id_departemen' => 'required|exists:departemens,id_departemen',
            'tanggal_masuk' => 'required|date'
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'id_departemen' => $request->id_departemen,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);

        return redirect()->back()->with('success', 'Karyawan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Karyawan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Karyawan berhasil dihapus!');
    }
}

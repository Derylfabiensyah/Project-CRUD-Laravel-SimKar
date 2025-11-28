<?php

namespace App\Http\Controllers;

use App\Models\jadwalKerja;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class JadwalKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = jadwalKerja::with('karyawan')->get();
        $karyawans = Karyawan::all();

        return view('jadwal_kerja.index', compact('data', 'karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('jadwal_kerja.form', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'tanggal_kerja' => 'required|date',
            'shift' => 'required|in:Pagi,Siang,Malam',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        jadwalKerja::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal_kerja' => $request->tanggal_kerja,
            'shift' => $request->shift,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return back()->with('success', 'Jadwal kerja berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(jadwalKerja $jadwalKerja)
    {
        // not used
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = jadwalKerja::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('jadwal_kerja.edit', compact('item', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'tanggal_kerja' => 'required|date',
            'shift' => 'required|in:Pagi,Siang,Malam',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $pg = jadwalKerja::findOrFail($id);

        $pg->update([
            'id_karyawan' => $request->id_karyawan,
            'tanggal_kerja' => $request->tanggal_kerja,
            'shift' => $request->shift,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return back()->with('success', 'Jadwal kerja berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        jadwalKerja::findOrFail($id)->delete();

        return back()->with('success', 'Data jadwal kerja berhasil dihapus!');
    }
}

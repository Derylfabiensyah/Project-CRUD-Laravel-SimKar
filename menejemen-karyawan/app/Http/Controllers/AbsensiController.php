<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $data = Absensi::with('karyawan')->get(); // Eager loading
        $karyawan = Karyawan::all();

        return view('absensi.index', compact('data', 'karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'tanggal_absensi' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'status' => 'required'
        ]);

        Absensi::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal_absensi' => $request->tanggal_absensi,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Absensi berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'tanggal_absensi' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'status' => 'required'
        ]);

        $absensi = Absensi::findOrFail($id);

        $absensi->update([
            'id_karyawan' => $request->id_karyawan,
            'tanggal_absensi' => $request->tanggal_absensi,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Absensi berhasil diupdate!');
    }

    public function destroy($id)
    {
        Absensi::findOrFail($id)->delete();

        return back()->with('success', 'Data absensi berhasil dihapus!');
    }
}

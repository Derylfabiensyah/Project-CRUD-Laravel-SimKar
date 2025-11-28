<?php

namespace App\Http\Controllers;

use App\Models\penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load karyawan relation for display
        $data = penggajian::with('karyawan')->get();
        $karyawans = Karyawan::all();

        return view('penggajian.index', compact('data', 'karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('penggajian.form', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'bulan' => 'required|string|max:20',
            'tahun' => 'required|integer',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'tanggal_transfer' => 'required|date'
        ]);

        $gaji_pokok = (float) $request->gaji_pokok;
        $tunjangan = (float) ($request->tunjangan ?? 0);
        $potongan = (float) ($request->potongan ?? 0);
        $total = $gaji_pokok + $tunjangan - $potongan;

        penggajian::create([
            'id_karyawan' => $request->id_karyawan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total,
            'tanggal_transfer' => $request->tanggal_transfer,
        ]);

        return back()->with('success', 'Penggajian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(penggajian $penggajian)
    {
        // not used
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = penggajian::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('penggajian.edit', compact('item', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'bulan' => 'required|string|max:20',
            'tahun' => 'required|integer',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'tanggal_transfer' => 'required|date'
        ]);

        $pg = penggajian::findOrFail($id);

        $gaji_pokok = (float) $request->gaji_pokok;
        $tunjangan = (float) ($request->tunjangan ?? 0);
        $potongan = (float) ($request->potongan ?? 0);
        $total = $gaji_pokok + $tunjangan - $potongan;

        $pg->update([
            'id_karyawan' => $request->id_karyawan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total,
            'tanggal_transfer' => $request->tanggal_transfer,
        ]);

        return back()->with('success', 'Penggajian berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        penggajian::findOrFail($id)->delete();

        return back()->with('success', 'Data penggajian berhasil dihapus!');
    }
}

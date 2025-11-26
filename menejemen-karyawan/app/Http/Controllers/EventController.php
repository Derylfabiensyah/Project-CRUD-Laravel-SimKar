<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::all();
        return view('event_karyawan.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan'   => 'required|exists:karyawans,id',
            'jenis_event'   => 'required|string|max:150|unique:events,jenis_event',
            'tanggal_event' => 'nullable|date',
            'keterangan'    => 'nullable|string'
        ]);

        Event::create([
            'id_karyawan'   => $request->id_karyawan,
            'jenis_event'   => $request->jenis_event,
            'tanggal_event' => $request->tanggal_event,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event_karyawan.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event_karyawan.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan'   => 'required|exists:karyawans,id',
            'jenis_event'   => 'required|string|max:150',
            'tanggal_event' => 'nullable|date',
            'keterangan'    => 'nullable|string'
        ]);

        $event = Event::findOrFail($id);
        $event->update([
            'id_karyawan'   => $request->id_karyawan,
            'jenis_event'   => $request->jenis_event,
            'tanggal_event' => $request->tanggal_event,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Event berhasil dihapus!');
    }
}

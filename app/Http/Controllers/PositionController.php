<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')
                        ->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function show(Position $position)
{
    // Load employees dengan relasi department dan hitung jumlahnya
    $position->load(['employees' => function($query) {
        $query->with('department')->latest();
    }]);
    
    return view('positions.show', compact('position'));
}

public function index()
{
    $positions = Position::withCount('employees')->latest()->paginate(10);
    return view('positions.index', compact('positions'));
}

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')
                        ->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy(Position $position)
    {
        if ($position->employees()->exists()) {
            return redirect()->route('positions.index')
                            ->with('error', 'Tidak dapat menghapus jabatan yang masih memiliki karyawan!');
        }

        $position->delete();

        return redirect()->route('positions.index')
                        ->with('success', 'Jabatan berhasil dihapus!');
    }
}
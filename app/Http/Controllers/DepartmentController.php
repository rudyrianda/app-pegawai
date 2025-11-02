<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
                        ->with('success', 'Departemen berhasil ditambahkan!');
    }

   public function show(Department $department)
{
    // Load employees dengan relasi position dan hitung jumlahnya
    $department->load(['employees' => function($query) {
        $query->with('position')->latest();
    }]);
    
    return view('departments.show', compact('department'));
}

public function index()
{
    $departments = Department::withCount('employees')->latest()->paginate(10);
    return view('departments.index', compact('departments'));
}

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $department->id,
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
                        ->with('success', 'Departemen berhasil diperbarui!');
    }

    public function destroy(Department $department)
    {
        if ($department->employees()->exists()) {
            return redirect()->route('departments.index')
                            ->with('error', 'Tidak dapat menghapus departemen yang masih memiliki karyawan!');
        }

        $department->delete();

        return redirect()->route('departments.index')
                        ->with('success', 'Departemen berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        $totalGaji = Salary::sum('total_gaji');
        $avgGaji = Salary::avg('total_gaji');

        return view('salaries.index', compact('salaries', 'totalGaji', 'avgGaji'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'aktif')->get();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ]);

        // Hitung total gaji
        $total_gaji = $request->gaji_pokok + $request->tunjangan - $request->potongan;

        // Cek apakah sudah ada data gaji untuk karyawan di bulan yang sama
        $existing = Salary::where('karyawan_id', $request->karyawan_id)
                         ->where('bulan', $request->bulan)
                         ->exists();

        if ($existing) {
            return back()->with('error', 'Data gaji untuk karyawan ini pada bulan tersebut sudah ada!');
        }

        Salary::create(array_merge($request->all(), ['total_gaji' => $total_gaji]));

        return redirect()->route('salaries.index')
                        ->with('success', 'Data gaji berhasil ditambahkan!');
    }

    public function show(Salary $salary)
    {
        $salary->load('employee');
        return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::where('status', 'aktif')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ]);

        // Hitung total gaji
        $total_gaji = $request->gaji_pokok + $request->tunjangan - $request->potongan;

        // Cek duplikat gaji (kecuali untuk record yang sama)
        $existing = Salary::where('karyawan_id', $request->karyawan_id)
                         ->where('bulan', $request->bulan)
                         ->where('id', '!=', $salary->id)
                         ->exists();

        if ($existing) {
            return back()->with('error', 'Data gaji untuk karyawan ini pada bulan tersebut sudah ada!');
        }

        $salary->update(array_merge($request->all(), ['total_gaji' => $total_gaji]));

        return redirect()->route('salaries.index')
                        ->with('success', 'Data gaji berhasil diperbarui!');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')
                        ->with('success', 'Data gaji berhasil dihapus!');
    }
}
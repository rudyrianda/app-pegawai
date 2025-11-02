<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        $today = now()->format('Y-m-d');
        
        $stats = [
            'hadir' => Attendance::where('status_absensi', 'hadir')->where('tanggal', $today)->count(),
            'izin' => Attendance::where('status_absensi', 'izin')->where('tanggal', $today)->count(),
            'sakit' => Attendance::where('status_absensi', 'sakit')->where('tanggal', $today)->count(),
            'alpha' => Attendance::where('status_absensi', 'alpha')->where('tanggal', $today)->count(),
        ];

        return view('attendances.index', compact('attendances', 'stats'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'aktif')->get();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        // Cek apakah sudah ada absensi untuk karyawan di tanggal yang sama
        $existing = Attendance::where('karyawan_id', $request->karyawan_id)
                            ->where('tanggal', $request->tanggal)
                            ->exists();

        if ($existing) {
            return back()->with('error', 'Absensi untuk karyawan ini pada tanggal tersebut sudah ada!');
        }

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
                        ->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('employee');
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::where('status', 'aktif')->get();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        // Cek duplikat absensi (kecuali untuk record yang sama)
        $existing = Attendance::where('karyawan_id', $request->karyawan_id)
                            ->where('tanggal', $request->tanggal)
                            ->where('id', '!=', $attendance->id)
                            ->exists();

        if ($existing) {
            return back()->with('error', 'Absensi untuk karyawan ini pada tanggal tersebut sudah ada!');
        }

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
                        ->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
                        ->with('success', 'Data absensi berhasil dihapus!');
    }
}
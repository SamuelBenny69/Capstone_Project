<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsenModel;
use App\Models\KaryawanModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AbsenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Absen',
            'list'  => ['Home', 'absen']
        ];

        $page = (object) [
            'title' => 'Daftar absen yang terdaftar dalam sistem'
        ];

        $activeMenu = 'absen'; // set menu yang sedang aktif
        return view('admin.absen.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $absens = DB::table('karyawan')
            ->leftJoin('absens', function ($join) {
                $join->on('karyawan.id', '=', 'absens.karyawan_id')
                    ->whereDate('absens.tgl_absen', Carbon::today());
            })
            ->join('jabatan', 'karyawan.jabatan_id', '=', 'jabatan.id') // Join with jabatan table
            ->select(
                'karyawan.id as karyawan_id',
                'karyawan.nama',
                'jabatan.jabatan as jabatan',
                'absens.tgl_absen',
                'absens.ket'
            );

        return DataTables::of($absens)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn  = '<div class="dropdown d-inline-block">';
                $btn .= '<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown' . $row->karyawan_id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $btn .= 'Aksi';
                $btn .= '</button>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="aksiDropdown' . $row->karyawan_id . '">';
                $btn .= '<a class="dropdown-item" href="' . url('/absen/hadir/' . $row->karyawan_id) . '">Hadir</a>';
                $btn .= '<a class="dropdown-item" href="' . url('/absen/alpha/' . $row->karyawan_id) . '">Alpha</a>';
                $btn .= '<a class="dropdown-item" href="' . url('/absen/sakit/' . $row->karyawan_id) . '">Sakit</a>';
                $btn .= '<a class="dropdown-item" href="' . url('/absen/ijin/' . $row->karyawan_id) . '">Ijin</a>';
                $btn .= '</div>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function hadir($karyawanId)
    {
        $absen = AbsenModel::updateOrCreate(
            ['karyawan_id' => $karyawanId, 'tgl_absen' => Carbon::today()],
            ['ket' => 'Hadir']
        );

        return redirect('/absen')->with('success', 'Data absen berhasil disimpan.');
    }
    public function alpha($karyawanId)
    {
        $absen = AbsenModel::updateOrCreate(
            ['karyawan_id' => $karyawanId, 'tgl_absen' => Carbon::today()],
            ['ket' => 'alpha']
        );

        return redirect('/absen')->with('success', 'Data absen berhasil disimpan.');
    }

    public function sakit($karyawanId)
    {
        $absen = AbsenModel::updateOrCreate(
            ['karyawan_id' => $karyawanId, 'tgl_absen' => Carbon::today()],
            ['ket' => 'sakit']
        );

        return redirect('/absen')->with('success', 'Data absen berhasil disimpan.');
    }

    public function ijin($karyawanId)
    {
        $absen = AbsenModel::updateOrCreate(
            ['karyawan_id' => $karyawanId, 'tgl_absen' => Carbon::today()],
            ['ket' => 'ijin']
        );

        return redirect('/absen')->with('success', 'Data absen berhasil disimpan.');
    }


    public function create()
    {
        // Set up breadcrumb for navigation
        $breadcrumb = (object) [
            'title' => 'Tambah Absen',
            'list'  => ['Home', 'Absen', 'Tambah']
        ];

        // Page title and other details
        $page = (object) [
            'title' => 'Tambah Absen Karyawan'
        ];

        // Get all employees to select which employee's attendance to add
        $karyawan = KaryawanModel::all(); // Assuming you have a KaryawanModel for employees

        // Set the active menu item
        $activeMenu = 'absen';

        return view('admin.absen.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'karyawan' => $karyawan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id', // Ensure the employee exists
            'tgl_absen'   => 'required|date',
            'ket'         => 'required|string|max:255',
        ]);

        // Create a new attendance record
        $absen = new AbsenModel(); // Assuming you have an AbsenModel for attendance
        $absen->karyawan_id = $request->input('karyawan_id');
        $absen->tgl_absen = $request->input('tgl_absen');
        $absen->ket = $request->input('ket');

        // Save the attendance record
        $absen->save();

        // Redirect back to the attendance list with a success message
        return redirect()->route('absen.index')->with('success', 'Data absen berhasil disimpan.');
    }
}

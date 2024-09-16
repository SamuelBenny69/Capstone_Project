<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawanModel;
use App\Models\GajiModel;
use App\Models\JabatanModel;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GajiKaryawanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Gaji Karyawan',
            'list'  => ['Admin', 'Gaji Karyawan']
        ];

        $page = (object) [
            'title' => 'Daftar Gaji Karyawan Jabatan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'gaji-karyawan'; // set menu yang sedang aktif
        return view('admin.gaji-karyawan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $gaji_karyawans = GajiKaryawanModel::select('id', 'tgl_gaji', 'karyawan_id', 'gaji_id')
            ->with('karyawan.jabatan', 'gaji');

        // Filter data karyawan berdasarkan jabatan_id

        return DataTables::of($gaji_karyawans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($gaji_karyawan) {
                $btn  = '<a href="' . url('/gaji-karyawan/' . $gaji_karyawan->id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/gaji-karyawan/' . $gaji_karyawan->id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/gaji-karyawan/' . $gaji_karyawan->id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Gaji Karyawan',
            'list'  => ['Admin', 'Gaji Karyawan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah gaji karyawan'
        ];

        $karyawan = KaryawanModel::with('jabatan')->get();
        $gaji = GajiModel::all();
        $activeMenu = 'gaji-karyawan';
        return view('admin.gaji-karyawan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'karyawan' => $karyawan, 'gaji' => $gaji, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_gaji' => 'required|date',
            'karyawan_id' => 'required|integer',
        ]);

        // Temukan karyawan yang dipilih
        $karyawan = KaryawanModel::with('jabatan')->find($request->karyawan_id);
        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
        }

        // Cari gaji berdasarkan jabatan karyawan
        $gaji = GajiModel::where('jabatan_id', $karyawan->jabatan_id)->first();

        if (!$gaji) {
            return redirect()->back()->with('error', 'Gaji untuk jabatan ini belum ditentukan.');
        }

        // Simpan data gaji karyawan
        GajiKaryawanModel::create([
            'tgl_gaji' => $request->tgl_gaji,
            'karyawan_id' => $karyawan->id,
            'gaji_id' => $gaji->id,
        ]);

        return redirect('/gaji-karyawan')->with('success', 'Data gaji karyawan berhasil disimpan');
    }

    public function getGaji($karyawanId)
    {
        $karyawan = KaryawanModel::find($karyawanId);

        // Temukan gaji berdasarkan jabatan
        $gaji = GajiModel::where('jabatan_id', $karyawan->jabatan_id)->first();

        if (!$gaji) {
            return response()->json(['error' => 'Gaji tidak ditemukan untuk jabatan ini.'], 404);
        }

        if ($gaji) {
            return response()->json([
                'gaji_pokok' => $gaji->gaji_pokok,
                'tunjangan_hadir' => $gaji->tunjangan_hadir,
                'tunjangan_keluarga' => $gaji->tunjangan_keluarga,
                'asuransi' => $gaji->asuransi,
            ]);
        } else {
            return response()->json(['error' => 'Gaji tidak ditemukan untuk jabatan ini.'], 404);
        }
    }



    public function show(string $id)
    {
        $gaji_karyawan = GajiKaryawanModel::with(relations: 'karyawan.jabatan')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail gaji',
            'list'  => ['Home', 'gaji', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail gaji'
        ];

        $activeMenu = 'gaji-karyawan'; // set menu yang sedang aktif

        return view('admin.gaji-karyawan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'gaji_karyawan' => $gaji_karyawan, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $gaji_karyawan = GajiKaryawanModel::find($id);

        // Ambil data karyawan dengan relasi jabatan
        $karyawan = KaryawanModel::with('jabatan')->get();

        // Ambil data gaji
        $gaji = GajiModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Gaji Karyawan',
            'list'  => ['Home', 'Gaji Karyawan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Gaji Karyawan'
        ];

        $activeMenu = 'gaji_karyawan';

        return view('admin.gaji-karyawan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'gaji_karyawan' => $gaji_karyawan,
            'karyawan' => $karyawan,  // Gunakan variabel karyawan untuk relasi jabatan
            'gaji' => $gaji,
            'activeMenu' => $activeMenu
        ]);
    }



    public function update(Request $request, string $id)
    {
        $request->validate([
            'tgl_gaji' => 'required|date',
            'karyawan_id' => 'required|integer',
        ]);

        // Temukan karyawan yang dipilih
        $karyawan = KaryawanModel::with('jabatan')->find($request->karyawan_id);
        if (!$karyawan) {
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan.');
        }

        // Cari gaji berdasarkan jabatan karyawan
        $gaji = GajiModel::where('jabatan_id', $karyawan->jabatan_id)->first();
        if (!$gaji) {
            return redirect()->back()->with('error', 'Gaji untuk jabatan ini belum ditentukan.');
        }

        // Update data gaji karyawan
        GajiKaryawanModel::find($id)->update([
            'tgl_gaji' => $request->tgl_gaji,
            'karyawan_id' => $karyawan->id,
            'gaji_id' => $gaji->id,
        ]);

        return redirect('/gaji-karyawan')->with('success', 'Data gaji karyawan berhasil diubah');
    }


    public function destroy(string $id)
    {
        $check = GajiKaryawanModel::find($id);
        if (!$check) {
            return redirect('/gaji-karyawan')->with('error', 'Data gaji karyawan tidak ditemukan');
        }

        try {
            GajiKaryawanModel::destroy($id);   // Hapus data level

            return redirect('/gaji-karyawan')->with('success', 'Data gaji karyawan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/gaji-karyawan')->with('error', 'Data gaji gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

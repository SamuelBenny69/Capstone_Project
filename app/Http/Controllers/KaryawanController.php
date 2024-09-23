<?php
namespace App\Http\Controllers;

use App\Models\JabatanModel;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    //menampilkan halaman awal karyawan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Karyawan',
            'list'  => ['Home', 'karyawan']
        ];

        $page = (object) [
            'title' => 'Daftar karyawan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'karyawan'; // set menu yang sedang aktif
        return view('admin.karyawan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $karyawans = KaryawanModel::select('id', 'jabatan_id', 'nama', 'jkel', 'status')
                    ->with('jabatan');

        // Filter data karyawan berdasarkan jabatan_id

        return DataTables::of($karyawans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($gaji_karyawan) {
                $btn  = '<div class="dropdown d-inline-block">';
                $btn .= '<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown' . $gaji_karyawan->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $btn .= 'Aksi';
                $btn .= '</button>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="aksiDropdown' . $gaji_karyawan->id . '">';
                $btn .= '<a class="dropdown-item" href="' . url('/gaji-karyawan/' . $gaji_karyawan->id) . '">Detail</a>';
                $btn .= '<a class="dropdown-item" href="' . url('/gaji-karyawan/' . $gaji_karyawan->id . '/edit') . '">Edit</a>';
                $btn .= '<form class="dropdown-item d-inline-block" method="POST" action="' . url('/gaji-karyawan/' . $gaji_karyawan->id) . '" onsubmit="return confirm(\'Apakah Anda yakin menghapus data ini?\');">';
                $btn .= csrf_field() . method_field('DELETE');
                $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
                $btn .= '</form>';
                $btn .= '</div>';
                $btn .= '</div>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah karyawan',
            'list'  => ['Home', 'karyawan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah karyawan baru'
        ];

        $jabatan = JabatanModel::all();
        $activeMenu = 'karyawan';
        return view('admin.karyawan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jabatan' => $jabatan, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|integer',
            'nama' => 'required|string|',
            'jkel' => 'required|string|',
            'status' => 'required|min:5',
        ]);

        KaryawanModel::create([
            'jabatan_id' => $request->jabatan_id,
            'nama' => $request->nama,
            'jkel'     => $request->jkel,
            'status' => $request->status,
        ]);

        return redirect('/karyawan')->with('success', 'Data karyawan berhasil disimpan');
    }

    public function show(string $id)
    {
        $karyawan = KaryawanModel::with(relations: 'jabatan')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail karyawan',
            'list'  => ['Home', 'karyawan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail karyawan'
        ];

        $activeMenu = 'karyawan'; // set menu yang sedang aktif

        return view('admin.karyawan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'karyawan' => $karyawan, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $karyawan = KaryawanModel::find($id);
        $jabatan = JabatanModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Jabatan',
            'list'  => ['Home', 'Jabatan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit jabatan'
        ];

        $activeMenu = 'karyawan'; //set menu yang sedang aktif

        return view('admin.karyawan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'karyawan'=>$karyawan, 'jabatan' => $jabatan, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|',
            'jkel'     => 'required|string|',
            'status' => 'required|string|',
            'jabatan_id' => 'required|integer'
        ]);

        KaryawanModel::find($id)->update([
            'nama' => $request->nama,
            'jkel'     => $request->jkel,
            'status' => $request->status,
            'jabatan_id' => $request->jabatan_id
        ]);

        return redirect('/karyawan')->with('success', 'Data karyawan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = KaryawanModel::find($id);
        if (!$check) {
            return redirect('/karyawan')->with('error', 'Data karyawan tidak ditemukan');
        }

        try{
            KaryawanModel::destroy($id);   // Hapus data level

            return redirect('/karyawan')->with('success', 'Data karyawan berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/karyawan')->with('error', 'Data karyawan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

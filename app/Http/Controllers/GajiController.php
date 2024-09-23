<?php

namespace App\Http\Controllers;

use App\Models\GajiModel;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GajiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Gaji',
            'list'  => ['Admin', 'Gaji']
        ];

        $page = (object) [
            'title' => 'Daftar Gaji Jabatan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'gaji'; // set menu yang sedang aktif
        return view('admin.gaji.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $gajis = GajiModel::select('id', 'jabatan_id', 'gaji_pokok', 'tunjangan_hadir', 'tunjangan_keluarga', 'asuransi')
                    ->with('jabatan');

        // Filter data karyawan berdasarkan jabatan_id

        return DataTables::of($gajis)
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
            'title' => 'Tambah Gaji',
            'list'  => ['Admin', 'Gaji', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah gaji baru'
        ];

        $jabatan = JabatanModel::all();
        $activeMenu = 'gaji';
        return view('admin.gaji.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jabatan' => $jabatan, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|integer',
            'gaji_pokok' => 'required|int|',
            'tunjangan_hadir' => 'required|int|',
            'tunjangan_keluarga' => 'required|int|',
            'asuransi' => 'required|int|',
        ]);

        GajiModel::create([
            'jabatan_id' => $request->jabatan_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_hadir'     => $request->tunjangan_hadir,
            'tunjangan_keluarga' => $request->tunjangan_keluarga,
            'asuransi' => $request->asuransi,
        ]);

        return redirect('/gaji')->with('success', 'Data karyawan berhasil disimpan');
    }

    public function show(string $id)
    {
        $gaji = GajiModel::with(relations: 'jabatan')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail gaji',
            'list'  => ['Home', 'gaji', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail gaji'
        ];

        $activeMenu = 'gaji'; // set menu yang sedang aktif

        return view('admin.gaji.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'gaji' => $gaji, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $gaji = GajiModel::find($id);
        $jabatan = JabatanModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Gaji',
            'list'  => ['Home', 'Gaji', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Gaji'
        ];

        $activeMenu = 'gaji'; //set menu yang sedang aktif

        return view('admin.gaji.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'gaji'=>$gaji, 'jabatan' => $jabatan, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'jabatan_id' => 'required|integer',
            'gaji_pokok' => 'required|int|',
            'tunjangan_hadir' => 'required|int|',
            'tunjangan_keluarga' => 'required|int|',
            'asuransi' => 'required|int|',
        ]);

        GajiModel::find($id)->update([
            'jabatan_id' => $request->jabatan_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_hadir'     => $request->tunjangan_hadir,
            'tunjangan_keluarga' => $request->tunjangan_keluarga,
            'asuransi' => $request->asuransi,
        ]);

        return redirect('/gaji')->with('success', 'Data karyawan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = GajiModel::find($id);
        if (!$check) {
            return redirect('/gaji')->with('error', 'Data gaji tidak ditemukan');
        }

        try{
            GajiModel::destroy($id);   // Hapus data level

            return redirect('/gaji')->with('success', 'Data gaji berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/gaji')->with('error', 'Data gaji gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

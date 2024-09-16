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
            ->addColumn('aksi', function ($gaji) {
                $btn  = '<a href="'.url('/gaji/' . $gaji->id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/gaji/' . $gaji->id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/gaji/'.$gaji->id).'">'
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

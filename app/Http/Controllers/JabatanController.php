<?php

namespace App\Http\Controllers;

use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class JabatanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Jabatan',
            'list'  => ['Home', 'jabatan']
        ];

        $page = (object) [
            'title' => 'Daftar Jabatan'
        ];

        $activeMenu = 'jabatan'; // set menu yang sedang aktif

        return view('admin.jabatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $jabatan = JabatanModel::select('id', 'kode_jabatan', 'jabatan');

        return DataTables::of($jabatan)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($jabatan) {  // menambahkan kolom aksi
                $btn = '<a href="'.url('/jabatan/' . $jabatan->id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/jabatan/'.$jabatan->id).'">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
         $breadcrumb = (object) [
            'title' => 'Tambah jabatan',
            'list'  => ['Home', 'jabatan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah jabatan baru'
        ];

        $jabatan = JabatanModel::all(); // Ambil semua data jabatan
        $activeMenu = 'jabatan'; // Set menu yang sedang aktif

            return view('admin.jabatan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jabatan'=> $jabatan, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jabatan' => 'required|string|max:10|unique:jabatan,kode_jabatan',
            'jabatan' => 'required|string|max:100',
        ]);

        JabatanModel::create([
            'kode_jabatan' => $request->kode_jabatan,
            'jabatan' => $request->jabatan,
        ]);

        return redirect('/jabatan')->with('success', 'Data jabatan berhasil disimpan');
    }

    public function edit(string $id)
    {
        $jabatan = JabatanModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit jabatan',
            'list'  => ['Home', 'jabatan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit jabatan'
        ];
        $activeMenu = 'jabatan';
        return view('admin.jabatan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jabatan' => $jabatan,'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_jabatan' => 'required|string|min:3|max:10|unique:jabatan,kode_jabatan,'.$id.',id',
            'jabatan' => 'required|string|max:100', 
        ]);

        JabatanModel::find($id)->update([
            'kode_jabatan' => $request->kode_jabatan,
            'jabatan' => $request->jabatan
        ]);

        return redirect('/jabatan')->with('success', 'Data jabatan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = JabatanModel::find($id);
        if (!$check) {      // untuk mengecek apakah data jabatan dengan id yang dimaksud ada atau tidak
            return redirect('/jabatan')->with('error', 'Data jabatan tidak ditemukan');
        }

        try{
            JabatanModel::destroy($id);   // Hapus data jabatan

            return redirect('/jabatan')->with('success', 'Data jabatan berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            // Jika terjadi error ketika menghapus data jabatan, redirect kembali ke halaman jabatan dengan membawa pesan error
            return redirect('/jabatan')->with('error', 'Data jabatan gagal dihapus karena masih terdapat data pengguna yang terkait dengan jabatan ini');
        }
    }
}


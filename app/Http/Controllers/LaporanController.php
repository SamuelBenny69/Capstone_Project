<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index ()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar laporan',
            'list'  => ['Home', 'laporan']
        ];

        $page = (object) [
            'title' => 'Daftar laporan '
        ];

        $activeMenu = 'laporan'; // set menu yang sedang aktif
        return view('admin.laporan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function laporanGaji()
    {
        // Mengambil semua data gaji karyawan
        $gaji_karyawans = GajiKaryawanModel::with('karyawan.jabatan', 'gaji')->get();

        // Menghitung total gaji pokok
        $totalGaji = $gaji_karyawans->sum(function ($gaji_karyawan) {
            return $gaji_karyawan->gaji->gaji_pokok; // Asumsi 'gaji_pokok' ada di tabel gaji
        });

        // Menghitung total tunjangan kehadiran
        $totalTunjanganKehadiran = $gaji_karyawans->sum(function ($gaji_karyawan) {
            return $gaji_karyawan->gaji->tunjangan_kehadiran; // Asumsi 'tunjangan_kehadiran' ada di tabel gaji
        });

        // Menghitung total tunjangan keluarga
        $totalTunjanganKeluarga = $gaji_karyawans->sum(function ($gaji_karyawan) {
            return $gaji_karyawan->gaji->tunjangan_keluarga; // Asumsi 'tunjangan_keluarga' ada di tabel gaji
        });

        // Menghitung total asuransi
        $totalAsuransi = $gaji_karyawans->sum(function ($gaji_karyawan) {
            return $gaji_karyawan->gaji->asuransi; // Asumsi 'asuransi' ada di tabel gaji
        });

        // Mengirim data ke view
        return view('admin.laporan.laporan-gaji', compact('gaji_karyawans', 'totalGaji', 'totalTunjanganKehadiran', 'totalTunjanganKeluarga', 'totalAsuransi'));
    }

    public function laporanAbsens(){
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
            )->get();

        return view('admin.laporan.laporan-absens', data: compact('absens'));
    }

}

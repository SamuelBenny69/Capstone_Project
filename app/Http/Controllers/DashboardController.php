<?php

namespace App\Http\Controllers;

use App\Models\JabatanModel;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $jumKaryawan = KaryawanModel::count();
        $karyawanPria = KaryawanModel::where('jkel', 'L')->count();
        $karyawanWanita = KaryawanModel::where('jkel', 'P')->count();

        $jabatanAll = JabatanModel::all();


        $jobPositions = KaryawanModel::select('jabatan.jabatan', 'jkel', DB::raw('count(*) as total'))
            ->join('jabatan', 'karyawan.jabatan_id', '=', 'jabatan.id')
            ->groupBy('jabatan.jabatan', 'jkel')
            ->get();


        $labels = [];
        $maleData = [];
        $femaleData = [];

        foreach ($jobPositions->groupBy('jabatan') as $job => $group) {
            $labels[] = $job;
            $maleData[] = $group->where('jkel', 'L')->first()->total ?? 0;  
            $femaleData[] = $group->where('jkel', 'P')->first()->total ?? 0;
        }


        $activeMenu = 'dashboard';


        return view('dashboard', compact('activeMenu', 'jumKaryawan', 'karyawanPria', 'karyawanWanita', 'labels', 'maleData', 'femaleData', 'jabatanAll'));
    }
}


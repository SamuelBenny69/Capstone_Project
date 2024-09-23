<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'absens';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'karyawan_id',
        'tgl_absen',
        'ket'
    ];

    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, 'karyawan_id', 'id');
    }
}

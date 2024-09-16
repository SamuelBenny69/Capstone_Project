<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawanModel extends Model
{
    use HasFactory;
    protected $table = 'gaji_karyawan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'tgl_gaji',
        'karyawan_id',
        'gaji_id',
    ];

    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, 'karyawan_id', 'id');
    }
    public function gaji()
    {
        return $this->belongsTo(GajiModel::class, 'gaji_id', 'id');
    }
}

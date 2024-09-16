<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiModel extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'jabatan_id',
        'gaji_pokok',
        'tunjangan_hadir',
        'tunjangan_keluarga',
        'asuransi',
    ];

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'jabatan_id', 'id');
    }
}

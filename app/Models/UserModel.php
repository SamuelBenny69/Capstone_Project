<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // implementasi class Authenticatable


class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'karyawan_id',
        'email',
        'password'
    ];

    protected $hidden = [
        'password', // jangan di tampilkan saat select
        ];
        protected $casts = [
        'password' => 'hashed', // casting password agar otomatis di hash
        ];
}

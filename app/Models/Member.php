<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'paket',
        'masa_aktif',
        'foto',
        'qr_code',
    ];

    protected $casts = [
        'masa_aktif' => 'date',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
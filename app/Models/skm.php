<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skm extends Model
{
    protected $fillable = [
        'opd_id',
        'unit_kerja',
        'total_responden',
        'total_skor',
        'grade',
        'keterangan',
        'jk_pria',
        'jk_wanita',
        'pendidikan',
        'pekerjaan',
        'periode_survey',
    ];

    protected $casts = [
        'pendidikan' => 'array',
        'pekerjaan' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'hasil_kerja',
        'perilaku',
        'kinerja',
    ];
}

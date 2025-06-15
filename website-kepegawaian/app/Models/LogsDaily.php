<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsDaily extends Model
{
    use HasFactory;

    protected $table = 'logs_daily';

    protected $fillable = [
        'nip',
        'log_detail',
        'log_status',
    ];

    /**
     * Relasi ke model User (berdasarkan kolom NIP).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }
}

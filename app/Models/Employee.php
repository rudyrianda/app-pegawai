<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email', 
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'departemen_id',
        'jabatan_id',
        'status'
    ];

    /**
     * Relasi ke model Department
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    /**
     * Relasi ke model Position
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}
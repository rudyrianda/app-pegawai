<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['nama_departemen'];

    /**
     * Relasi ke model Employee
     * Pastikan nama kolom foreign key sesuai dengan migration
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}
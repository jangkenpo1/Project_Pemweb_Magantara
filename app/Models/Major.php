<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Major extends Model
{
    protected $fillable = ['name'];

    public function mahasiswas(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function lowongans(): BelongsToMany
    {
        return $this->belongsToMany(Lowongan::class, 'lowongan_major');
    }
}

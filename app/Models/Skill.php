<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $fillable = ['name'];

    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_skill');
    }

    public function lowongans(): BelongsToMany
    {
        return $this->belongsToMany(Lowongan::class, 'lowongan_skill');
    }
}

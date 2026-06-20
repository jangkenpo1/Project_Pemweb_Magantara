<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Industry extends Model
{
    protected $fillable = ['name'];

    public function perusahaans(): HasMany
    {
        return $this->hasMany(Perusahaan::class);
    }
}

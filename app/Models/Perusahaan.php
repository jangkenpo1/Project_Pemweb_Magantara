<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Perusahaan extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'industry_id', 'status_verification', 'verification_notes',
        'website_url', 'logo', 'description', 'legal_document_path',
        'employee_scale', 'office_address',
        'province_id', 'city_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function lowongans(): HasMany
    {
        return $this->hasMany(Lowongan::class);
    }

    public function isVerified(): bool
    {
        return $this->status_verification === 'verified';
    }

    public function isPending(): bool
    {
        return $this->status_verification === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status_verification === 'rejected';
    }

    public function isUnverified(): bool
    {
        return $this->status_verification === 'unverified';
    }

    public function notifikasis(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Notifikasi::class, 'notifiable');
    }
}

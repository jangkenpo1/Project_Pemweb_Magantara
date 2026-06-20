<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lowongan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'perusahaan_id', 'title', 'description', 'responsibilities',
        'qualifications', 'benefits', 'work_system', 'payment_type',
        'duration_months', 'quota', 'deadline', 'status',
        'province_id', 'city_id', 'address', 'gmaps_url',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
        ];
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'lowongan_skill');
    }

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class, 'lowongan_major');
    }

    public function lamarans(): HasMany
    {
        return $this->hasMany(Lamaran::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getWorkSystemLabelAttribute(): string
    {
        return match($this->work_system) {
            'remote' => 'Remote',
            'hybrid' => 'Hybrid',
            'onsite' => 'On-Site',
            default => $this->work_system,
        };
    }

    public function getPaymentTypeLabelAttribute(): string
    {
        return match($this->payment_type) {
            'paid' => 'Paid',
            'unpaid' => 'Unpaid',
            default => $this->payment_type,
        };
    }
}

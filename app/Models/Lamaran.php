<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lamaran extends Model
{
    protected $fillable = [
        'mahasiswa_id', 'lowongan_id', 'cv_snapshot_path',
        'portfolio_url', 'cover_letter', 'status', 'recruiter_notes',
        'interview_date', 'interview_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'interview_date' => 'datetime',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'dikirim'    => 'Dikirim',
            'dilihat'    => 'Sedang Ditinjau',
            'seleksi'    => 'Seleksi',
            'interview'  => 'Interview',
            'diterima'   => 'Diterima',
            'ditolak'    => 'Ditolak',
            'dibatalkan' => 'Dibatalkan',
            default      => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'dikirim'    => 'sky-wash',
            'dilihat'    => 'sky-wash',
            'seleksi'    => 'apricot-wash',
            'interview'  => 'apricot-wash',
            'diterima'   => 'green',
            'ditolak'    => 'red',
            'dibatalkan' => 'grey',
            default      => 'grey',
        };
    }
}

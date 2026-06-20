<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar',
        'university_id', 'major_id', 'semester',
        'bio', 'experience', 'cv_path',
        'portfolio_url', 'linkedin_url', 'github_url',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'mahasiswa_skill');
    }

    public function lamarans(): HasMany
    {
        return $this->hasMany(Lamaran::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedLowongans(): BelongsToMany
    {
        return $this->belongsToMany(Lowongan::class, 'bookmarks')->withTimestamps();
    }

    public function notifikasis(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Notifikasi::class, 'notifiable');
    }

    /**
     * Hitung Skill Match Percentage terhadap sebuah lowongan.
     */
    public function skillMatchPercentage(Lowongan $lowongan): int
    {
        $mySkillIds = $this->skills()->pluck('skills.id')->toArray();
        $requiredSkillIds = $lowongan->skills()->pluck('skills.id')->toArray();

        if (empty($requiredSkillIds)) {
            return 0;
        }

        $matched = count(array_intersect($mySkillIds, $requiredSkillIds));
        return (int) round(($matched / count($requiredSkillIds)) * 100);
    }
}

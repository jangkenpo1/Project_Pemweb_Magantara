<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notifikasi extends Model
{
    protected $fillable = ['judul', 'isi', 'url', 'status'];

    protected $table = 'notifikasis';

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public function markAsRead(): void
    {
        $this->update(['status' => 'dibaca']);
    }
}

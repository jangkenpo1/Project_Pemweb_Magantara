<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Lowongan;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Auto-close lowongan yang sudah melewati deadline
Schedule::call(function () {
    Lowongan::where('status', 'published')
        ->where('deadline', '<', Carbon::today())
        ->update(['status' => 'closed']);
})->daily();

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            $table->string('cv_snapshot_path');
            $table->string('portfolio_url')->nullable();
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['dikirim', 'dilihat', 'seleksi', 'interview', 'diterima', 'ditolak', 'dibatalkan'])->default('dikirim');
            $table->text('recruiter_notes')->nullable();
            $table->unique(['mahasiswa_id', 'lowongan_id']); // satu mahasiswa satu lamaran per lowongan
            $table->timestamps();
        });

        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            $table->unique(['mahasiswa_id', 'lowongan_id']);
            $table->timestamps();
        });

        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->morphs('notifiable'); // polymorphic: mahasiswas or perusahaans
            $table->string('judul');
            $table->text('isi');
            $table->string('url')->nullable();
            $table->enum('status', ['belum_dibaca', 'dibaca'])->default('belum_dibaca');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
        Schema::dropIfExists('bookmarks');
        Schema::dropIfExists('lamarans');
    }
};

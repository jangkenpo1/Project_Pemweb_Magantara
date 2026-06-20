<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('responsibilities')->nullable();
            $table->text('qualifications')->nullable();
            $table->text('benefits')->nullable();
            $table->enum('work_system', ['remote', 'hybrid', 'onsite']);
            $table->enum('payment_type', ['paid', 'unpaid']);
            $table->integer('duration_months'); // 1,2,3,6
            $table->integer('quota')->default(1);
            $table->date('deadline');
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            // Location
            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->text('address')->nullable();
            $table->string('gmaps_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Pivot: lowongan <-> major
        Schema::create('lowongan_major', function (Blueprint $table) {
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->primary(['lowongan_id', 'major_id']);
        });

        // Pivot: lowongan <-> skill
        Schema::create('lowongan_skill', function (Blueprint $table) {
            $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->primary(['lowongan_id', 'skill_id']);
        });

        // Pivot: mahasiswa <-> skill
        Schema::create('mahasiswa_skill', function (Blueprint $table) {
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->primary(['mahasiswa_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_skill');
        Schema::dropIfExists('lowongan_skill');
        Schema::dropIfExists('lowongan_major');
        Schema::dropIfExists('lowongans');
    }
};

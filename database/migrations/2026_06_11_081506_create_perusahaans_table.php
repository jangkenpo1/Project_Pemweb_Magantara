<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('industry_id')->nullable()->constrained('industries')->nullOnDelete();
            $table->enum('status_verification', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('website_url')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('employee_scale')->nullable(); // e.g. "1-50", "51-200"
            $table->text('office_address')->nullable();
            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};

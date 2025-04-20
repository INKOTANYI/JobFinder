<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('cv_path')->nullable();
            $table->string('degree_path')->nullable();
            $table->string('id_passport_path')->nullable();
            $table->text('motivation')->nullable();
            $table->integer('experience_years')->nullable();
            $table->foreignId('province_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('sector_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

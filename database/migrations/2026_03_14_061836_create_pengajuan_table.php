<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users dan videos (jika data induk dihapus, riwayat ini ikut terhapus)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('konten_id')->constrained('kontens')->onDelete('cascade');
            
            // Status pengajuan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // Waktu kedaluwarsa (Kunci dari soal tes)
            $table->timestamp('expired_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
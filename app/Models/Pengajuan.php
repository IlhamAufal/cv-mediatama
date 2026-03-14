<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    // Menghindari error nama tabel plural dari Laravel
    protected $table = 'pengajuan';

    protected $fillable = [
        'user_id',
        'konten_id',
        'status',
        'expired_at',
    ];

    // Ubah format string dari database menjadi object waktu (Carbon)
    protected $casts = [
        'expired_at' => 'datetime',
    ];

    // --- RELASI DATABASE ---

    // 1 Akses dimiliki oleh 1 User (Customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 Akses tertuju pada 1 Video
    public function konten()
    {
        return $this->belongsTo(Konten::class);
    }

    // --- FUNGSI HELPER (Nilai Plus untuk Anda!) ---

    // Fungsi untuk mengecek dengan cepat apakah akses ini masih bisa dipakai nonton
    public function isValid()
    {
        return $this->status === 'approved' &&
               $this->expired_at &&
               $this->expired_at->isFuture(); // ngecek apakah expired_at masih di masa depan
    }
}

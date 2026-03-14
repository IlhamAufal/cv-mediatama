<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Admin: Daftar semua pengajuan akses konten.
     */
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'konten'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->paginate(10)->withQueryString();

        return view('pages.admin.konten.request', compact('pengajuans'));
    }

    /**
     * Customer: Kirim pengajuan akses untuk konten tertentu.
     */
    public function store(Request $request, Konten $konten)
    {
        $userId = auth()->id();

        // Cek duplikat: sudah ada pengajuan pending atau approved yang masih aktif
        $existing = Pengajuan::where('user_id', $userId)
            ->where('konten_id', $konten->id)
            ->where(function ($q) {
                $q->where('status', 'pending')
                  ->orWhere(function ($q2) {
                      $q2->where('status', 'approved')
                         ->where('expired_at', '>', now());
                  });
            })
            ->exists();

        if ($existing) {
            return back()->with('error', 'Anda sudah memiliki pengajuan aktif untuk konten ini.');
        }

        Pengajuan::create([
            'user_id' => $userId,
            'konten_id' => $konten->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan akses berhasil dikirim!');
    }

    /**
     * Admin: Approve pengajuan dan set tanggal expired.
     */
    public function approve(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'expired_at' => 'required|date|after:now',
        ], [
            'expired_at.required' => 'Tanggal expired wajib diisi.',
            'expired_at.date' => 'Format tanggal tidak valid.',
            'expired_at.after' => 'Tanggal expired harus di masa depan.',
        ]);

        $pengajuan->update([
            'status' => 'approved',
            'expired_at' => $request->expired_at,
        ]);

        return back()->with('success', 'Pengajuan berhasil di-approve!');
    }

    /**
     * Admin: Reject pengajuan.
     */
    public function reject(Pengajuan $pengajuan)
    {
        $pengajuan->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak.');
    }

    /**
     * Customer: Lihat riwayat pengajuan milik sendiri.
     */
    public function riwayatPengajuan()
    {
        $pengajuans = Pengajuan::with('konten')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pages.customer.riwayat-pengajuan', compact('pengajuans'));
    }
}

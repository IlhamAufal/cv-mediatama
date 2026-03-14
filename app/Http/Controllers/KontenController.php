<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontens = Konten::latest()->paginate(10);
        return view('pages.admin.konten.index', compact('kontens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.konten.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|mimes:mp4,webm,mkv,avi,mov|max:102400', // Max 100MB
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('konten', $fileName, 'public');
            $data['file_path'] = $path;
        }

        Konten::create($data);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Konten $konten)
    {
        return view('pages.admin.konten.show', compact('konten'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konten $konten)
    {
        return view('pages.admin.konten.edit', compact('konten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konten $konten)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:mp4,webm,mkv,avi,mov|max:102400', // Max 100MB
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('file_path')) {
            // Delete old file if exists
            if ($konten->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($konten->file_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($konten->file_path);
            }

            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('konten', $fileName, 'public');
            $data['file_path'] = $path;
        }

        $konten->update($data);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konten $konten)
    {
        if ($konten->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($konten->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($konten->file_path);
        }
        $konten->delete();
        return redirect()->route('konten.index')->with('success', 'Konten berhasil dihapus!');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $table = 'kontens';
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'thumbnail_path',
    ];

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}

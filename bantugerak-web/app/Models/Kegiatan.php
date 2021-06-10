<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';
    protected $primaryKey = 'id';
    // public $timestamps = true;

    protected $fillable = [
        'nama_kegiatan',
        'foto_kegiatan',
        'deskripsi_kegiatan',
        'tanggal_kegiatan',
    ];
}

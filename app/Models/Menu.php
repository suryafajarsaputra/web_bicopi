<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // Sesuaikan dengan nama tabel di database

    protected $primaryKey = 'id_menu'; // Set primary key sesuai tabel

    public $incrementing = false; // UUID bukan auto-increment

    protected $keyType = 'string'; // UUID adalah string

    public $timestamps = false; // Matikan timestamps karena tidak ada updated_at

    protected $fillable = [
        'id_menu',
        'nama_menu',
        'foto_menu',
        'deskripsi_menu',
        'harga_menu',
        'id_kategori_menu',
    ];

    // Boot method untuk otomatis mengisi id_menu dengan UUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_menu)) {
                $model->id_menu = Str::uuid(); // Set UUID otomatis
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // Nama tabel di database

    protected $primaryKey = 'id_menu'; // Primary key yang digunakan

    public $incrementing = false; // Karena menggunakan UUID

    protected $keyType = 'string'; // UUID adalah string

    public $timestamps = false; // Tidak pakai created_at dan updated_at

    protected $fillable = [
        'id_menu',
        'nama_menu',
        'foto_menu',
        'deskripsi_menu',
        'harga_menu',
        'id_kategori_menu',
    ];

    /**
     * Saat model dibuat, isi otomatis UUID jika belum ada.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_menu)) {
                $model->id_menu = (string) Str::uuid(); // Isi UUID otomatis
            }
        });
    }

    /**
     * Relasi ke tabel kategori_menu.
     * Setiap menu punya satu kategori.
     */
    public function kategori()
{
    return $this->belongsTo(KategoriMenu::class, 'id_kategori_menu');
}

}

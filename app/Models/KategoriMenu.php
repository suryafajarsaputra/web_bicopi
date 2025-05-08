<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dari plural nama model
    protected $table = 'kategori_menu';

    // Primary key custom
    protected $primaryKey = 'id_kategori_menu';

    // Jika tidak menggunakan timestamps (created_at & updated_at)
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = ['kategori'];

    // Relasi ke menu
    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_kategori_menu');
    }
}

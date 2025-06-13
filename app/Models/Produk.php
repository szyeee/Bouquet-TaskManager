<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',           // nama produk
        'harga',          // harga produk (integer/decimal)
        'kategori_id',    // foreign key ke kategori
        'stok',           // jumlah stok produk
        'deskripsi',      // deskripsi produk (opsional)
        'foto',
        'tipe_stok',         // path atau nama file gambar produk (opsional)
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    // Relasi Pesanan
    public function daftarPesanan()
    {
        return $this->hasMany(Pesanan::class, 'produk_id', 'id');
    }
}

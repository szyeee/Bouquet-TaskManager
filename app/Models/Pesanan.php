<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Pengiriman;
use App\Models\User;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'nama_pembeli',
        'produk_id',
        'status',
        'jumlah',
        'harga',
        'jumlah_harga',
        'kode_pesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'pesanan_id', 'id');
    }

    protected static function booted()
    {
        // Generate kode pesanan
        static::creating(function ($pesanan) {
            $lastCode   = static::orderBy('id', 'desc')->first()?->kode_pesanan;
            $lastNumber = $lastCode ? (int) substr($lastCode, 3) : 0;
            $newNumber  = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $pesanan->kode_pesanan = 'PSN' . $newNumber;
        });

        // Kurangi stok setelah create
        static::created(function ($pesanan) {
            $pesanan->produk->decrement('stok', $pesanan->jumlah);
        });

        // Sesuaikan stok saat update
        static::updating(function ($pesanan) {
            // Stok pada produk lama direstorasi
            $originalProduk = static::find($pesanan->id);
            if ($originalProduk->produk_id !== $pesanan->produk_id) {
                // restore stok lama
                $originalProduk->produk->increment('stok', $originalProduk->jumlah);
            }
        });

        static::updated(function ($pesanan) {
            // Jika produk_id berubah atau jumlah berubah, hitung diferensinya
            $original = $pesanan->getOriginal();

            // Stok restore dan decrement untuk produk baru
            if ($original['produk_id'] !== $pesanan->produk_id) {
                // setelah restorasi di updating, kurangi stok produk baru
                $pesanan->produk->decrement('stok', $pesanan->jumlah);
            } elseif ($pesanan->wasChanged('jumlah')) {
                // jika hanya jumlah berubah, sesuaikan selisih
                $diff = $pesanan->jumlah - $original['jumlah'];
                if ($diff > 0) {
                    $pesanan->produk->decrement('stok', $diff);
                } elseif ($diff < 0) {
                    $pesanan->produk->increment('stok', abs($diff));
                }
            }
        });

        // Restitusi stok saat delete
        static::deleted(function ($pesanan) {
            $pesanan->produk->increment('stok', $pesanan->jumlah);
        });
    }
}
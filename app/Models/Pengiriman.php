<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'pesanan_id',
        'kurir',         // tetap bisa disimpan tapi optional
        'no_resi',       // optional
        'status',
        'alamat',        // ditambahkan
    ];
    
    protected $casts = [
    'tanggal_kirim' => 'datetime',
    ];


    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class,'pesanan_id', 'id');
    }
}

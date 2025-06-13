<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Pengiriman;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'label' => 'Total Produk',
                'count' => Produk::count(),
                'color' => '#e0218a',
                'target' => 100,
                'trend_labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
                'trend_data' => [20, 30, 50, 60], // Ganti dengan data real jika ada
            ],
            [
                'label' => 'Total Pesanan',
                'count' => Pesanan::count(),
                'color' => '#d81b60',
                'target' => 50,
                'trend_labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
                'trend_data' => [5, 15, 25, 40],
            ],
            [
                'label' => 'Total Kategori',
                'count' => Kategori::count(),
                'color' => '#c2185b',
                'target' => 20,
                'trend_labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
                'trend_data' => [3, 5, 7, 10],
            ],
            [
                'label' => 'Total Pengiriman',
                'count' => Pengiriman::count(),
                'color' => '#ad1457',
                'target' => 30,
                'trend_labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
                'trend_data' => [2, 4, 6, 8],
            ],
        ];

        return view('dashboard', compact('stats'));
    }
}

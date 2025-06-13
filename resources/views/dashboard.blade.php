@extends('layouts.app')

@section('content')
{{-- Banner --}}
<div class="relative h-28 md:h-36 lg:h-40 w-full bg-cover bg-center rounded-2xl overflow-hidden shadow mb-6"
     style="background-image: url('{{ asset('images/Rose.jpeg') }}');">
  <div class="absolute inset-0 bg-black/20"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">La vie' en rose</h2>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden">
  {{-- Header --}}
  <div class="bg-rose-50 p-6 flex items-center justify-between">
    <div>
      <h1 class="text-4xl font-semibold text-gray-800">Hello, {{ Auth::user()->name }}!</h1>
      <p class="text-gray-600 mt-1">Welcome to your Dashboard</p>
    </div>
    <div class="text-gray-500 text-sm">
      {{ now()->format('l, d F Y') }}
    </div>
  </div>

  {{-- Statistik --}}
  <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($stats as $stat)
      <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm hover:shadow transition">
        <div class="flex items-center space-x-4">
          <div class="p-3 bg-rose-100 text-rose-600 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stat['count'] ?? 0 }}</p>
          </div>
        </div>
        <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
          @php($pct = min(100, $stat['count'] / $stat['target'] * 100))
          <div class="h-2 rounded-full" style="width:{{ $pct }}%; background: {{ $stat['color'] ?? '#f9a8d4' }}"></div>
        </div>
        <canvas id="chart-{{ Str::slug($stat['label']) }}" class="w-full h-10 mt-2"></canvas>
      </div>
    @endforeach
  </div>

  {{-- Recent Orders --}}
  <div class="mt-8 px-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Recent Orders</h3>
    <ul class="space-y-2">
      @foreach(App\Models\Pesanan::latest()->take(3)->get() as $order)
        <li class="p-3 bg-gray-50 rounded-lg flex justify-between items-center">
          <span class="text-sm text-gray-700">{{ $order->kode_pesanan }} - {{ Str::limit($order->nama_pembeli, 15) }}</span>
          <span class="text-sm font-medium text-rose-500">Qty: {{ $order->jumlah }}</span>
        </li>
      @endforeach
    </ul>
  </div>

  {{-- Low Stock Alerts --}}
  @php($low = App\Models\Produk::where('stok','<',1)->get())
  @if($low->count())
    <div class="mt-6 px-6">
      <div class="p-4 bg-pink-50 border border-pink-200 rounded">
        <h4 class="font-semibold text-gray-800">Low Stock Alerts</h4>
        <ul class="list-disc list-inside text-sm text-gray-700 mt-2">
          @foreach($low as $p)
            <li>{{ $p->nama }} ({{ $p->stok }})</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  {{-- Quick Links --}}
  <div class="mt-8 p-6 bg-gray-50 rounded-2xl">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Links</h2>
    <div class="flex flex-col md:flex-row gap-4">
      <a href="{{ route('produk.index') }}" class="flex-1 text-center py-3 bg-rose-400 hover:bg-rose-500 text-white text-sm rounded-2xl transition">Kelola Produk</a>
      <a href="{{ route('pesanan.index') }}" class="flex-1 text-center py-3 bg-purple-300 hover:bg-purple-400 text-white text-sm rounded-2xl transition">Kelola Pesanan</a>
      <a href="{{ route('kategori.index') }}" class="flex-1 text-center py-3 bg-pink-300 hover:bg-pink-400 text-white text-sm rounded-2xl transition">Kelola Kategori</a>
      <a href="{{ route('pengiriman.index') }}" class="flex-1 text-center py-3 bg-rose-500 hover:bg-rose-600 text-white text-sm rounded-2xl transition">Kelola Pengiriman</a>
    </div>
  </div>
</div>
@endsection

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    @foreach($stats as $stat)
      new Chart(document.getElementById('chart-{{ Str::slug($stat['label']) }}'), {
        type: 'line',
        data: {
          labels: {!! json_encode($stat['trend_labels']) !!},
          datasets: [{
            data: {!! json_encode($stat['trend_data']) !!},
            borderColor: '{{ $stat['color'] ?? "#f472b6" }}',
            fill: false,
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          scales: {
            x: { display: false },
            y: { display: false }
          },
          elements: {
            point: { radius: 0 }
          },
          plugins: {
            legend: { display: false }
          }
        }
      });
    @endforeach
  });
</script>

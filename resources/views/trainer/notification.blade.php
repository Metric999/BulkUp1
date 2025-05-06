@extends('layouts.trainer')

@section('title', 'BulkUp - Notifikasi')

@section('content')
<div class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
  
  <!-- Notifikasi -->
  <div class="bg-white shadow-md rounded-xl p-6">
    <h2 class="text-2xl font-semibold mb-6">🔔 Notifikasi</h2>
    
    <div class="space-y-4">
      <div class="border-l-4 border-green-500 bg-gray-50 p-4 rounded-lg">
        <small class="text-sm text-gray-500 block">{{ $pengaturan['waktu_sarapan'] }}</small>
        <h4 class="font-bold text-lg mt-1">🍽️ Waktunya Sarapan!</h4>
        <p class="text-gray-700">Jangan lupa makan protein untuk mulai harimu.</p>
      </div>

      <div class="border-l-4 border-green-500 bg-gray-50 p-4 rounded-lg">
        <small class="text-sm text-gray-500 block">{{ $pengaturan['waktu_makan_siang'] }}</small>
        <h4 class="font-bold text-lg mt-1">🍗 Waktunya Makan Siang!</h4>
        <p class="text-gray-700">Nasi + ayam + sayur buat energi!</p>
      </div>

      <div class="border-l-4 border-green-500 bg-gray-50 p-4 rounded-lg">
        <small class="text-sm text-gray-500 block">{{ $pengaturan['waktu_tidur'] }}</small>
        <h4 class="font-bold text-lg mt-1">😴 Saatnya Tidur!</h4>
        <p class="text-gray-700">Recovery itu penting, bro!</p>
      </div>
    </div>
  </div>

  <!-- Pengaturan -->
  <div class="bg-white shadow-md rounded-xl p-6">
    <h2 class="text-2xl font-semibold mb-6">⚙️ Pengaturan Notif</h2>
    
    @if (session('message'))
      <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('message') }}
      </div>
    @endif

    <form method="POST" action="{{ route('trainer.notification.update') }}" class="space-y-5">
      @csrf

      <div>
        <label class="flex items-center space-x-3 text-gray-800 font-medium">
          <input type="checkbox" name="sarapan" class="accent-green-600" {{ $pengaturan['sarapan'] === 'on' ? 'checked' : '' }}>
          <span>Sarapan</span>
        </label>
        <input type="time" name="waktu_sarapan" value="{{ $pengaturan['waktu_sarapan'] }}" class="mt-1 border border-gray-300 rounded-md px-3 py-2 w-full max-w-xs">
      </div>

      <div>
        <label class="flex items-center space-x-3 text-gray-800 font-medium">
          <input type="checkbox" name="makan_siang" class="accent-green-600" {{ $pengaturan['makan_siang'] === 'on' ? 'checked' : '' }}>
          <span>Makan Siang</span>
        </label>
        <input type="time" name="waktu_makan_siang" value="{{ $pengaturan['waktu_makan_siang'] }}" class="mt-1 border border-gray-300 rounded-md px-3 py-2 w-full max-w-xs">
      </div>

      <div>
        <label class="flex items-center space-x-3 text-gray-800 font-medium">
          <input type="checkbox" name="tidur" class="accent-green-600" {{ $pengaturan['tidur'] === 'on' ? 'checked' : '' }}>
          <span>Tidur</span>
        </label>
        <input type="time" name="waktu_tidur" value="{{ $pengaturan['waktu_tidur'] }}" class="mt-1 border border-gray-300 rounded-md px-3 py-2 w-full max-w-xs">
      </div>

      <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
        Simpan
      </button>
    </form>
  </div>
</div>
@endsection

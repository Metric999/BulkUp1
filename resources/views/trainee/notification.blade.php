@extends('layouts.trainee')

@section('title', 'Reminder')

@section('content')
<div class="min-h-screen w-full bg-gray-100 py-8 px-6">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b flex justify-between items-center bg-blue-50">
            <h2 class="text-2xl font-bold text-gray-800">🔔 Reminder</h2>
        </div>
        <!-- Isi Notifikasi -->
        <div class="divide-y divide-gray-200">
            @forelse ($notifications as $notification)
                <div class="flex items-start p-6 hover:bg-gray-50 transition">
                    <!-- Icon Bulat -->
                    <div class="mr-4">
                        <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">
                            {{ strtoupper(substr($notification->judul, 0, 1)) }}
                        </div>
                    </div>
                    <!-- Konten Notifikasi -->
                    <div class="flex-1">
                        <p class="text-gray-800 mb-1 text-sm leading-snug">
                            <span class="font-semibold">{{ $notification->judul }}</span><br>
                            {{ $notification->pesan }}
                        </p>
                        <small class="text-gray-500 text-xs">
                            {{ \Carbon\Carbon::parse($notification->tanggal)->diffForHumans() }}
                        </small>
                    </div>
                    <!-- Titik Biru (Unread) -->
                    <div class="ml-3 mt-1">
                        <span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span>
                    </div>
                </div>
            @empty
                <div class="p-6 text-gray-500 text-center">
                    No Notifications.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

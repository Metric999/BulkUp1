@extends('layouts.trainee')

@section('title', 'Notification History')

@section('content')
<div class="bg-rose-50 min-h-screen py-10 px-4 font-sans">
  <div class="max-w-3xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">📜 Notification History</h2>

    <div class="space-y-5">
      @foreach ($notification_history as $notif)
        <div class="bg-white shadow-md rounded-xl p-5 border-l-4 border-green-500">
          <time class="text-sm text-gray-500 block mb-1">{{ \Carbon\Carbon::parse($notif['datetime'])->format('F d, Y, H:i') }}</time>
          <h4 class="text-lg font-semibold text-gray-800">{{ $notif['title'] }}</h4>
          <p class="text-gray-700">{{ $notif['message'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
  function toggleDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('hidden');
  }
</script>
@endsection

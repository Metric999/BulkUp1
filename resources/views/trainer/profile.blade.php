@extends('layouts.trainer')

@section('title', 'Trainer Profile - BulkUp')

@section('content')
<main class="flex justify-center items-center py-16 px-4 bg-gray-100 min-h-screen">
  <div class="w-full max-w-3xl bg-white p-8 rounded-xl shadow-lg border border-gray-300 text-gray-800">
    <div class="flex items-center space-x-6">
      <img src="{{ $photo ? asset('storage/' . $photo) : asset('uploads/default.png') }}" alt="Trainer Photo"
           class="w-28 h-28 rounded-full border-2 border-blue-500 shadow-md object-cover" />
      <div>
        <h2 class="text-3xl font-bold">{{ $trainerName }}</h2>
        <p class="text-gray-600">Gender: {{ $gender }}</p>
        <p class="text-gray-600">Age: {{ $dob }}</p>
        <p class="text-gray-600">Height: {{ $height }} cm</p>
        <p class="text-gray-600">Weight: {{ $weight }} kg</p>
      </div>
    </div>

    <div class="mt-8 space-y-4">
      <div class="flex items-center">
        <span class="w-40 font-semibold text-gray-700">Email:</span>
        <span>{{ $email }}</span>
      </div>
      <div class="flex items-start">
        <span class="w-40 font-semibold text-gray-700">About Me:</span>
        <p>{{ $about ?? '-' }}</p>
      </div>
    </div>

    <div class="mt-6 text-right">
      <a href="{{ route('trainer.profile.complete') }}"
         class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">
         Edit Profile
      </a>
    </div>
  </div>
</main>
@endsection

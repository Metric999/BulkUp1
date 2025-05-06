@extends('layouts.trainer')

@section('title', 'Trainer Profile - BulkUp')

@section('content')
<main class="flex justify-center items-center py-16 px-4">
  <div class="w-full max-w-3xl bg-white p-8 rounded-xl shadow-lg border border-gray-300">
    <div class="flex items-center space-x-6">
      <img src="https://via.placeholder.com/120" alt="Trainer Photo" class="w-28 h-28 rounded-full border-2 border-blue-500 shadow-md">
      <div>
        <h2 class="text-3xl font-bold text-gray-800">{{ $trainerName }}</h2>
        <p class="text-gray-600">{{ $specialty }}</p>
      </div>
    </div>

    <div class="mt-8 space-y-4">
      <div class="flex items-center">
        <span class="w-40 font-semibold text-gray-700">Email:</span>
        <span class="text-gray-800">{{ $email }}</span>
      </div>
      <div class="flex items-center">
        <span class="w-40 font-semibold text-gray-700">Phone:</span>
        <span class="text-gray-800">{{ $phone }}</span>
      </div>
      <div class="flex items-start">
        <span class="w-40 font-semibold text-gray-700">Bio:</span>
        <p class="text-gray-800">{{ $bio }}</p>
      </div>
    </div>

    <div class="mt-6 text-right">
      <a href="{{ route('trainer.profile.edit') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">Edit Profile</a>
    </div>
  </div>
</main>
@endsection

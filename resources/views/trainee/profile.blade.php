@extends('layouts.trainee')

@section('title', 'User Profile')

@section('content')
<body class="bg-gradient-to-br from-blue-50 to-white min-h-screen font-sans">
  <div class="max-w-4xl mx-auto p-6">
    <!-- Profile Header -->
    <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row items-center gap-6 relative">
      <div class="relative">
        <img src="{{ asset('uploads/user_photo.jpg') }}" alt="Profile Photo" class="w-32 h-32 rounded-full border-4 border-blue-500 object-cover">
        <label for="upload-photo" class="absolute bottom-0 right-0 bg-blue-600 text-white text-xs px-2 py-1 rounded-full cursor-pointer hover:bg-blue-700 transition">
          Change
        </label>
        <input type="file" id="upload-photo" class="hidden" accept="image/*">
      </div>
      <div class="flex-1">
      <h2 class="text-3xl font-bold text-gray-800">{{ $user->username }}</h2>

      <div class="mt-4 grid grid-cols-2 gap-4 text-sm text-gray-700">
        <p><span class="font-semibold">Name:</span> {{ $profile->name }}</p>
        <p><span class="font-semibold">Gender:</span> {{ $profile->gender }}</p>
        <p><span class="font-semibold">Age:</span> {{ $profile->age }}</p>
        <p><span class="font-semibold">Height:</span> {{ $profile->height }} cm</p>
        <p><span class="font-semibold">Weight:</span> {{ $profile->weight }} kg</p>
        <p><span class="font-semibold">Trainer:</span> {{ $profile->trainer_name ?? 'Belum ditentukan' }}</p>
      </div>


        <div class="mt-6">
          <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
            Edit Profile
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
@endsection

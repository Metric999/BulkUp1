@extends('layouts.trainer')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-4">
  <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Trainer Profile</h2>

    <div class="flex flex-col sm:flex-row items-center gap-6">
      <div class="flex-shrink-0">
        <img src="{{ asset('storage/' . $photo) }}" alt="Profile Photo"
          class="w-32 h-32 rounded-full object-cover border-4 border-blue-100 shadow-md" />
      </div>
      <div class="text-center sm:text-left">
        <h3 class="text-2xl font-semibold text-gray-900">{{ $trainerName }}</h3>
        <p class="text-gray-500 text-sm">{{ $email }}</p>
      </div>
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-gray-800">
      <p><span class="font-semibold">Gender:</span> {{ $gender }}</p>
      <p><span class="font-semibold">Age:</span> {{ $dob }}</p>
      <p><span class="font-semibold">Height:</span> {{ $height }} cm</p>
      <p><span class="font-semibold">Weight:</span> {{ $weight }} kg</p>
      <p class="sm:col-span-2"><span class="font-semibold">About:</span> {{ $about }}</p>
    </div>

    <div class="mt-10 text-center sm:text-right">
      <button onclick="openModal()"
        class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 active:scale-95 transition transform duration-200 shadow-md">
        Edit Profile
      </button>
    </div>
  </div>

  <!-- Modal -->
  <div id="editModal"
    class="fixed inset-0 z-50 hidden justify-center items-center bg-black/40 backdrop-blur-sm transition-opacity duration-300">
    <div id="modalBox"
      class="bg-white w-full max-w-xl mx-4 sm:mx-auto p-6 rounded-2xl shadow-xl transform scale-95 opacity-0 transition-all duration-300 relative">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Profile</h2>
      <form action="{{ route('trainer.profile.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="text" name="name" value="{{ $trainerName }}" required
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          placeholder="Name" />

        <select name="gender" required
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
          <option value="Male" {{ $gender == 'Male' ? 'selected' : '' }}>Male</option>
          <option value="Female" {{ $gender == 'Female' ? 'selected' : '' }}>Female</option>
        </select>

        <input type="date" name="dob"
          value="{{ is_numeric($dob) ? \Carbon\Carbon::now()->subYears($dob)->format('Y-m-d') : '' }}"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required />

        <input type="number" name="height" value="{{ $height }}" placeholder="Height (cm)"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required />

        <input type="number" name="weight" value="{{ $weight }}" placeholder="Weight (kg)"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required />

        <textarea name="about" rows="3"
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          placeholder="About Me">{{ $about !== '-' ? $about : '' }}</textarea>

        <input type="file" name="photo"
          class="w-full p-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

        <div class="flex justify-end gap-2 pt-4">
          <button type="button" onclick="closeModal()"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Cancel</button>
          <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Save</button>
        </div>
      </form>
      <button onclick="closeModal()"
        class="absolute top-3 right-4 text-2xl text-gray-500 hover:text-gray-800">&times;</button>
    </div>
  </div>
</div>

<script>
  function openModal() {
    const modal = document.getElementById('editModal');
    const box = document.getElementById('modalBox');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
      box.classList.remove('scale-95', 'opacity-0');
      box.classList.add('scale-100', 'opacity-100');
    }, 10);
  }

  function closeModal() {
    const modal = document.getElementById('editModal');
    const box = document.getElementById('modalBox');
    box.classList.remove('scale-100', 'opacity-100');
    box.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
      modal.classList.remove('flex');
      modal.classList.add('hidden');
    }, 200);
  }
</script>
@endsection

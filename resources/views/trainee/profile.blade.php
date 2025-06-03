@extends('layouts.trainee')

@section('content')
<div class="bg-gray-100 min-h-screen py-10 px-4">
  <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Trainee Profile</h2>

    <div class="flex flex-col sm:flex-row sm:items-center gap-6">
      <div class="flex-shrink-0">
        <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : asset('uploads/user_photo.jpg') }}"
             alt="Profile Photo"
             class="w-32 h-32 rounded-full object-cover border border-gray-300 shadow" />
      </div>
      <div>
        <h3 class="text-xl font-semibold text-gray-900">{{ $profile->name ?? $user->name }}</h3>
        <p class="text-gray-600">{{ $user->email }}</p>
      </div>
    </div>

    <div class="mt-6 space-y-2 text-gray-800">
      <p><span class="font-semibold">Gender:</span> {{ $profile->gender ?? '-' }}</p>
      <p><span class="font-semibold">Age:</span> {{ $profile->age ?? '-' }}</p>
      <p><span class="font-semibold">Height:</span> {{ $profile->height ?? '-' }} cm</p>
      <p><span class="font-semibold">Weight:</span> {{ $profile->weight ?? '-' }} kg</p>
      <p><span class="font-semibold">Trainer:</span> {{ $profile->trainer->username ?? 'Not Assigned' }}</p>
    </div>

    <div class="mt-8 text-right">
      <button onclick="openModal()"
              class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-all duration-200">
        Edit Profile
      </button>
    </div>
  </div>

  <!-- Modal -->
  <div id="editModal"
       class="fixed inset-0 hidden justify-center items-center z-50 bg-black/30 backdrop-blur-sm transition-opacity duration-300">
    <div id="modalBox"
         class="bg-white w-full max-w-xl p-6 rounded-lg shadow-lg relative transform transition-all duration-300 scale-95 opacity-0">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Profile</h2>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-4">
          <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                 class="w-full p-2 border border-gray-300 rounded" placeholder="Name" />

          <select name="gender" required class="w-full p-2 border border-gray-300 rounded">
            <option value="">Select Gender</option>
            <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
          </select>

          <input type="number" name="age" value="{{ old('age', $profile->age) }}"
                 class="w-full p-2 border border-gray-300 rounded" placeholder="Age" required />

          <input type="number" name="height" value="{{ old('height', $profile->height) }}"
                 class="w-full p-2 border border-gray-300 rounded" placeholder="Height (cm)" required />

          <input type="number" name="weight" value="{{ old('weight', $profile->weight) }}"
                 class="w-full p-2 border border-gray-300 rounded" placeholder="Weight (kg)" required />

          <input type="file" name="photo" class="w-full border border-gray-300 rounded p-2" />
        </div>

        <div class="mt-4 flex justify-end gap-2">
          <button type="button" onclick="closeModal()"
                  class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
        </div>
      </form>

      <button onclick="closeModal()"
              class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
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

@extends('layouts.trainee')

@section('content')
<<div class="bg-gray-100 min-h-screen py-8 px-4 sm:px-6">
  <div class="w-full max-w-md mx-auto bg-white p-5 sm:p-6 rounded-2xl shadow-xl overflow-hidden">
    <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
      <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Trainee Profile</h2>
      <button onclick="openModal()"
              class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-700 transition">
        Edit
      </button>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center gap-4 border-b border-gray-200 pb-5">
      <div class="flex-shrink-0 mx-auto sm:mx-0">
        <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : asset('uploads/user_photo.jpg') }}"
             alt="Profile Photo"
             class="w-28 h-28 rounded-full object-cover border-4 border-blue-500 shadow-md max-w-[90vw]" />
      </div>
      <div class="text-center sm:text-left">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-900">{{ $profile->name ?? $user->name }}</h3>
        <p class="text-sm text-gray-600">{{ $user->email }}</p>
        <p class="text-xs text-gray-400">Member since {{ $user->created_at->format('F Y') }}</p>
      </div>
    </div>

    <div class="mt-5 space-y-3 text-gray-800 text-sm">
      <div>
        <span class="text-gray-500">Gender:</span>
        <span class="font-medium">{{ $profile->gender ?? '-' }}</span>
      </div>
      <div>
        <span class="text-gray-500">Age:</span>
        <span class="font-medium">{{ $profile->age ?? '-' }}</span>
      </div>
      <div>
        <span class="text-gray-500">Height:</span>
        <span class="font-medium">{{ $profile->height ?? '-' }} cm</span>
      </div>
      <div>
        <span class="text-gray-500">Weight:</span>
        <span class="font-medium">{{ $profile->weight ?? '-' }} kg</span>
      </div>
      <div>
        <span class="text-gray-500">Trainer:</span>
        <span class="font-medium">{{ $profile->trainer->username ?? 'Not Assigned' }}</span>
      </div>
    </div>
  </div>

  <!-- Modal (tetap seperti sebelumnya) -->
</div>

  <!-- Modal -->
  <div id="editModal"
       class="fixed inset-0 hidden justify-center items-center z-50 bg-black/30 backdrop-blur-sm">
    <div id="modalBox"
         class="bg-white w-full max-w-md p-6 rounded-xl shadow-2xl relative transform transition-all duration-300 scale-95 opacity-0">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Profile</h2>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-4">
          <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                 class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 placeholder="Name" />

          <select name="gender" required
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white">
            <option value="">Select Gender</option>
            <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
          </select>

          <input type="number" name="age" value="{{ old('age', $profile->age) }}"
                 class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 placeholder="Age" required />

          <input type="number" name="height" value="{{ old('height', $profile->height) }}"
                 class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 placeholder="Height (cm)" required />

          <input type="number" name="weight" value="{{ old('weight', $profile->weight) }}"
                 class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 placeholder="Weight (kg)" required />

          <input type="file" name="photo"
                 class="w-full p-3 border border-gray-300 rounded-lg" />
        </div>

        <div class="mt-6 flex justify-end gap-2">
          <button type="button" onclick="closeModal()"
                  class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
          <button type="submit"
                  class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
        </div>
      </form>

      <button onclick="closeModal()"
              class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
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

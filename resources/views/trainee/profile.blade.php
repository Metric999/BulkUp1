@extends('layouts.trainee')
/**
@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100 py-8 px-4 sm:px-6">
  <div class="w-full max-w-lg mx-auto">
    <!-- Main Profile Card -->
    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
      <!-- Header Section -->
      <div class="relative bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 px-6 py-8">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative flex items-center justify-between">
          <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-white drop-shadow-lg">Trainee Profile</h2>
            <p class="text-purple-100 text-sm mt-1">Manage your fitness journey</p>
          </div>
          <button onclick="openModal()"
                  class="group bg-white/20 hover:bg-white/30 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 backdrop-blur-sm border border-white/30 flex items-center gap-2 shadow-lg hover:shadow-xl active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
          </button>
        </div>
      </div>

      <!-- Profile Information Section -->
      <div class="px-6 py-6 -mt-4 relative">
        <!-- Profile Photo and Basic Info -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-6 mb-8">
          <div class="relative mx-auto sm:mx-0 group">
            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 p-1 shadow-2xl">
              <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : asset('uploads/user_photo.jpg') }}"
                   alt="Profile Photo"
                   class="w-full h-full rounded-full object-cover border-4 border-white" />
            </div>
            <!-- Status Indicator -->
            <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center shadow-lg">
              <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
          </div>
          
          <div class="text-center sm:text-left flex-1">
            <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $profile->name ?? $user->name }}</h3>
            <div class="flex items-center justify-center sm:justify-start gap-2 text-gray-600 mb-2">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
              </svg>
              <span class="text-sm">{{ $user->email }}</span>
            </div>
            <div class="inline-flex items-center gap-2 bg-blue-100 px-3 py-1 rounded-full">
              <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              <span class="text-blue-800 text-xs font-semibold">Member since {{ $user->created_at->format('F Y') }}</span>
            </div>
          </div>
        </div>

        <!-- Information Grid -->
        <div class="space-y-4">
          <!-- Personal Stats -->
          <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-5 border border-gray-100">
            <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
              <div class="w-6 h-6 bg-blue-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              Personal Information
            </h4>
            <div class="grid grid-cols-2 gap-4">
              <div class="bg-white/70 rounded-xl p-4 hover:bg-white/90 transition-colors duration-200">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-medium">Gender</p>
                    <p class="text-sm font-bold text-gray-800">{{ $profile->gender ?? '-' }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-white/70 rounded-xl p-4 hover:bg-white/90 transition-colors duration-200">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-medium">Age</p>
                    <p class="text-sm font-bold text-gray-800">{{ $profile->age ?? '-' }} years</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Physical Stats -->
          <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-5 border border-gray-100">
            <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
              <div class="w-6 h-6 bg-indigo-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
              </div>
              Physical Stats
            </h4>
            <div class="grid grid-cols-2 gap-4">
              <div class="bg-white/70 rounded-xl p-4 hover:bg-white/90 transition-colors duration-200">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-medium">Height</p>
                    <p class="text-sm font-bold text-gray-800">{{ $profile->height ?? '-' }} cm</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-white/70 rounded-xl p-4 hover:bg-white/90 transition-colors duration-200">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-medium">Weight</p>
                    <p class="text-sm font-bold text-gray-800">{{ $profile->weight ?? '-' }} kg</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Trainer Info -->
          <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-5 border border-gray-100">
            <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
              <div class="w-6 h-6 bg-emerald-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
              Training Information
            </h4>
            <div class="bg-white/70 rounded-xl p-4 hover:bg-white/90 transition-colors duration-200">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                  <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-500 font-medium">Your Trainer</p>
                  <p class="text-sm font-bold text-gray-800">{{ $profile->trainer->username ?? 'Not Assigned' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enhanced Modal -->
  <div id="editModal"
       class="fixed inset-0 hidden justify-center items-center z-50 bg-black/50 backdrop-blur-sm transition-all duration-300">
    <div id="modalBox"
         class="bg-white w-full max-w-lg mx-4 rounded-3xl shadow-2xl relative transform transition-all duration-300 scale-95 opacity-0 overflow-hidden">
      
      <!-- Modal Header -->
      <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-6">
        <h2 class="text-2xl font-bold text-white">Edit Profile</h2>
        <p class="text-purple-100 text-sm mt-1">Update your personal information</p>
      </div>
      
      <!-- Modal Body -->
      <div class="p-6">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="space-y-5">
            <!-- Name Field -->
            <div class="space-y-2">
              <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                Full Name
              </label>
              <input type="text" name="name" value="{{ $profile->name ?? $user->name }}" required
                     class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                     placeholder="Enter your full name" />
            </div>

            <!-- Gender Field -->
            <div class="space-y-2">
              <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                Gender
              </label>
              <select name="gender" required
                      class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white">
                <option value="">Select Gender</option>
                <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <!-- Age Field -->
            <div class="space-y-2">
              <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Age
              </label>
              <input type="number" name="age" value="{{ old('age', $profile->age) }}"
                     class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                     placeholder="Enter your age" required />
            </div>

            <!-- Height and Weight Fields -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                  </svg>
                  Height (cm)
                </label>
                <input type="number" name="height" value="{{ old('height', $profile->height) }}"
                       class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                       placeholder="170" required />
              </div>
              
              <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                  </svg>
                  Weight (kg)
                </label>
                <input type="number" name="weight" value="{{ old('weight', $profile->weight) }}"
                       class="w-full p-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                       placeholder="65" required />
              </div>
            </div>

            <!-- Photo Upload Field -->
            <div class="space-y-2">
              <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Profile Photo
              </label>
              <input type="file" name="photo"
                     class="w-full p-4 border border-gray-200 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 file:font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 bg-gray-50 hover:bg-white" />
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
            <button type="button" onclick="closeModal()"
                    class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              Cancel
            </button>
            <button type="submit"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl hover:from-purple-700 hover:to-blue-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              Save Changes
            </button>
          </div>
        </form>
      </div>
      
      <!-- Close Button -->
      <button onclick="closeModal()"
              class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white hover:text-gray-100 transition-all duration-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
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

  // Close modal when clicking outside
  document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeModal();
    }
  });
</script>
@endsection
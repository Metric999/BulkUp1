<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Complete Your Profile - BulkUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col items-center">

  <!-- Navbar -->
  <nav class="w-full px-10 py-5 fixed top-0 left-0 z-50 bg-[#1f2937] shadow">
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  </nav>

  <!-- Main Container -->
  <div class="mt-28 w-4/5 max-w-5xl bg-white rounded-xl shadow-lg flex flex-col md:flex-row p-10 gap-10">

    <!-- Left Side: Profile Picture and Upload -->
    <div class="flex-1 text-center">
      <form method="POST" action="{{ route('trainee.profile.complete') }}" enctype="multipart/form-data" class="space-y-4" id="profileForm">
        @csrf

        <label for="photo" class="cursor-pointer block mx-auto w-36 h-36 rounded-full border-4 border-gray-300 overflow-hidden relative">
          <img
            src="{{ isset($profile->photo) && $profile->photo ? asset('storage/'.$profile->photo) : asset('uploads/default.png') }}"
            id="profile-pic"
            alt="Profile Picture"
            class="w-full h-full object-cover"
          />
          <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-40 text-white text-sm py-1">Click to change photo</div>
        </label>
        <input
          type="file"
          id="photo"
          name="photo"
          accept="image/*"
          class="hidden"
          onchange="previewImage(event)"
        />
        @error('photo')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Right Side: The rest of form inputs -->
        <div class="space-y-4 mt-6 text-left">

          <!-- Name -->
          <div>
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input
              type="text"
              id="name"
              name="name"
              value="{{ old('name', $profile->name ?? $user->name ?? '') }}"
              required
              class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
            />
            @error('name')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Gender -->
          <div>
            <label for="gender" class="block font-semibold mb-1">Gender</label>
            <select
              id="gender"
              name="gender"
              required
              class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
            >
              <option value="">-- Select Gender --</option>
              <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Age -->
          <div>
            <label for="age" class="block font-semibold mb-1">Age</label>
            <input
              type="number"
              id="age"
              name="age"
              value="{{ old('age', $profile->age ?? '') }}"
              required
              min="10"
              class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
            />
            @error('age')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Height -->
          <div>
            <label for="height" class="block font-semibold mb-1">Height (cm)</label>
            <input
              type="number"
              id="height"
              name="height"
              value="{{ old('height', $profile->height ?? '') }}"
              required
              min="50"
              class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
            />
            @error('height')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Weight -->
          <div>
            <label for="weight" class="block font-semibold mb-1">Weight (kg)</label>
            <input
              type="number"
              id="weight"
              name="weight"
              value="{{ old('weight', $profile->weight ?? '') }}"
              required
              min="20"
              class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
            />
            @error('weight')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Trainer -->
          <div>
            <label for="trainer" class="block font-semibold mb-1">Trainer</label>
            <select
              id="trainer"
              name="trainer_id"
              required
              class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
            >
              <option value="">-- Select Trainer --</option>
              @foreach ($trainers as $trainer)
                <option value="{{ $trainer->id }}" {{ old('trainer_id', $profile->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>
                  {{ $trainer->username }}
                </option>
              @endforeach
            </select>
            @error('trainer_id')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Submit -->
          <div class="text-center mt-6">
            <button
              type="submit"
              class="bg-[#1f2937] hover:bg-[#4379F2] text-white px-6 py-2 rounded-md"
            >
              Save Profile
            </button>
          </div>

        </div>

      </form>
    </div>
  </div>

  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function () {
        var output = document.getElementById('profile-pic');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</body>
</html>

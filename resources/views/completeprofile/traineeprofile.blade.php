<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Complete Your Profile - BulkUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f4f6;
      /* Tailwind's gray-100 */
    }

    /* Hover effect on profile pic container */
    #photo-label:hover div {
      background-color: rgba(31, 41, 55, 0.7);
      transition: background-color 0.3s ease;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col items-center">

  <!-- Navbar -->
  <nav class="w-full px-10 py-5 fixed top-0 left-0 z-50 bg-[#1f2937] shadow-md">
    <div class="text-white text-3xl font-extrabold tracking-wide select-none">
      Bulk<span class="text-blue-500">Up</span>
    </div>
  </nav>

  <!-- Main Container -->
  <main class="mt-28 w-11/12 max-w-6xl bg-white rounded-2xl shadow-lg flex flex-col md:flex-row p-8 md:p-12 gap-12">

    <!-- Left Side: Profile Picture and Upload -->
    <section class="flex-1 flex flex-col items-center md:items-start">
      <form
        method="POST"
        action="{{ route('trainee.profile.complete') }}"
        enctype="multipart/form-data"
        class="w-full max-w-sm"
        id="profileForm">
        @csrf

        <label
          for="photo"
          id="photo-label"
          class="cursor-pointer block mx-auto w-40 h-40 rounded-full border-4 border-gray-300 overflow-hidden relative shadow-lg hover:shadow-xl transition-shadow duration-300"
          title="Click to change photo">
          <img
            src="{{ isset($profile->photo) && $profile->photo ? asset('storage/'.$profile->photo) : asset('uploads/default.png') }}"
            id="profile-pic"
            alt="Profile Picture"
            class="w-full h-full object-cover" />
          <div
            class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-30 text-white text-center text-sm py-1 select-none">
            Click to change photo
          </div>
        </label>
        <input
          type="file"
          id="photo"
          name="photo"
          accept="image/*"
          class="hidden"
          onchange="previewImage(event)" />
        @error('photo')
        <p class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</p>
        @enderror

      </form>
    </section>

    <!-- Right Side: Form Inputs -->
    <section class="flex-1 max-w-lg">
      <form method="POST" action="{{ route('trainee.profile.complete') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
          <label for="name" class="block font-semibold mb-2 text-gray-700">Name</label>
          <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $profile->name ?? $user->name ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400"
            placeholder="Your full name" />
          @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Gender -->
        <div>
          <label for="gender" class="block font-semibold mb-2 text-gray-700">Gender</label>
          <select
            id="gender"
            name="gender"
            required
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 bg-white">
            <option value="" disabled {{ old('gender', $profile->gender ?? '') ? '' : 'selected' }}>-- Select Gender --</option>
            <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
          </select>
          @error('gender')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Age, Height, Weight grouped horizontally on md+ -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label for="age" class="block font-semibold mb-2 text-gray-700">Age</label>
            <input
              type="number"
              id="age"
              name="age"
              value="{{ old('age', $profile->age ?? '') }}"
              required
              min="10"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400"
              placeholder="Years" />
            @error('age')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="height" class="block font-semibold mb-2 text-gray-700">Height (cm)</label>
            <input
              type="number"
              id="height"
              name="height"
              value="{{ old('height', $profile->height ?? '') }}"
              required
              min="50"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400"
              placeholder="Centimeters" />
            @error('height')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="weight" class="block font-semibold mb-2 text-gray-700">Weight (kg)</label>
            <input
              type="number"
              id="weight"
              name="weight"
              value="{{ old('weight', $profile->weight ?? '') }}"
              required
              min="20"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 placeholder-gray-400"
              placeholder="Kilograms" />
            @error('weight')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Trainer -->
        <div>
          <label for="trainer" class="block font-semibold mb-2 text-gray-700">Trainer</label>
          <select
            id="trainer"
            name="trainer_id"
            required
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 bg-white">
            <option value="" disabled {{ old('trainer_id', $profile->trainer_id ?? '') ? '' : 'selected' }}>-- Select Trainer --</option>
            @foreach ($trainers as $trainer)
            <option value="{{ $trainer->id }}" {{ old('trainer_id', $profile->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>
              {{ $trainer->username }}
            </option>
            @endforeach
          </select>
          @error('trainer_id')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit -->
        <div class="text-center mt-8">
          <button
            type="submit"
            class="bg-[#1f2937] hover:bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition-colors duration-300">
            Save Profile
          </button>
        </div>
      </form>
    </section>
  </main>

  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const output = document.getElementById('profile-pic');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</body>

</html>
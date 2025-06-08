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
    }

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

    <!-- Left Side: Profile Picture -->
    <section class="flex-1 flex flex-col items-center md:items-start">
      <form method="POST" action="{{ route('trainer.profile.complete.store') }}" enctype="multipart/form-data" id="trainerProfileForm" class="w-full max-w-sm">
        @csrf

        <label for="photo" id="photo-label"
          class="cursor-pointer block mx-auto w-40 h-40 rounded-full border-4 border-gray-300 overflow-hidden relative shadow-lg hover:shadow-xl transition-shadow duration-300"
          title="Click to change photo">
          <img
            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('uploads/default.png') }}"
            id="profile-pic" alt="Profile Picture"
            class="w-full h-full object-cover" />
          <div
            class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-30 text-white text-center text-sm py-1 select-none">
            Click to change photo
          </div>
        </label>
        <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)" />
        @error('photo')
        <p class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</p>
        @enderror
      </form>
    </section>

    <!-- Right Side: Form -->
    <section class="flex-1 max-w-lg">
      <form method="POST" action="{{ route('trainer.profile.complete.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
          <label for="name" class="block font-semibold mb-2 text-gray-700">Name</label>
          <input type="text" id="name" name="name" required
            value="{{ old('name', Auth::user()->name) }}"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
            placeholder="Your full name" />
          @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Gender -->
        <div>
          <label for="gender" class="block font-semibold mb-2 text-gray-700">Gender</label>
          <select id="gender" name="gender" required
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <option value="Male" {{ old('gender', Auth::user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', Auth::user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
          </select>
          @error('gender')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- DOB -->
        <div>
          <label for="dob" class="block font-semibold mb-2 text-gray-700">Date of Birth</label>
          <input type="date" id="dob" name="dob" required
            value="{{ old('dob', Auth::user()->dob ? Auth::user()->dob->format('Y-m-d') : '') }}"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
          @error('dob')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Height & Weight -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="height" class="block font-semibold mb-2 text-gray-700">Height (cm)</label>
            <input type="number" id="height" name="height" required
              value="{{ old('height', Auth::user()->height) }}"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Height" />
            @error('height')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="weight" class="block font-semibold mb-2 text-gray-700">Weight (kg)</label>
            <input type="number" id="weight" name="weight" required
              value="{{ old('weight', Auth::user()->weight) }}"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Weight" />
            @error('weight')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- About -->
        <div>
          <label for="about" class="block font-semibold mb-2 text-gray-700">About Me</label>
          <textarea id="about" name="about" rows="4"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Tell us about yourself">{{ old('about', Auth::user()->about) }}</textarea>
          @error('about')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit -->
        <div class="text-center mt-8">
          <button type="submit"
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
      reader.onload = function () {
        const output = document.getElementById('profile-pic');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</body>

</html>

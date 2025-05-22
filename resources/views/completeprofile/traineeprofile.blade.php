<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complete Your Profile - BulkUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col items-center">

  <!-- Navbar -->
  <nav class="w-full px-10 py-5 fixed top-0 left-0 z-50 bg-[#1f2937] shadow">
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  </nav>

  <!-- Main Container -->
  <div class="mt-28 w-4/5 max-w-5xl bg-white rounded-xl shadow-lg flex flex-col md:flex-row p-10 gap-10">

    <!-- Left Side: Profile Picture -->
    <div class="flex-1 text-center">
      <label for="photo" class="cursor-pointer block">
        <img src="{{ asset('uploads/default.png') }}" id="profile-pic" alt="Profile Picture"
             class="w-36 h-36 rounded-full object-cover border-4 border-gray-300 mx-auto mb-4">
        <div class="text-sm text-gray-700">Click to change photo</div>
      </label>
      <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)">
    </div>

    <!-- Right Side: Form -->
    <div class="flex-2 w-full">
      <h2 class="text-2xl font-semibold text-center mb-6 text-black">Complete Your Profile</h2>
      
      <form method="POST" action="{{ route('profile.complete.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Name -->
          <div>
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('name')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Gender -->
          <div>
            <label for="gender" class="block font-semibold mb-1">Gender</label>
            <select id="gender" name="gender"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
              <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Age -->
          <div>
            <label for="age" class="block font-semibold mb-1">Age</label>
            <input type="number" id="age" name="age" value="{{ old('age') }}" required
                   class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('age')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Height -->
          <div>
            <label for="height" class="block font-semibold mb-1">Height (cm)</label>
            <input type="number" id="height" name="height" value="{{ old('height') }}" required
                   class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('height')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Weight -->
          <div>
            <label for="weight" class="block font-semibold mb-1">Weight (kg)</label>
            <input type="number" id="weight" name="weight" value="{{ old('weight') }}" required
                   class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('weight')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Goals -->
          <div>
            <label for="goals" class="block font-semibold mb-1">Training Goals</label>
            <input type="text" id="goals" name="goals" value="{{ old('goals') }}"
                   class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('goals')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Trainer -->
          <div class="md:col-span-2">
            <label for="trainer" class="block font-semibold mb-1">Trainer</label>
            <input type="text" id="trainer" name="trainer" value="{{ old('trainer') }}"
                   class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
            @error('trainer')
              <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="mt-6 bg-[#1f2937] hover:bg-[#4379F2] text-white px-6 py-2 rounded-md mx-auto block">
          Save Profile
        </button>
      </form>
    </div>
  </div>

  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function () {
        var output = document.getElementById('profile-pic');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</body>
</html>

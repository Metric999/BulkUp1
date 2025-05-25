@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Complete Your Profile - BulkUp</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Flowbite CSS and JS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center">

  <!-- Navbar -->
  <nav class="w-full py-5 px-10 fixed top-0 left-0 z-50 bg-[#1f2937] shadow">
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  </nav>

  <!-- Main Container -->
  <div class="mt-28 w-4/5 max-w-5xl bg-white rounded-xl shadow-lg flex flex-col md:flex-row p-10 gap-10">

    <!-- Left Side -->
    <div class="flex-1 text-center text-black">
      <label for="photo" class="cursor-pointer block">
        <img 
          src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('uploads/default.png') }}" 
          id="profile-pic" 
          alt="Profile Picture"
          class="w-36 h-36 rounded-full object-cover border-4 border-gray-300 mx-auto mb-4"
        >
        <div class="text-sm text-gray-700">Click to change photo</div>
      </label>
      <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)">
      @error('photo')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Right Side -->
    <div class="flex-grow w-full">
      <h2 class="text-center text-2xl font-semibold mb-6 text-gray-900">Complete Your Profile</h2>
      <form method="POST" action="{{ route('trainer.profile.complete.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
          <label for="name" class="block font-semibold mb-1 text-gray-900">Name</label>
          <input 
            type="text" id="name" name="name" placeholder="Enter name" required
            value="{{ old('name', Auth::user()->name) }}"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
          >
          @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="gender" class="block font-semibold mb-1 text-gray-900">Gender</label>
          <select 
            id="gender" name="gender" 
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
          >
            <option value="Male" {{ old('gender', Auth::user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', Auth::user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
          </select>
          @error('gender')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="dob" class="block font-semibold mb-1 text-gray-900">Date of Birth</label>
          <input 
            type="date" id="dob" name="dob" required
            value="{{ old('dob', Auth::user()->dob ? Auth::user()->dob->format('Y-m-d') : '') }}"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
          >
          @error('dob')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="height" class="block font-semibold mb-1 text-gray-900">Height (cm)</label>
          <input 
            type="number" id="height" name="height" placeholder="Enter height" required
            value="{{ old('height', Auth::user()->height) }}"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
          >
          @error('height')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="weight" class="block font-semibold mb-1 text-gray-900">Weight (kg)</label>
          <input 
            type="number" id="weight" name="weight" placeholder="Enter weight" required
            value="{{ old('weight', Auth::user()->weight) }}"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
          >
          @error('weight')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="about" class="block font-semibold mb-1 text-gray-900">About Me</label>
          <textarea 
            id="about" name="about" rows="3" placeholder="Tell us about yourself"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
          >{{ old('about', Auth::user()->about) }}</textarea>
          @error('about')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <button 
          type="submit"
          class="mt-6 bg-black hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg mx-auto block transition-all"
        >
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

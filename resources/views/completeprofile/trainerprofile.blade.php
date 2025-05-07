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
<body class="bg-gray-100 text-white min-h-screen flex flex-col items-center">

  <!-- Navbar -->
  <nav class="w-full py-5 px-10 fixed top-0 left-0 z-50 bg-[#1f2937] shadow">
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  </nav>

  <!-- Main Container -->
  <div class="mt-28 w-4/5 max-w-5xl bg-wheat-100 rounded-xl shadow-lg flex flex-col md:flex-row p-10 gap-10">

    <!-- Left Side -->
    <div class="flex-1 text-center text-black">
      <label for="photo" class="cursor-pointer block">
        <img src="uploads/default.png" id="profile-pic" alt="Profile Picture"
             class="w-36 h-36 rounded-full object-cover border-4 border-white mx-auto mb-4">
        <div class="text-sm text-black">Click to change photo</div>
      </label>
      <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)">
    </div>

    <!-- Right Side -->
    <div class="flex-2 w-full">
      <h2 class="text-center text-2xl font-semibold mb-6 text-black">Complete Your Profile</h2>
      <form method="POST" action="{{ route('trainer.profile') }}" enctype="multipart/form-data" class="space-y-4">@csrf
        <div>
          <label for="name" class="block font-semibold mb-1 text-black">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter name" required
                 class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-black focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label for="gender" class="block font-semibold mb-1 text-black">Gender</label>
          <select id="gender" name="gender"
                  class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-black focus:border-blue-500 focus:ring-blue-500">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <div>
          <label for="dob" class="block font-semibold mb-1 text-black">Age</label>
          <input type="number" id="dob" name="dob" placeholder="Enter age" required
                 class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-black focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label for="height" class="block font-semibold mb-1 text-black">Height (cm)</label>
          <input type="number" id="height" name="height" placeholder="Enter height" required
                 class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-black focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label for="weight" class="block font-semibold mb-1 text-black">Weight (kg)</label>
          <input type="number" id="weight" name="weight" placeholder="Enter weight" required
                 class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-black focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div>
          <label for="about" class="block font-semibold mb-1 text-black">About Me</label>
          <textarea id="about" name="about" rows="3" placeholder="Tell us about yourself"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-black focus:border-blue-500 focus:ring-blue-500"></textarea>
        </div>

        <button type="submit"
                class="mt-6 bg-black hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg mx-auto block transition-all">
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

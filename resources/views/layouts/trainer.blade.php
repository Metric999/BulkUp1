<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Trainer Home')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleDropdown() {
      document.getElementById('profileDropdown').classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

<!-- Navbar -->
<header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
  <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  <div class="flex items-center space-x-6">
    <a href="{{ route('trainer.home') }}" class="{{ request()->routeIs('trainer.home') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Home</a>
    <a href="{{ route('trainer.workout') }}" class="{{ request()->routeIs('trainer.workout') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Workout</a>
    <a href="{{ route('trainer.mealplan') }}" class="{{ request()->routeIs('trainer.mealplan') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Mealplan</a>
    <a href="{{ route('trainer.progress') }}" class="{{ request()->routeIs('trainer.progress') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Progress</a>
    <div class="relative cursor-pointer">

    <!-- dropdown --->

      <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
      <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
      <a href="{{ route('trainer.profile') }}" class="{{ request()->routeIs('trainer.profile') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Profile</a>
        <a href="{{ route('trainer.notification') }}" class="{{ request()->routeIs('trainer.notification') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Notification</a>
        <a href="{{ route('trainer.feedback') }}" class="{{ request()->routeIs('trainer.feedback') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Feedback</a>
        <a href="#" class="flex items-center space-x-2 hover:underline text-white">Log Out</a>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<main class="w-full py-8 px-4 space-y-6">
  @yield('content')
</main>

</body>
</html>

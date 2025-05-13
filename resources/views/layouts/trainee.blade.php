<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Trainee Home')</title>
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Tambahkan ini agar script dari child view bisa masuk --}}
  @stack('head') 

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
    
    <!-- Home -->
    <a href="{{ route('trainee.home') }}" class="flex items-center space-x-1 {{ request()->routeIs('trainee.home') ? 'text-blue-500 font-semibold' : 'text-white hover:text-gray-300' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M3 9.75L12 3l9 6.75V21a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 21V9.75z"/>
      </svg>
      <span>Home</span>
    </a>

    <!-- Workout (Barbell Icon) -->
    <a href="{{ route('trainee.workout') }}" class="flex items-center space-x-1 {{ request()->routeIs('trainee.workout') ? 'text-blue-500 font-semibold' : 'text-white hover:text-gray-300' }}">
      <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M4 10v4m16-4v4M7 9v6m10-6v6M4 13h16" />
      </svg>
      <span>Workout</span>
    </a>

    <!-- Mealplan (Fork & Spoon Icon) -->
    <a href="{{ route('trainee.mealplan') }}" class="flex items-center space-x-1 {{ request()->routeIs('trainee.mealplan') ? 'text-blue-500 font-semibold' : 'text-white hover:text-gray-300' }} hover:text-blue-500">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="24" height="24" class="icon">
        <path d="M215.078,8.156c-9.297,0-16.828,7.531-16.828,16.844v84.188h-27.203V23.328C171.047,10.438,160.609,0,147.734,0c-12.891,0-23.328,10.438-23.328,23.328v85.859H97.219V25c0-9.313-7.547-16.844-16.844-16.844S63.531,15.688,63.531,25v107.5h0.313c2.563,19.625,22.344,38.313,51.484,46.375v294.281c0,17.875,14.516,32.375,32.406,32.375c17.875,0,32.359-14.5,32.359-32.375V178.094c25.313-7.219,48.906-22.516,51.547-45.594h0.266V25C231.906,15.688,224.375,8.156,215.078,8.156z"></path>
        <path d="M363.266,16.031c-18.797-6.375-47.188-10.188-47.188,18.656c0,0,0,419.594,0,443.375c0,23.75,13.578,33.938,30.547,33.938s30.531-10.188,30.531-30.563c0-20.344,0-185.281,0-185.281s35.656,0,50.938,0s20.375-18.688,20.375-32.281c0,0,0-50.969,0-93.406C448.469,78.281,403.031,29.563,363.266,16.031z"></path>
    </svg>
      <span>Mealplan</span>
    </a>

    <!-- User Dropdown -->
    <div class="relative cursor-pointer">
    <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
      
      <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
  <!-- Profile -->
  <a href="{{ route('trainee.profile') }}" class="flex items-center space-x-2 {{ request()->routeIs('trainee.profile') ? 'text-blue-500  font-semibold' : 'text-white hover:text-gray-300' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A6 6 0 0112 15a6 6 0 016.879 2.804M12 13a5 5 0 100-10 5 5 0 000 10z"/>
    </svg>
    <span>Profile</span>
  </a>

  <!-- Notification -->
  <a href="{{ route('trainee.notification') }}" class="flex items-center space-x-2 {{ request()->routeIs('trainee.notification') ? 'text-blue-500  font-semibold' : 'text-white hover:text-gray-300' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9"/>
    </svg>
    <span>Notification</span>
  </a>

  <!-- Feedback -->
  <a href="{{ route('trainee.feedback') }}" class="flex items-center space-x-2 {{ request()->routeIs('trainee.feedback') ? 'text-blue-500  font-semibold' : 'text-white hover:text-gray-300' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 3.866-4.03 7-9 7a9.77 9.77 0 01-3.55-.64L3 21l1.36-3.64A6.987 6.987 0 013 12c0-3.866 4.03-7 9-7s9 3.134 9 7z"/>
    </svg>
    <span>Feedback</span>
  </a>

  <!-- Logout -->
  <a href="#" class="flex items-center space-x-2 hover: text-white">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
    </svg>
    <span>Log Out</span>
  </a>
</div>

    </div>
  </div>
</header>

<!-- Main Content -->
<main class="w-full py-8 px-4 space-y-6">
  @yield('content')
</main>
@yield('scripts')
</body>
</html>

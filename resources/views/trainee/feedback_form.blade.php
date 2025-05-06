<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BulkUp - Feedback</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
  <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  <div class="flex items-center space-x-6">
    <a href="{{ url('TraineeHome1') }}" class="{{ request()->is('TraineeHome1') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Home</a>
    <a href="{{ url('TraineeWork') }}" class="{{ request()->is('TraineeWork') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Workout</a>
    <a href="{{ url('trainee_mealplan') }}" class="{{ request()->is('trainee_mealplan') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Mealplan</a>
    <div class="relative">
      <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
      <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
        <a href="{{ url('profile_traine') }}" class="block hover:underline text-white">Profile</a>
        <a href="{{ url('notif_trainee') }}" class="block hover:underline text-white">Notifications</a>
        <a href="{{ url('trainee/feedback') }}" class="block hover:underline text-white">Feedback</a>
        <a href="#" class="block hover:underline text-white">Log Out</a>
      </div>
    </div>
  </div>
</header>

<!-- Feedback Form -->
<main class="flex justify-center items-center py-16 px-4">
  <div class="w-full max-w-2xl bg-white p-8 rounded-xl border-2 border-black shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Give Feedback</h2>

    @if (session('success'))
      <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @elseif (session('error'))
      <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('trainee.feedback.submit') }}">
      @csrf
      <textarea 
        name="feedback" 
        placeholder="Write feedback..." 
        class="w-full h-40 p-4 border border-gray-300 rounded-md text-gray-800 bg-gray-100 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
      
      <button 
        type="submit" 
        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition duration-200">
        Submit Feedback
      </button>
    </form>
  </div>
</main>

<script>
  function toggleDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('hidden');
  }
</script>

</body>
</html>

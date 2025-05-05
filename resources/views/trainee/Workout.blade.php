<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Workout Plan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

  <!-- Navbar -->
  <header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>

    <div class="flex items-center space-x-6">
      <a href="{{ url('TraineeHome1') }}" class="{{ request()->is('TraineeHome1') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Home</a>
      <a href="{{ route('trainee.workout') }}" class="{{ request()->is('trainee/workout') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Workout</a>
      <a href="{{ url('trainee_mealplan') }}" class="{{ request()->is('trainee_mealplan') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Mealplan</a>

      <!-- Profile Dropdown -->
      <div class="relative">
        <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
        <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
          <a href="{{ url('profile_traine') }}" class="block hover:underline text-white">Profile</a>
          <a href="{{ url('notif_trainee') }}" class="block hover:underline text-white">Notifications</a>
          <a href="{{ url('feedback_trainee') }}" class="block hover:underline text-white">Feedback</a>
          <a href="#" class="block hover:underline text-white">Log Out</a>
        </div>
      </div>
    </div>
  </header>

  <div class="max-w-4xl mx-auto space-y-6 p-6">
    <h1 class="text-3xl font-bold">My Workout Plan</h1>
    <p class="text-gray-600 text-lg">Welcome, {{ $traineeName }}!</p>

    @foreach ($daysOfWeek as $day)
      <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-xl font-semibold">{{ $day }}</h3>

        @if (empty($workouts[$day]))
          <p class="text-gray-500">No workouts scheduled.</p>
        @else
          @foreach ($workouts[$day] as $w)
            <div class="mt-4 border-t pt-2 space-y-1">
              <p class="font-semibold text-lg">{{ $w['name'] ?? '' }}</p>
              <p class="text-sm text-gray-700">Category: {{ $w['kategori'] ?? '' }}</p>
              <p class="text-sm text-gray-700">Difficulty: {{ $w['difficult'] ?? '' }}</p>
              <p class="text-sm text-gray-700">Reps: {{ $w['reps'] ?? '' }}</p>
              @if (!empty($w['videoUrl']))
                @php
                  function embedUrl($url) {
                      if (preg_match("#youtube\.com/watch\?v=([^&]+)#", $url, $matches)) {
                          return "https://www.youtube.com/embed/" . $matches[1];
                      }
                      if (preg_match("#youtu\.be/([^?&]+)#", $url, $matches)) {
                          return "https://www.youtube.com/embed/" . $matches[1];
                      }
                      if (preg_match("#vimeo\.com/(\d+)#", $url, $matches)) {
                          return "https://player.vimeo.com/video/" . $matches[1];
                      }
                      return $url;
                  }
                @endphp
                <div class="aspect-video mt-2">
                  <iframe class="w-full h-full rounded" src="{{ embedUrl($w['videoUrl']) }}" frameborder="0" allowfullscreen></iframe>
                </div>
              @endif
            </div>
          @endforeach
        @endif
      </div>
    @endforeach
  </div>
</body>
</html>

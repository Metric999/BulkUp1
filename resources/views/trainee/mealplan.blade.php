<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BulkUp - Trainee Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleDropdown() {
      document.getElementById('profileDropdown').classList.toggle('hidden');
    }
    
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.5s ease-out'
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(10px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            }
          }
        }
      }
    }
  </script>
</head>
<body class="bg-white min-h-screen text-black">

<header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
  <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
  <div class="flex items-center space-x-6">
  <a href="{{ url('/trainee/home') }}" class="{{ request()->is('trainee/home') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Home</a>
      <a href="{{ route('trainee.workout') }}" class="{{ request()->routeIs('trainee.workout') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Workout</a>
      <a href="{{ url('/trainee/mealplan') }}" class="{{ request()->is('trainee/mealplan') ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' }}">Mealplan</a>

    <div class="relative">
      <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
      <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
        <a href="{{ url('/trainee/traineeprofile') }}" class="block hover:underline text-white">Profile</a>
        <a href="{{ url('/trainee/trainee_notification') }}" class="block hover:underline text-white">Notifications</a>
        <a href="{{ url('/trainee/trainee_feedback') }}" class="block hover:underline text-white">Feedback</a>
        <a href="#" class="block hover:underline text-white">Log Out</a>
      </div>
    </div>
  </div>
</header>

  <main class="px-6 py-10 text-white">
    <p class="text-xl font-semibold text-black">Trainee</p>
    <h2 class="text-2xl font-bold mt-2 flex items-center gap-2 text-black">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" viewBox="0 0 24 24" fill="currentColor">
        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
      </svg>
      Today's Meal Plan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
      @foreach ($meals as $meal)
        @php
          $isSubmitted = in_array($meal['id'], $submitted);
          $btnColor = $isSubmitted ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600';
          $label = $isSubmitted ? '✅ Submitted' : 'Submit';
          $submitUrl = route('mealplan', ['submitted' => implode(',', $submitted), 'toggle' => $meal['id']]);
        @endphp

        <div class="bg-slate-800 p-6 rounded-xl border-l-8 border-{{ $meal['color'] }}-500 shadow-md">
          <h3 class="text-{{ $meal['color'] }}-300 font-semibold text-lg">{{ $meal['time'] }}</h3>
          <p class="mt-2">Meal : {{ $meal['meal'] }}</p>
          <p>Calories : {{ $meal['calories'] }}</p>
          <p class="italic text-sm">Note : {{ $meal['note'] }}</p>
          <a href="{{ $submitUrl }}" class="inline-block mt-4 {{ $btnColor }} text-white px-4 py-2 rounded-full text-sm transition-all">
            {{ $label }}
          </a>
        </div>
      @endforeach
    </div>
  </main>

  <script>
    const profileToggle = document.getElementById('profileToggle');
    const profileMenu = document.getElementById('profileMenu');

    profileToggle.addEventListener('click', () => {
      profileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
        profileMenu.classList.add('hidden');
      }
    });
  </script>

</body>
</html>

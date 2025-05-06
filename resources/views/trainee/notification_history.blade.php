<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notification History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

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
        <a href="{{ route('trainee.notification') }}" class="block hover:underline text-white">Notifications</a>
        <a href="{{ url('trainee/feedback') }}" class="block hover:underline text-white">Feedback</a>
        <a href="#" class="block hover:underline text-white">Log Out</a>
      </div>
    </div>
  </div>
</header>

<body class="bg-rose-50 min-h-screen py-10 px-4 font-sans">

    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">📜 Notification History</h2>

        <div class="space-y-5">
            @foreach ($notification_history as $notif)
                <div class="bg-white shadow-md rounded-xl p-5 border-l-4 border-green-500">
                    <time class="text-sm text-gray-500 block mb-1">{{ \Carbon\Carbon::parse($notif['datetime'])->format('F d, Y, H:i') }}</time>
                    <h4 class="text-lg font-semibold text-gray-800">{{ $notif['title'] }}</h4>
                    <p class="text-gray-700">{{ $notif['message'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

<script>
  function toggleDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('hidden');
  }
</script>

</body>
</html>

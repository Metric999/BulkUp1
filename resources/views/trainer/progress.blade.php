@extends('layouts.trainer')

@section('content')
    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">History Trainee</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($trainees as $trainee)
                <div class="bg-white shadow-md rounded-xl p-6 transition hover:shadow-lg border border-gray-200">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-gray-800">{{ $trainee['name'] }}</h2>
                        <p class="text-sm text-gray-500">Last Submit: {{ $trainee['last_submit'] }}</p>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Mealplan Done</p>
                            <p class="text-green-600 font-semibold text-lg">{{ $trainee['mealplan_done'] }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Workout Done</p>
                            <p class="text-green-600 font-semibold text-lg">{{ $trainee['workout_done'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@section('navbar')
    <header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
        <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
        <div class="flex items-center space-x-6">
            <a href="home" class="text-white hover:text-gray-300">Home</a>
            <a href="workout" class="text-white hover:text-gray-300">Workout</a>
            <a href="mealplan" class="text-white hover:text-gray-300">Mealplan</a>
            <a href="progress" class="text-blue-500 underline font-semibold">History</a>
            <div class="relative cursor-pointer">
                <button id="profileBtn" class="text-white text-xl focus:outline-none">👤</button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
                    <a href="profile_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Profile</a>
                    <a href="notif_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Notifications</a>
                    <a href="feedback_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Feedback</a>
                    <a href="#" class="flex items-center space-x-2 hover:underline text-white">Log Out</a>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('scripts')
    <script>
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!dropdownMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
@endsection

@extends('layouts.trainer')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Progress Trainee</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-3 border text-sm text-gray-700">Nama Trainee</th>
                        <th class="px-4 py-3 border text-sm text-gray-700">Mealplan Done</th>
                        <th class="px-4 py-3 border text-sm text-gray-700">Workout Done</th>
                        <th class="px-4 py-3 border text-sm text-gray-700">Last Submit</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($trainees as $trainee)
        <tr class="border-t hover:bg-gray-50 transition">
            <td class="px-4 py-3 border font-medium text-gray-800">{{ $trainee['name'] }}</td>
            <td class="px-4 py-3 border text-green-600 font-semibold">{{ $trainee['mealplan_done'] }}</td>
            <td class="px-4 py-3 border text-green-600 font-semibold">{{ $trainee['workout_done'] }}</td>
            <td class="px-4 py-3 border text-gray-500">{{ $trainee['last_submit'] }}</td>
        </tr>
    @endforeach
</tbody>

            </table>
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
            <a href="progress" class="text-blue-500 underline font-semibold">Progress</a>
            <div class="relative cursor-pointer">
                <div class="relative">
                    <button id="profileBtn" class="text-white text-xl focus:outline-none">👤</button>
                    <div id="dropdownMenu" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
                        <a href="profile_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Profile</a>
                        <a href="notif_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Notifications</a>
                        <a href="feedback_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Feedback</a>
                        <a href="#" class="flex items-center space-x-2 hover:underline text-white">Log Out</a>
                    </div>
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

        // Hide dropdown if click outside
        document.addEventListener('click', function (e) {
            if (!dropdownMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
@endsection

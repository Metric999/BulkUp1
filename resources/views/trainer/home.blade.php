<?php
session_start();

// Simulasi data trainer dan trainee
$trainerName = "Coach";
$trainees = [
  ["id" => "1", "name" => "Andre"],
  ["id" => "2", "name" => "Marwan"],
  ["id" => "3", "name" => "Raymond"],
];

$totalTrainees = count($trainees);
$totalWorkoutPlans = 12;  // Bisa diganti dengan perhitungan dinamis
$totalMealPlans = 9;      // Sama seperti di atas
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainer Home</title>
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
    <!-- Brand -->
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>

    <!-- Navigation Menu -->
    <div class="flex items-center space-x-6">
    <a href="home" class="<?= basename($_SERVER['PHP_SELF']) == 'home' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Home</a>
  <a href="workout" class="<?= basename($_SERVER['PHP_SELF']) == 'Workout' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Workout</a>
  <a href="mealplan" class="<?= basename($_SERVER['PHP_SELF']) == 'mealplan' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Mealplan</a>
  <a href="progress" class="<?= basename($_SERVER['PHP_SELF']) == 'progress' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Progress</a>
      <div class="relative cursor-pointer">

      <!-- Profile Dropdown -->
      <div class="relative">
        <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
        <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
        <a href="profile_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Profile</a>
          <a href="notif_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Notifications</a>
          <a href="feedback_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Feedback</a>
          <a href="#" class="flex items-center space-x-2 hover:underline text-white">Log Out</a>
        </div>
      </div>
    </div>
  </header>

<!-- Main Content -->
<div class="max-w-5xl mx-auto py-8 px-4 space-y-6">
  <h1 class="text-3xl font-bold">Welcome, <?= $trainerName ?>!</h1>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow p-6 text-center">
      <h2 class="text-lg font-medium text-gray-600">Total Trainees</h2>
      <p class="text-3xl text-blue-600 font-bold mt-2"><?= $totalTrainees ?></p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 text-center">
      <h2 class="text-lg font-medium text-gray-600">Workout Plans</h2>
      <p class="text-3xl text-green-600 font-bold mt-2"><?= $totalWorkoutPlans ?></p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 text-center">
      <h2 class="text-lg font-medium text-gray-600">Meal Plans</h2>
      <p class="text-3xl text-red-500 font-bold mt-2"><?= $totalMealPlans ?></p>
    </div>
  </div>

  <!-- Trainee List -->
  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Trainees</h2>
    <ul class="divide-y">
      <?php foreach ($trainees as $trainee): ?>
        <li class="py-2 flex justify-between items-center">
          <span><?= $trainee['name'] ?></span>
          <div class="space-x-2">
            <a href="workout?trainee_id=<?= $trainee['id'] ?>" class="text-blue-500 hover:underline text-sm">Workout</a>
            <a href="mealplan?trainee_id=<?= $trainee['id'] ?>" class="text-green-500 hover:underline text-sm">Meal Plan</a>
            <a href="progress?trainee_id=<?= $trainee['id'] ?>" class="text-red-500 hover:underline text-sm">Progress</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

</body>
</html>

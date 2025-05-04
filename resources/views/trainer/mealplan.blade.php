<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BulkUp - Trainer Meal Plan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-white min-h-screen text-black">

  <!-- Navbar -->
  <header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
  <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>
    <div class="flex items-center space-x-6">
    <div class="flex items-center space-x-6">
    <a href="home" class="<?= basename($_SERVER['PHP_SELF']) == 'home' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Home</a>
  <a href="workout" class="<?= basename($_SERVER['PHP_SELF']) == 'Workout' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Workout</a>
  <a href="mealplan" class="<?= basename($_SERVER['PHP_SELF']) == 'mealplan' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Mealplan</a>
  <a href="progress" class="<?= basename($_SERVER['PHP_SELF']) == 'progress' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Progress</a>
      <div class="relative cursor-pointer">

      <!-- Profile Dropdown -->
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
  </header>

  <!-- Main Content -->
  <main class="px-6 py-10 text-gray-800">
  <!-- Judul Halaman -->
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.216 0 4.295.537 6.121 1.49M15 12a3 3 0 10-6 0 3 3 0 006 0z" />
      </svg>
      Input Meal Plan
    </h1>
    <p class="text-gray-600 mt-1">Manage meal plans for your trainees easily.</p>
  </div>

  <!-- Form Pilihan Trainee dan Tanggal -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div>
      <label for="trainee" class="block font-semibold mb-1">Choose Trainee</label>
      <select id="trainee" name="trainee" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-400">
        <option value="1">Trainee 1 - Andre</option>
        <option value="2">Trainee 2 - Alam</option>
        <option value="3">Trainee 3 - Remon</option>
      </select>
    </div>
    <div>
      <label for="mealDate" class="block font-semibold mb-1">Date</label>
      <input type="date" id="mealDate" name="meal_date" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-400">
    </div>
  </div>

  <!-- Form Meal Plan -->
  <form id="mealForm" action="submit_mealplan.php" method="POST" class="bg-white p-6 rounded-xl shadow-xl border border-gray-200">
    <div class="flex items-center mb-4">
      <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10" />
      </svg>
      <h3 class="text-xl font-semibold text-gray-700">Add Melplan</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block font-medium mb-1">Time</label>
        <input type="time" name="time" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
      </div>
      <div>
        <label class="block font-medium mb-1">Type (example: Breakfast)</label>
        <input type="text" name="type" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
      </div>
    </div>

    <div class="mt-4">
      <label class="block font-medium mb-1">Meal Name</label>
      <input type="text" name="meal" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
    </div>

    <div class="mt-4">
      <label class="block font-medium mb-1">Calories</label>
      <input type="number" name="calories" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
    </div>

    <div class="mt-4">
      <label class="block font-medium mb-1">Note</label>
      <textarea name="note" rows="3" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required></textarea>
    </div>

    <input type="hidden" name="trainee_id" id="traineeInput" value="1">

    <div class="mt-6 text-right">
      <button type="submit" class="bg-green-500 hover:bg-green-600 transition text-white font-semibold px-6 py-3 rounded-full shadow">
        ➕ Simpan Meal Plan
      </button>
    </div>
  </form>
</main>


  <!-- Scripts -->
  <script>
    const profileBtn = document.getElementById("profileBtn");
    const dropdownMenu = document.getElementById("dropdownMenu");
    profileBtn.addEventListener("click", () => {
      dropdownMenu.classList.toggle("hidden");
    });

    const traineeSelect = document.getElementById("trainee");
    const traineeInput = document.getElementById("traineeInput");
    traineeSelect.addEventListener("change", function () {
      traineeInput.value = this.value;
    });

    const mealForm = document.getElementById("mealForm");
    const dateInput = document.getElementById("mealDate");

    mealForm.addEventListener("submit", function (e) {
      if (!dateInput.value) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: 'Please select a date before submitting!',
          confirmButtonColor: '#f59e0b'
        });
      } else {
        e.preventDefault(); // Remove this if using real backend
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Meal has been submitted.',
          confirmButtonColor: '#10b981'
        });
      }
    });
  </script>

</body>
</html>

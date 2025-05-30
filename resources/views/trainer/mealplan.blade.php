@extends('layouts.trainer')

@section('title', 'BulkUp - Trainer Meal Plan')

@section('content')
<main class="w-full px-6 py-10 text-gray-800">
  <!-- Judul Halaman -->
  <div class="mb-8 w-full">
    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.216 0 4.295.537 6.121 1.49M15 12a3 3 0 10-6 0 3 3 0 006 0z" />
      </svg>
      Input Meal Plan
    </h1>
    <p class="text-gray-600 mt-1">Manage meal plans for your trainees easily.</p>
  </div>

  <!-- Form Pilihan Trainee dan Tanggal -->
  <form id="mealForm" action="{{ route('trainer.mealplan.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-xl border border-gray-200 w-full">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 w-full">
      <div>
        <label for="trainee" class="block font-semibold mb-1">Choose Trainee</label>
        <select id="trainee" name="trainee_id" class="form-select w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
          <option value="">-- Select Trainee --</option>
          @foreach($trainees as $trainee)
            <option value="{{ $trainee->id }}">{{ $trainee->username }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label for="mealDate" class="block font-semibold mb-1">Date</label>
        <input type="date" id="mealDate" name="date" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
      </div>
    </div>

    <!-- Form Meal Plan -->
    <div class="flex items-center mb-4">
      <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10" />
      </svg>
      <h3 class="text-xl font-semibold text-gray-700">Add Meal Plan</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
      <div>
        <label class="block font-medium mb-1">Time</label>
        <input type="time" name="time" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1 font-medium text-sm">Meal Type</label>
        <select name="type" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300">
          <option>Breakfast</option>
          <option>Lunch</option>
          <option>Dinner</option>
          <option>Snack</option>
        </select>
      </div>
    </div>


    <div class="mt-4 w-full">
      <label class="block font-medium mb-1">Meal Name</label>
      <input type="text" name="meal_name" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
    </div>

    <div class="mt-4 w-full">
      <label class="block font-medium mb-1">Calories</label>
      <input type="number" name="calories" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
    </div>

    <div class="mt-4 w-full">
      <label class="block font-medium mb-1">Note</label>
      <textarea name="note" rows="3" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required></textarea>
    </div>

    <div class="mt-6 text-right">
      <button type="submit" class="bg-green-500 hover:bg-green-600 transition text-white font-semibold px-6 py-3 rounded-full shadow">
        ➕ Save Meal Plan
      </button>
    </div>
  </form>
</main>

<!-- ✅ JavaScript validasi tanggal -->
<script>
  const profileBtn = document.getElementById("profileBtn");
  const dropdownMenu = document.getElementById("dropdownMenu");
  if (profileBtn) {
    profileBtn.addEventListener("click", () => {
      dropdownMenu.classList.toggle("hidden");
    });
  }

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
    }
    // ✅ Tidak ada preventDefault di else, supaya data benar-benar tersubmit
  });
</script>
@endsection

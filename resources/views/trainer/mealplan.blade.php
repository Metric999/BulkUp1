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

  <!-- Form Tambah Meal Plan -->
  <form id="mealForm" action="{{ route('trainer.mealplan.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-xl border border-gray-200 w-full mb-10">
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

  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 mt-6 rounded">
        {{ session('success') }}
    </div>
@endif

@if(isset($trainees) && count($trainees))
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4">Meal Plan List</h2>

        @foreach($trainees as $trainee)
            <div class="mb-6 bg-white p-6 rounded shadow border">
                <h3 class="text-lg font-semibold mb-3 text-blue-600">Trainee: {{ $trainee->username }}</h3>

                @foreach($trainee->mealPlans as $meal)
                    <form method="POST" action="{{ route('trainer.mealplan.update', $meal->id) }}" class="border-t pt-4 mt-4 space-y-3">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block font-medium">Date</label>
                                <input type="date" name="date" value="{{ $meal->date }}" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-medium">Time</label>
                                <input type="time" name="time" value="{{ $meal->time }}" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-medium">Type</label>
                                <select name="type" class="w-full border p-2 rounded">
                                    <option {{ $meal->type == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                                    <option {{ $meal->type == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                                    <option {{ $meal->type == 'Dinner' ? 'selected' : '' }}>Dinner</option>
                                    <option {{ $meal->type == 'Snack' ? 'selected' : '' }}>Snack</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium">Meal Name</label>
                                <input type="text" name="meal_name" value="{{ $meal->meal_name }}" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-medium">Calories</label>
                                <input type="number" name="calories" value="{{ $meal->calories }}" class="w-full border p-2 rounded">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium">Note</label>
                            <textarea name="note" rows="2" class="w-full border p-2 rounded">{{ $meal->note }}</textarea>
                        </div>

                        <div class="flex gap-2 mt-2">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
                        </form>

                        <form method="POST" action="{{ route('trainer.mealplan.destroy', $meal->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this meal plan?')" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                        </form>
                        </div>
                    </form>
                @endforeach
            </div>
        @endforeach
    </div>
@endif

  <!-- Tampilkan Daftar Meal Plan -->
  @if(isset($mealplans) && count($mealplans) > 0)
    <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-200">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Meal Plans List</h2>

      @foreach($mealplans as $meal)
        <form action="{{ route('trainer.mealplan.update', $meal->id) }}" method="POST" class="border-t pt-4 mt-4 space-y-2">
          @csrf
          @method('PUT')
          <div class="grid md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-semibold mb-1">Time</label>
              <input type="time" name="time" value="{{ $meal->time }}" class="w-full p-2 rounded border">
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Type</label>
              <select name="type" class="w-full p-2 rounded border">
                <option {{ $meal->type == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                <option {{ $meal->type == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                <option {{ $meal->type == 'Dinner' ? 'selected' : '' }}>Dinner</option>
                <option {{ $meal->type == 'Snack' ? 'selected' : '' }}>Snack</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Meal Name</label>
              <input type="text" name="meal_name" value="{{ $meal->meal_name }}" class="w-full p-2 rounded border">
            </div>
          </div>
          <div class="grid md:grid-cols-2 gap-4 mt-2">
            <div>
              <label class="block text-sm font-semibold mb-1">Calories</label>
              <input type="number" name="calories" value="{{ $meal->calories }}" class="w-full p-2 rounded border">
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Note</label>
              <textarea name="note" rows="2" class="w-full p-2 rounded border">{{ $meal->note }}</textarea>
            </div>
          </div>
          <div class="flex space-x-2 mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
        <form action="{{ route('trainer.mealplan.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this meal plan?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
        </form>
        </div>
      @endforeach
    </div>
  @endif
</main>

<script>
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
  });
</script>
@endsection

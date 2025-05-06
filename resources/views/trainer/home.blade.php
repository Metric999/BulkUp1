@extends('layouts.trainer')

@section('title', 'Trainer Home')

@section('content')
  <h1 class="text-3xl font-bold">Welcome, {{ $trainerName }}!</h1>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow p-6 text-center">
      <h2 class="text-lg font-medium text-gray-600">Total Trainees</h2>
      <p class="text-3xl text-blue-600 font-bold mt-2">{{ $totalTrainees }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 text-center">
      <h2 class="text-lg font-medium text-gray-600">Workout Plans</h2>
      <p class="text-3xl text-green-600 font-bold mt-2">{{ $totalWorkoutPlans }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 text-center">
      <h2 class="text-lg font-medium text-gray-600">Meal Plans</h2>
      <p class="text-3xl text-red-500 font-bold mt-2">{{ $totalMealPlans }}</p>
    </div>
  </div>

  <!-- Trainee List -->
  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Trainees</h2>
    <ul class="divide-y">
      @foreach ($trainees as $trainee)
        <li class="py-2 flex justify-between items-center">
          <span>{{ $trainee['name'] }}</span>
          <div class="space-x-2">
            <a href="workout?trainee_id={{ $trainee['id'] }}" class="text-blue-500 hover:underline text-sm">Workout</a>
            <a href="mealplan?trainee_id={{ $trainee['id'] }}" class="text-green-500 hover:underline text-sm">Meal Plan</a>
            <a href="progress?trainee_id={{ $trainee['id'] }}" class="text-red-500 hover:underline text-sm">Progress</a>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
@endsection

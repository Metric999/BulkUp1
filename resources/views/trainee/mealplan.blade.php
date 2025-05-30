@extends('layouts.trainee')

@section('content')
  <p class="text-xl font-semibold text-black">{{ auth()->user()->traineeProfile->name ?? 'Trainee' }}</p>
  <h2 class="text-2xl font-bold mt-2 flex items-center gap-2 text-black">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" viewBox="0 0 24 24" fill="currentColor">
      <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
    </svg>
    Today's Meal Plan
  </h2>

  @if ($meals->isEmpty())
    <p class="text-gray-600 mt-4">No meal plans available for today.</p>
  @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
      @foreach ($meals as $meal)
        @php
          $isSubmitted = in_array($meal->id, $submitted);
          $btnColor = $isSubmitted ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600';
          $label = $isSubmitted ? '✅ Submitted' : 'Submit';
          $submitUrl = route('trainee.mealplan', ['submitted' => implode(',', $submitted), 'toggle' => $meal->id]);

          $colorMap = [
              'breakfast' => 'yellow',
              'lunch' => 'blue',
              'dinner' => 'pink',
              'snack' => 'green',
          ];
          $color = $colorMap[strtolower($meal->type)] ?? 'gray';
        @endphp

        <div class="bg-slate-800 p-6 rounded-xl border-l-8 border-{{ $color }}-500 shadow-md text-white">
          <h3 class="text-{{ $color }}-300 font-semibold text-lg">
            {{ $meal->time }} - {{ ucfirst($meal->type) }}
          </h3>
          <p class="mt-2">Meal : {{ $meal->meal_name }}</p>
          <p>Calories : {{ $meal->calories }} kcal</p>
          <p class="italic text-sm">Note : {{ $meal->note }}</p>
          <a href="{{ $submitUrl }}" class="inline-block mt-4 {{ $btnColor }} text-white px-4 py-2 rounded-full text-sm transition-all">
            {{ $label }}
          </a>
        </div>
      @endforeach
    </div>
  @endif
@endsection

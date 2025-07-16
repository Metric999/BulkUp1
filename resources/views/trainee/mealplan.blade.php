@extends('layouts.trainee')

@section('content')
  <p class="text-xl font-semibold text-black">{{ auth()->user()->traineeProfile->name ?? 'Trainee' }}</p>
  <h2 class="text-2xl font-bold mt-2 flex items-center gap-2 text-black">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" viewBox="0 0 24 24" fill="currentColor">
      <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
    </svg>
    Today's Meal Plan
  </h2>
  
  {{-- Tambahkan pesan sukses/error/warning --}}
  @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative mt-4" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  @endif
  @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative mt-4" role="alert">
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
  @endif
  @if (session('warning'))
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-md relative mt-4" role="alert">
      <span class="block sm:inline">{{ session('warning') }}</span>
    </div>
  @endif


  @if ($meals->isEmpty())
    <p class="text-gray-600 mt-4">No meal plans available for today.</p>
  @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
      @foreach ($meals as $meal)
        @php
          $colorMap = [
              'breakfast' => 'yellow',
              'lunch' => 'blue',
              'dinner' => 'pink',
              'snack' => 'green',
          ];
          $color = $colorMap[strtolower($meal->type)] ?? 'gray';

          // Cek apakah meal ini sudah disubmit hari ini
          $isSubmitted = isset($submittedMealIds[$meal->id]);
          $progressSubmissionId = $isSubmitted ? $submittedMealIds[$meal->id] : null;
        @endphp

        <div class="bg-slate-800 p-6 rounded-xl border-l-8 border-{{ $color }}-500 shadow-md text-white">
          <h3 class="text-{{ $color }}-300 font-semibold text-lg">
            {{ $meal->time }} - {{ ucfirst($meal->type) }}
          </h3>
          <p class="mt-2">Meal : {{ $meal->meal_name }}</p>
          <p>Calories : {{ $meal->calories }} kcal</p>
          <p class="italic text-sm">Note : {{ $meal->note }}</p>

          @if (!$isSubmitted)
            <form action="{{ route('progress.store') }}" method="POST">
              @csrf
              <input type="hidden" name="type" value="mealplan">
              <input type="hidden" name="item_id" value="{{ $meal->id }}">
              <button type="submit"
                      class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm transition-all">
                Submit
              </button>
            </form>
          @else
            <span class="inline-block mt-4 bg-green-500 text-white px-4 py-2 rounded-full text-sm">
              ✅ Submitted
            </span>
            {{-- Tombol untuk membatalkan submit --}}
            <form action="{{ route('progress.destroy', $progressSubmissionId) }}" method="POST" class="inline-block ml-2">
                @csrf
                @method('DELETE') {{-- Penting untuk metode DELETE --}}
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm transition-all">
                    Cancel Submit
                </button>
            </form>
          @endif
        </div>
      @endforeach
    </div>
  @endif
@endsection
@extends('layouts.trainer')

@section('title', 'Feedback - BulkUp')

@section('content')
<div class="bg-gradient-to-b from-white to-blue-50 min-h-screen font-sans">
  <div class="max-w-3xl mx-auto p-6">
    <section class="bg-white rounded-xl shadow-lg p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Trainee Feedback</h2>

      @forelse ($feedbackList as $feedback)
        <div class="p-4 bg-gray-50 rounded border border-gray-200 shadow-sm">
          <p class="text-gray-800">“{{ $feedback->comment }}”</p>
          <span class="text-xs text-gray-500 block mt-2">
            — {{ $feedback->trainee->username ?? 'Anonymous' }}, {{ \Carbon\Carbon::parse($feedback->date)->format('M d, Y') }}
          </span>
        </div>
      @empty
        <p class="text-gray-500">No feedback available yet.</p>
      @endforelse

    </section>
  </div>
</div>
@endsection

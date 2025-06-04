@extends('layouts.trainee')

@section('title', 'BulkUp - Feedback')

@section('content')
<main class="flex justify-center items-center py-16 px-4 bg-gray-100 min-h-screen">
  <div class="w-full max-w-2xl bg-white p-8 rounded-xl border-2 border-black shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Give Feedback</h2>

    @if (session('success'))
      <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @elseif (session('error'))
      <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('trainee.feedback.submit') }}">
      @csrf
      <textarea 
        name="feedback" 
        placeholder="Write feedback..." 
        class="w-full h-40 p-4 border border-gray-300 rounded-md text-gray-800 bg-gray-100 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
      
      <button 
        type="submit" 
        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition duration-200">
        Submit Feedback
      </button>
    </form>
  </div>
</main>
@endsection

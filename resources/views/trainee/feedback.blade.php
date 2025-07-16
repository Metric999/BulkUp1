@extends('layouts.trainee')

@section('title', 'BulkUp - Feedback')

@section('content')
<main class="flex justify-center items-center py-16 px-4  min-h-screen">
  <div class="w-full max-w-2xl bg-white p-10 rounded-2xl border border-gray-300 shadow-xl relative overflow-hidden">
    <!-- Ilustrasi di pojok -->
   <div class="flex flex-col items-center mb-4">

  <h2 class="text-3xl font-bold text-gray-800">💬 Give Us Your Feedback</h2>
</div>


    <!-- Motivational Quote -->
    <div class="bg-purple-100 text-purple-800 px-4 py-3 rounded-lg mb-6 text-sm text-center">
      We value your thoughts! Help us make <strong>BulkUp</strong> even better 💪
    </div>

    @if (session('success'))
      <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @elseif (session('error'))
      <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('trainee.feedback.submit') }}" class="space-y-4">
      @csrf
      <textarea 
        name="feedback" 
        placeholder="What do you love about BulkUp? What could be improved? Be honest, we appreciate it! 💡" 
        class="w-full h-44 p-4 border-2 border-gray-300 rounded-lg text-gray-700 bg-gray-50 resize-none focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200 shadow-sm"></textarea>
      
      <div class="flex justify-center">
        <button 
          type="submit" 
          class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-full transition duration-300 shadow-md hover:shadow-lg">
          🚀 Submit Feedback
        </button>
      </div>
    </form>

    <!-- Optional: fake testimonial or info -->
    <div class="mt-8 border-t pt-6 text-center text-sm text-gray-500">
      “Your feedback helps us lift better every day.” — The BulkUp Team 🏋️‍♂️
    </div>
  </div>
</main>
@endsection

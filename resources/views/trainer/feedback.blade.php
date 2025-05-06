@extends('layouts.trainer')

@section('title', 'Feedback - BulkUp')

@section('content')
<div class="bg-gradient-to-b from-white to-blue-50 min-h-screen font-sans">
  <div class="max-w-3xl mx-auto p-6">
    <section class="bg-white rounded-xl shadow-lg p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Feedback</h2>
      <div class="space-y-4">
        <div class="p-4 bg-gray-50 rounded border border-gray-200 shadow-sm">
          <p class="text-gray-800">“I love the training schedule! Maybe add more leg day options?”</p>
          <span class="text-xs text-gray-500 block mt-2">— John Doe, Apr 21</span>
        </div>
        <div class="p-4 bg-gray-50 rounded border border-gray-200 shadow-sm">
          <p class="text-gray-800">“App looks clean and easy to use. Great job!”</p>
          <span class="text-xs text-gray-500 block mt-2">— Sarah A., Apr 19</span>
        </div>
        <div class="p-4 bg-gray-50 rounded border border-gray-200 shadow-sm">
          <p class="text-gray-800">“It would be helpful to have reminders for water intake.”</p>
          <span class="text-xs text-gray-500 block mt-2">— Kevin L., Apr 15</span>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

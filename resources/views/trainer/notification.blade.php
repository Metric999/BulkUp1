@extends('layouts.trainer')

@section('title', 'Add Notification')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Add Reminders</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('trainer.notification.store') }}">
        @csrf

        <div class="mb-4">
            <label for="judul" class="block font-medium text-gray-700">Title</label>
            <input type="text" name="judul" id="judul" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

        <div class="mb-4">
            <label for="pesan" class="block font-medium text-gray-700">Message</label>
            <textarea name="pesan" id="pesan" rows="4" class="w-full border rounded px-3 py-2 mt-1" required></textarea>
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
            Send Reminders
        </button>
    </form>
</div>
@endsection

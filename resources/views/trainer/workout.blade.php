@extends('layouts.trainer')

@section('content')
<h1 class="text-3xl font-bold mb-4">Workout Plan - Trainer</h1>

@if(session('success'))
    <div class="bg-green-200 p-3 mb-4 rounded text-green-800">
        {{ session('success') }}
    </div>
@endif

<!-- Select Trainee -->
<div class="mb-6">
    <form method="GET" action="{{ route('trainer.workout') }}">
        <label for="trainee_id" class="block font-medium mb-1">Select Trainee</label>
        <select name="trainee_id" id="trainee_id" class="w-full p-2 border rounded" onchange="this.form.submit()" required>
            <option value="">-- Select Trainee --</option>
            @foreach($trainees as $trainee)
                <option value="{{ $trainee->id }}" {{ request('trainee_id') == $trainee->id ? 'selected' : '' }}>
                    {{ $trainee->username }}
                </option>
            @endforeach
        </select>
    </form>
</div>

<!-- Form Tambah Workout -->
<div class="bg-white p-6 rounded shadow w-full mb-8">
    <h2 class="text-xl font-semibold mb-4">Add Workout for Trainee</h2>
    <form method="POST" action="{{ route('trainer.workout.store', ['trainee_id' => request('trainee_id')]) }}" class="space-y-4">
        @csrf
        <input type="hidden" name="trainee_id" value="{{ request('trainee_id') }}">

        <div>
            <label for="workout_date" class="block font-medium">Workout Date</label>
            <input type="date" id="workout_date" name="workout_date" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="name" class="block font-medium">Workout Name</label>
            <input type="text" id="name" name="name" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="category" class="block font-medium">Category</label>
            <input type="text" id="category" name="category" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="difficulty" class="block font-medium">Difficulty</label>
            <input type="text" id="difficulty" name="difficulty" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="reps" class="block font-medium">Reps (e.g., 3x12)</label>
            <input type="text" id="reps" name="reps" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="video_url" class="block font-medium">Video URL (optional)</label>
            <input type="url" id="video_url" name="video_url" class="w-full p-2 border rounded" />
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 rounded w-full hover:bg-blue-700">
            Add Workout
        </button>
    </form>
</div>

<!-- Workout List -->
@if(isset($selectedTrainee))
    <div class="bg-white p-6 rounded shadow w-full">
        <h2 class="text-xl font-semibold mb-4">Workout List for {{ $selectedTrainee->username }}</h2>

        @foreach($workouts as $workout)
            <div class="border-t pt-4 mt-4 space-y-2">
                <!-- Update Workout -->
                <form method="POST" action="{{ route('trainer.workout.update', [$workout->id, 'trainee_id' => $selectedTrainee->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="trainee_id" value="{{ $selectedTrainee->id }}">

                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-medium">Name</label>
                            <input type="text" name="name" value="{{ $workout->name }}" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label class="block font-medium">Category</label>
                            <input type="text" name="category" value="{{ $workout->kategori }}" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label class="block font-medium">Difficulty</label>
                            <input type="text" name="difficulty" value="{{ $workout->difficult }}" class="w-full border p-2 rounded">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mt-2">
                        <div>
                            <label class="block font-medium">Reps</label>
                            <input type="text" name="reps" value="{{ $workout->reps }}" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label class="block font-medium">Video URL</label>
                            <input type="url" name="video_url" value="{{ $workout->videoUrl }}" class="w-full border p-2 rounded">
                        </div>
                    </div>

                    <div class="flex space-x-2 pt-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Update</button>
                    </div>
                </form>

                <!-- Delete Workout -->
                <form method="POST" action="{{ route('trainer.workout.destroy', [$workout->id, 'trainee_id' => $selectedTrainee->id]) }}" onsubmit="return confirm('Delete this workout?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 mt-2">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection

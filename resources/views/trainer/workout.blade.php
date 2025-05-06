@extends('layouts.trainer')

@section('content')
    <h1 class="text-3xl font-bold">Workout Plan - Trainer</h1>

    <!-- Pilih Trainee -->
    <form class="mb-6">
        <label class="block mb-2 font-semibold">Select Trainee:</label>
        <select class="w-full p-2 border rounded-md max-w-sm">
            <!-- Option data harus diisi secara manual atau menggunakan JavaScript -->
            <option value="1">Trainee 1</option>
            <option value="2">Trainee 2</option>
        </select>
    </form>

    <!-- Form Tambah Workout -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Add Workout for Trainee Name</h2>
        <form class="grid grid-cols-2 gap-4">
            <select class="col-span-2 p-2 border rounded-md">
                <!-- Daftar hari dalam seminggu -->
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
            </select>
            <input type="text" placeholder="Workout Name" required class="p-2 border rounded">
            <input type="text" placeholder="Category" required class="p-2 border rounded">
            <input type="text" placeholder="Difficulty" required class="p-2 border rounded">
            <input type="text" placeholder="Reps (e.g. 3x12)" required class="p-2 border rounded">
            <input type="text" placeholder="Video URL" class="col-span-2 p-2 border rounded">
            <button type="submit" class="col-span-2 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Add Workout</button>
        </form>
    </div>

    <!-- Daftar Workout per Hari -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-2">Monday</h3>
            <p class="text-gray-500">No workouts for this day.</p>
        </div>
        <!-- Repeat this block for each day -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-2">Tuesday</h3>
            <div class="mt-4 border-t pt-4">
                <p class="font-semibold text-lg">Workout Name</p>
                <p class="text-sm">Category: Category Name</p>
                <p class="text-sm">Difficulty: Medium</p>
                <p class="text-sm">Reps: 3x12</p>
                <div class="flex gap-4 text-sm font-medium mt-2">
                    <button onclick="openEditModal('Tuesday', 0, 'Workout Name', 'Category Name', 'Medium', '3x12', '')"
                            class="text-blue-600 hover:underline">Edit</button>
                    <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline text-sm">Delete</button>
                </div>
                <div class="aspect-video mt-2">
                    <iframe src="https://www.youtube.com/embed/video_id" class="w-full h-full rounded" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow max-w-md w-full">
            <h2 class="text-xl font-bold mb-4">Edit Workout</h2>
            <form class="space-y-4">
                <input type="hidden" id="modal_day">
                <input type="hidden" id="modal_index">
                <div>
                    <label class="block font-medium">Workout Name</label>
                    <input type="text" id="modal_name" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-medium">Category</label>
                    <input type="text" id="modal_kategori" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-medium">Difficulty</label>
                    <input type="text" id="modal_difficult" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-medium">Reps</label>
                    <input type="text" id="modal_reps" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-medium">Video URL</label>
                    <input type="text" id="modal_videoUrl" class="w-full p-2 border rounded">
                </div>
                <button type="button" class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 w-full">Save Changes</button>
            </form>
        </div>
    </div>
@endsection

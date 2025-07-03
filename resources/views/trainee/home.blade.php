@extends('layouts.trainee')

@section('title', 'Trainee Home')

@section('content')
<header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg p-5 flex flex-col md:flex-row justify-between items-center text-white">
    <h1 class="text-3xl font-extrabold mb-3 md:mb-0">Your Trainee Dashboard</h1>
    <nav class="space-x-4 sm:space-x-6 flex flex-wrap justify-center">
        <button id="progressLink" onclick="showTab('progressTab')" class="nav-button active">Progress</button>
        <button id="bmiLink" onclick="showTab('bmiTab')" class="nav-button">BMI Calculator</button>
    </nav>
</header>

<div id="progressTab" class="p-6 space-y-8 animate-fade-in">
    {{-- Quote --}}
    @php
        $quotes = [
            "Progress is progress, no matter how small.",
            "Your body can stand almost anything. It's your mind that you have to convince.",
            "The only bad workout is the one that didn't happen.",
            "Eat clean, train dirty.",
            "Believe you can and you're halfway there."
        ];
    @endphp
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-7 rounded-xl shadow-lg text-center text-indigo-800 font-semibold italic text-lg border border-indigo-200">
        <p class="flex items-center justify-center space-x-2">
            <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9.293 12.293a1 1 0 001.414 1.414L12 11.414V15a1 1 0 102 0v-3.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3z" clip-rule="evenodd"></path></svg>
            <span>{{ $quotes[array_rand($quotes)] }}</span>
        </p>
    </div>

    {{-- Progress Summary --}}
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-5">Your Progress Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-5 rounded-lg border border-blue-200 flex items-center justify-between transition-transform transform hover:scale-105">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-lg font-semibold text-gray-700">Completed Meal Plans</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-3xl font-extrabold text-blue-700">{{ $mealplanDoneCount }}</span>
                    @if($mealplanDoneCount > 0)
                        <button onclick="showDetailModal('mealplan')" class="detail-button">
                            View Details
                        </button>
                    @endif
                </div>
            </div>

            <div class="bg-green-50 p-5 rounded-lg border border-green-200 flex items-center justify-between transition-transform transform hover:scale-105">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <p class="text-lg font-semibold text-gray-700">Completed Workouts</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-3xl font-extrabold text-green-700">{{ $workoutDoneCount }}</span>
                    @if($workoutDoneCount > 0)
                        <button onclick="showDetailModal('workout')" class="detail-button">
                            View Details
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

---

<main id="bmiTab" class="hidden max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 animate-fade-in">
    {{-- Form --}}
    <div class="bg-white rounded-xl p-7 shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Calculate Your BMI</h2>
        <form id="bmiForm" class="space-y-5">
            <div>
                <label class="block mb-2 font-medium text-gray-700 text-lg">Gender</label>
                <div class="flex space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="Pria" class="form-radio text-blue-600 h-5 w-5">
                        <span class="ml-2 text-gray-700">Man</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="Wanita" class="form-radio text-pink-600 h-5 w-5">
                        <span class="ml-2 text-gray-700">Woman</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="weight" class="block mb-2 font-medium text-gray-700 text-lg">Weight (kg)</label>
                <input id="weight" type="number" step="0.1" class="form-input" placeholder="e.g., 70.5" required>
            </div>
            <div>
                <label for="age" class="block mb-2 font-medium text-gray-700 text-lg">Age (years)</label>
                <input id="age" type="number" min="18" class="form-input" placeholder="e.g., 25" required>
            </div>
            <div>
                <label for="height" class="block mb-2 font-medium text-gray-700 text-lg">Height (cm)</label>
                <input id="height" type="number" class="form-input" placeholder="e.g., 175" required>
            </div>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                <button type="submit" class="button-primary">Calculate BMI</button>
                <button type="button" onclick="resetForm()" class="button-secondary">Reset Form</button>
            </div>
        </form>
    </div>

    {{-- Output --}}
    <div class="bg-white rounded-xl p-7 shadow-lg border border-gray-200 flex flex-col justify-center items-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Your BMI Result</h2>
        <div class="text-center text-gray-600" id="bmiOutput">
            <p class="text-lg">Please fill out the form to see your BMI results.</p>
            <svg class="mx-auto mt-4 w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.328a1 1 0 01.947-.468h3.385c.445 0 .741.407.575.787l-1.802 4.056c-.053.119-.015.25.097.319l1.621.962c.316.188.665.316 1.018.411 1.488.423 2.684.584 3.754.484.534-.05.955.334.955.877v2.533c0 .543-.421.927-.955.877-1.07-.1-2.266-.261-3.754-.684a12.608 12.608 0 00-1.018-.411l-1.621-.962c-.112-.069-.15-.2-.097-.319l1.802-4.056zm-4.72 13.918L4 16h-.012L2.73 15.684A1 1 0 002 16.517v.983A1.5 1.5 0 003.5 19h13c.828 0 1.5-.672 1.5-1.5v-.983A1 1 0 0017.27 15.684L16.012 16H16l-.012-.008L14.73 15.684A1 1 0 0014 16.517v.983A1.5 1.5 0 0015.5 19h-13z" clip-rule="evenodd"></path></svg>
        </div>
    </div>
</main>

{{-- Modal --}}
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 hidden animate-fade-in">
    <div class="bg-white p-7 rounded-xl shadow-2xl w-full max-w-md md:max-w-lg lg:max-w-xl max-h-[90vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modalContentWrapper">
        <div class="flex justify-between items-center mb-5 border-b pb-3">
            <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Detail Progress</h2>
            <button onclick="hideDetailModal()" class="text-gray-500 hover:text-gray-800 text-3xl font-bold transition-transform transform hover:rotate-90">&times;</button>
        </div>
        <div id="modalContent" class="text-gray-700 text-base leading-relaxed">
            <p class="text-center py-6 text-gray-500">Loading details...</p>
        </div>
        <div class="mt-6 text-right border-t pt-4">
            <button onclick="hideDetailModal()" class="button-secondary-outline">Close</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initial display of the progress tab
    document.addEventListener('DOMContentLoaded', () => {
        showTab('progressTab');
    });

    function showTab(tabId) {
        // Hide all tabs and deactivate all links
        document.getElementById('progressTab').classList.add('hidden');
        document.getElementById('bmiTab').classList.add('hidden');
        document.getElementById('progressLink').classList.remove('active');
        document.getElementById('bmiLink').classList.remove('active');

        // Show the selected tab and activate its link
        document.getElementById(tabId).classList.remove('hidden');
        document.getElementById(tabId).classList.add('animate-fade-in'); // Add animation class
        if (tabId === 'progressTab') {
            document.getElementById('progressLink').classList.add('active');
        } else {
            document.getElementById('bmiLink').classList.add('active');
        }
    }

    function resetForm() {
        document.getElementById('weight').value = '';
        document.getElementById('height').value = '';
        document.getElementById('age').value = '';
        document.querySelectorAll('input[name="gender"]').forEach(input => input.checked = false);
        document.getElementById('bmiOutput').innerHTML = '<p class="text-lg">Please fill out the form to see your BMI results.</p><svg class="mx-auto mt-4 w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.328a1 1 0 01.947-.468h3.385c.445 0 .741.407.575.787l-1.802 4.056c-.053.119-.015.25.097.319l1.621.962c.316.188.665.316 1.018.411 1.488.423 2.684.584 3.754.484.534-.05.955.334.955.877v2.533c0 .543-.421.927-.955.877-1.07-.1-2.266-.261-3.754-.684a12.608 12.608 0 00-1.018-.411l-1.621-.962c-.112-.069-.15-.2-.097-.319l1.802-4.056zm-4.72 13.918L4 16h-.012L2.73 15.684A1 1 0 002 16.517v.983A1.5 1.5 0 003.5 19h13c.828 0 1.5-.672 1.5-1.5v-.983A1 1 0 0017.27 15.684L16.012 16H16l-.012-.008L14.73 15.684A1 1 0 0014 16.517v.983A1.5 1.5 0 0015.5 19h-13z" clip-rule="evenodd"></path></svg>';
    }

    document.getElementById('bmiForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const gender = document.querySelector('input[name="gender"]:checked')?.value || '';
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);
        const age = parseInt(document.getElementById('age').value); // Using age here, though not directly in BMI calc

        if (!weight || !height) {
            document.getElementById('bmiOutput').innerHTML = `<p class="text-red-600 font-semibold">Please enter valid weight and height.</p>`;
            return;
        }

        const heightInMeters = height / 100;
        const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);

        let category = '';
        let advice = '';
        let bgColor = '';
        let textColor = '';

        if (bmi < 18.5) {
            category = 'Underweight';
            advice = 'Your weight is less than normal. Consider a healthy, balanced diet to gain weight.';
            bgColor = 'bg-blue-100';
            textColor = 'text-blue-700';
        } else if (bmi < 25) {
            category = 'Normal Weight';
            advice = 'Your weight is ideal. Keep up the great work with a healthy lifestyle!';
            bgColor = 'bg-green-100';
            textColor = 'text-green-700';
        } else if (bmi < 30) {
            category = 'Overweight';
            advice = 'You are slightly overweight. Focus on a balanced diet and regular exercise.';
            bgColor = 'bg-yellow-100';
            textColor = 'text-yellow-700';
        } else {
            category = 'Obesity';
            advice = 'You are in the obese category. It is recommended to consult with a health professional.';
            bgColor = 'bg-red-100';
            textColor = 'text-red-700';
        }

        document.getElementById('bmiOutput').innerHTML = `
            <div class="mb-4">
                <span class="text-lg font-bold px-4 py-2 rounded-full ${bgColor} ${textColor}">${category}</span>
            </div>
            <div class="text-6xl font-extrabold text-gray-900 mb-3">${bmi}</div>
            <div class="text-md text-gray-700 max-w-sm mx-auto">${advice}</div>
        `;
    });

    // Modal logic
    const detailModal = document.getElementById('detailModal');
    const modalContentWrapper = document.getElementById('modalContentWrapper');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');

    function showDetailModal(type) {
        modalContent.innerHTML = '<p class="text-center py-6 text-gray-500">Loading details...</p>';
        detailModal.classList.remove('hidden');
        setTimeout(() => {
            modalContentWrapper.classList.remove('opacity-0', 'scale-95');
            modalContentWrapper.classList.add('opacity-100', 'scale-100');
        }, 50); // Small delay for animation to start

        let url = '';
        let title = '';

        if (type === 'mealplan') {
            url = "{{ route('trainee.progress.submitted_mealplans') }}";
            title = 'Submitted Meal Plans';
        } else if (type === 'workout') {
            url = "{{ route('trainee.progress.submitted_workouts') }}";
            title = 'Submitted Workouts';
        }

        modalTitle.innerText = title;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    modalContent.innerHTML = `<p class="text-center py-6 text-gray-600 italic">No data submitted yet for ${title.toLowerCase()}.</p>`;
                } else {
                    let html = '<ul class="list-disc pl-6 space-y-3 text-gray-800">';
                    data.forEach(item => {
                        if (type === 'mealplan') {
                            const d = new Date(item.date + 'T' + item.time);
                            html += `<li><strong class="text-indigo-700">${item.type} (${d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })})</strong>: <span class="font-medium">${item.meal_name}</span> (${item.calories} kcal) on ${d.toLocaleDateString()} <br><span class="text-sm text-gray-500">Note: ${item.note || 'N/A'}</span></li>`;
                        } else {
                            const d = new Date(item.date);
                            html += `<li><strong class="text-teal-700">${item.name}</strong> on ${d.toLocaleDateString()} <br><span class="text-sm text-gray-500">Category: ${item.kategori || 'N/A'} &bull; Difficulty: ${item.difficult || 'N/A'} &bull; Reps: ${item.reps || 'N/A'}</span></li>`;
                        }
                    });
                    html += '</ul>';
                    modalContent.innerHTML = html;
                }
            })
            .catch(() => {
                modalContent.innerHTML = `<p class="text-center py-6 text-red-500 font-semibold">Failed to load data. Please try again.</p>`;
            });
    }

    function hideDetailModal() {
        modalContentWrapper.classList.remove('opacity-100', 'scale-100');
        modalContentWrapper.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            detailModal.classList.add('hidden');
            modalContent.innerHTML = '';
        }, 300); // Match this duration with the transition duration
    }

    detailModal.addEventListener('click', function (e) {
        if (e.target === detailModal) hideDetailModal();
    });
</script>

<style>
    /* Custom Tailwind CSS classes for better aesthetics */
    .nav-button {
        @apply font-bold text-lg px-4 py-2 rounded-full transition-all duration-300 ease-in-out;
        @apply text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75;
    }

    .nav-button.active {
        @apply bg-white text-blue-700 shadow-md;
    }

    .detail-button {
        @apply bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-5 rounded-full text-sm transition-all duration-300 ease-in-out shadow-md hover:shadow-lg;
    }

    .form-input {
        @apply w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 ease-in-out;
    }

    .button-primary {
        @apply bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition-all duration-300 ease-in-out font-semibold shadow-md hover:shadow-lg;
    }

    .button-secondary {
        @apply border border-gray-300 bg-gray-100 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-200 transition-all duration-300 ease-in-out font-semibold shadow-sm hover:shadow-md;
    }

    .button-secondary-outline {
        @apply border border-gray-400 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-100 transition-all duration-300 ease-in-out font-medium;
    }

    /* Animation for tab content */
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>
@endsection
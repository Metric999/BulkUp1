@extends('layouts.trainee')

@section('title', 'Trainee Home')

@section('content')
<header class="bg-white shadow p-4 flex justify-between items-center">
  <h1 class="text-2xl font-bold text-black">Trainee</h1>
  <nav class="space-x-6">
    <button id="progressLink" onclick="showTab('progressTab')" class="font-semibold text-gray-500 hover:text-blue-500 hover:underline transition">Progress</button>
    <button id="bmiLink" onclick="showTab('bmiTab')" class="font-semibold text-gray-500 hover:text-blue-500 hover:underline transition">Calculator BMI</button>
  </nav>
</header>

<div id="progressTab" class="p-6 space-y-6 hidden animate-fade-in">
  {{-- Quote --}}
  @php
    $quotes = [
      "Progress is progress, no matter how small.",
      "Your body can stand almost anything. It's your mind that you have to convince.",
      "The only bad workout is the one that didn't happen.",
      "Eat clean, train dirty.",
    ];
  @endphp
  <div class="bg-indigo-50 p-6 rounded shadow text-center text-indigo-700 font-semibold italic">
    💡 {{ $quotes[array_rand($quotes)] }}
  </div>

  {{-- Riwayat --}}
  <div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Trainee Progress</h2>
    <div class="overflow-x-auto shadow-md rounded-lg border border-gray-200">
      <table class="min-w-full table-auto border-collapse">
        <tbody>
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="px-4 py-3 border font-medium text-gray-800 flex items-center justify-between">
              <p>Meal Plan</p>
              {{ $mealplanDoneCount }}
              @if($mealplanDoneCount > 0)
                <button onclick="showDetailModal('mealplan')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-sm">
                  Detail
                </button>
              @endif
            </td>
            <td class="px-4 py-3 border font-medium text-gray-800 flex items-center justify-between">
              <p>Workout</p>
              {{ $workoutDoneCount }}
              @if($workoutDoneCount > 0)
                <button onclick="showDetailModal('workout')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-sm">
                  Detail
                </button>
              @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<main id="bmiTab" class="hidden max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 p-6 animate-fade-in">
  {{-- Form --}}
  <div class="bg-white rounded-lg p-6 shadow">
    <h2 class="text-lg font-semibold mb-4">Input Data</h2>
    <form id="bmiForm" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Gender</label>
        <label><input type="radio" name="gender" value="Pria"> Man</label>
        <label class="ml-4"><input type="radio" name="gender" value="Wanita"> Woman</label>
      </div>
      <div>
        <label class="block mb-1 font-medium">Weight (kg)</label>
        <input id="weight" type="number" step="0.1" class="w-full p-2 border rounded" required>
      </div>
      <div>
        <label class="block mb-1 font-medium">Age (tahun)</label>
        <input id="age" type="number" min="18" class="w-full p-2 border rounded" required>
      </div>
      <div>
        <label class="block mb-1 font-medium">Height (cm)</label>
        <input id="height" type="number" class="w-full p-2 border rounded" required>
      </div>
      <div class="flex space-x-4 mt-4">
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Count BMI</button>
        <button type="button" onclick="resetForm()" class="border px-4 py-2 rounded">Reset</button>
      </div>
    </form>
  </div>

  {{-- Output --}}
  <div class="bg-white rounded-lg p-6 shadow">
    <h2 class="text-lg font-semibold mb-4">Result</h2>
    <div class="text-center mt-8 text-gray-800" id="bmiOutput">
      Please fill out the form below to see your BMI results.
    </div>
  </div>
</main>

{{-- Modal --}}
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4 border-b pb-2">
      <h2 id="modalTitle" class="text-xl font-semibold">Detail Progress</h2>
      <button onclick="hideDetailModal()" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
    </div>
    <div id="modalContent" class="text-gray-700">
      <p class="text-center py-4">Loading...</p>
    </div>
    <div class="mt-4 text-right">
      <button onclick="hideDetailModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full">Close</button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function showTab(tabId) {
    document.getElementById('progressTab').classList.add('hidden');
    document.getElementById('bmiTab').classList.add('hidden');
    document.getElementById('progressLink').classList.remove('text-blue-500', 'underline', 'font-semibold');
    document.getElementById('bmiLink').classList.remove('text-blue-500', 'underline', 'font-semibold');

    document.getElementById('progressLink').classList.add('text-gray-500', 'hover:text-blue-500');
    document.getElementById('bmiLink').classList.add('text-gray-500', 'hover:text-blue-500');

    document.getElementById(tabId).classList.remove('hidden');
    if (tabId === 'progressTab') {
      document.getElementById('progressLink').classList.add('text-blue-500', 'underline', 'font-semibold');
    } else {
      document.getElementById('bmiLink').classList.add('text-blue-500', 'underline', 'font-semibold');
    }
  }

  function resetForm() {
    document.getElementById('weight').value = '';
    document.getElementById('height').value = '';
    document.getElementById('age').value = '';
    document.querySelectorAll('input[name="gender"]').forEach(input => input.checked = false);
    document.getElementById('bmiOutput').innerHTML = 'Please fill out the form below to see your BMI results.';
  }

  document.getElementById('bmiForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const gender = document.querySelector('input[name="gender"]:checked')?.value || '';
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value);

    if (!weight || !height) {
      document.getElementById('bmiOutput').innerHTML = `<p class="text-red-500">Please fill in weight and height correctly.</p>`;
      return;
    }

    const heightInMeters = height / 100;
    const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);

    let category = '';
    let advice = '';
    let color = '';

    if (bmi < 18.5) {
      category = 'Lean';
      advice = 'Your weight is less than normal. Consider a healthy, balanced diet.';
      color = 'bg-blue-100 text-blue-700';
    } else if (bmi < 25) {
      category = 'Normal';
      advice = 'Your weight is ideal. Maintain a healthy lifestyle!';
      color = 'bg-green-100 text-green-700';
    } else if (bmi < 30) {
      category = 'Fat';
      advice = 'You are slightly overweight. Pay attention to your diet and exercise regularly.';
      color = 'bg-yellow-100 text-yellow-700';
    } else {
      category = 'Obesity';
      advice = 'You are in the obese category. Consultation with a health professional is recommended.';
      color = 'bg-red-100 text-red-700';
    }

    document.getElementById('bmiOutput').innerHTML = `
      <div class="text-lg font-bold">
        <span class="px-3 py-1 rounded-full ${color}">${category}</span>
      </div>
      <div class="text-4xl font-bold">${bmi}</div>
      <div class="text-sm mt-2">${advice}</div>
    `;
  });

  // Modal logic
  const detailModal = document.getElementById('detailModal');
  const modalTitle = document.getElementById('modalTitle');
  const modalContent = document.getElementById('modalContent');

  function showDetailModal(type) {
    modalContent.innerHTML = '<p class="text-center py-4">Loading...</p>';
    detailModal.classList.remove('hidden');

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
          modalContent.innerHTML = `<p class="text-center py-4">No data submitted yet.</p>`;
        } else {
          let html = '<ul class="list-disc pl-5 space-y-2">';
          data.forEach(item => {
            if (type === 'mealplan') {
              const d = new Date(item.date + 'T' + item.time);
              html += `<li><strong>${item.type} (${d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })})</strong>: ${item.meal_name} (${item.calories} kcal) on ${d.toLocaleDateString()} - Note: ${item.note || 'N/A'}</li>`;
            } else {
              const d = new Date(item.date);
              html += `<li><strong>${item.name}</strong> on ${d.toLocaleDateString()} - Category: ${item.kategori || 'N/A'} Difficulty: ${item.difficult || 'N/A'} Reps: ${item.reps || 'N/A'}</li>`;
            }
          });
          html += '</ul>';
          modalContent.innerHTML = html;
        }
      })
      .catch(() => {
        modalContent.innerHTML = `<p class="text-center py-4 text-red-500">Failed to load data.</p>`;
      });
  }

  function hideDetailModal() {
    detailModal.classList.add('hidden');
    modalContent.innerHTML = '';
  }

  detailModal.addEventListener('click', function (e) {
    if (e.target === detailModal) hideDetailModal();
  });

  window.onload = function () {
    showTab('progressTab');
  };
</script>
@endsection

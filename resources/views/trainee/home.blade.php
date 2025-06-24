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
    {{-- Motivational Quote --}}
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

    {{-- Riwayat Progress Terakhir --}}
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">Trainee Progress</h2>
      <div class="overflow-x-auto shadow-md rounded-lg border border-gray-200">
        <table class="min-w-full table-auto border-collapse">
          <tbody>
            <tr class="border-t hover:bg-gray-50 transition">
              <td class="px-4 py-3 border font-medium text-gray-800 flex items-center justify-between"><p>Meal Plan</p>
                {{ $mealplanDoneCount }}
                @if($mealplanDoneCount > 0)
                  <button onclick="showDetailModal('mealplan')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-sm">
                    Detail
                  </button>
                @endif
              </td>
              <td class="px-4 py-3 border font-medium text-gray-800 flex items-center justify-between"><p>Workout</p>
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
    <div class="bg-white rounded-lg p-6 shadow">
      <h2 class="text-lg font-semibold mb-4">Input Data</h2>
      <form method="POST" action="{{ url('/trainee/home') }}" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Gender</label>
          <label><input type="radio" name="gender" value="Pria" {{ $gender === 'Pria' ? 'checked' : '' }}> Man</label>
          <label class="ml-4"><input type="radio" name="gender" value="Wanita" {{ $gender === 'Wanita' ? 'checked' : '' }}> Woman</label>
        </div>
        <div>
          <label class="block mb-1 font-medium">Weight (kg)</label>
          <input id="weight" name="weight" type="number" step="0.1" class="w-full p-2 border rounded" value="{{ $weight }}" required>
        </div>
        <div>
          <label class="block mb-1 font-medium">Age (tahun)</label>
          <input id="age" name="age" type="number" min="18" placeholder="18 Age Minimum" class="w-full p-2 border rounded" value="{{ $age }}" required>
        </div>
        <div>
          <label class="block mb-1 font-medium">Height (cm)</label>
          <input id="height" name="height" type="number" class="w-full p-2 border rounded" value="{{ $height }}" required>
        </div>
        <div class="flex space-x-4 mt-4">
          <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Count BMI</button>
          <button type="button" onclick="resetForm()" class="border px-4 py-2 rounded">Reset</button>
        </div>
      </form>
    </div>

    <div class="bg-white rounded-lg p-6 shadow">
      <h2 class="text-lg font-semibold mb-4">Result</h2>
      <div class="text-center mt-8 text-gray-800">
        @if ($bmiResult !== null)
          <div class="text-lg font-bold">
            <span class="px-3 py-1 rounded-full
              @switch($bmiCategory)
                @case('Kurus') bg-blue-100 text-blue-700 @break
                @case('Normal') bg-green-100 text-green-700 @break
                @case('Gemuk') bg-yellow-100 text-yellow-700 @break
                @case('Obesitas') bg-red-100 text-red-700 @break
                @default bg-gray-100 text-gray-700
              @endswitch">
              {{ $bmiCategory }}
            </span>
          </div>
          <div class="text-4xl font-bold">{{ $bmiResult }}</div>
          <div class="text-sm mt-2">
            @switch($bmiCategory)
              @case('Kurus') Your weight is less than normal. Consider a healthy, balanced diet. @break
              @case('Normal') Your weight is ideal. Maintain a healthy lifestyle! @break
              @case('Gemuk') You are slightly overweight. Pay attention to your diet and exercise regularly. @break
              @case('Obesitas') You are in the obese category. Consultation with a health professional is recommended. @break
              @default
            @endswitch
          </div>
        @else
          <p class="text-gray-500">Please fill out the form below to see your BMI results.</p>
        @endif
      </div>
    </div>
  </main>

  {{-- Modal untuk Detail Progress --}}
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
  function toggleDropdown() {
    document.getElementById('profileDropdown').classList.toggle('hidden');
  }

  function showTab(tabId) {
    document.getElementById('progressTab').classList.add('hidden');
    document.getElementById('bmiTab').classList.add('hidden');

    // Remove active styles from all links
    document.getElementById('progressLink').classList.remove('text-blue-500', 'underline', 'font-semibold');
    document.getElementById('bmiLink').classList.remove('text-blue-500', 'underline', 'font-semibold');
    document.getElementById('progressLink').classList.add('text-gray-500', 'hover:text-blue-500');
    document.getElementById('bmiLink').classList.add('text-gray-500', 'hover:text-blue-500');

    // Add active styles to the clicked link and show the tab
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
  }

  window.onload = function () {
    // Ensure the initial active tab is set correctly based on the controller's passed value
    showTab(@json($activeTab));
  };

  // --- Modal Logic for Detail Progress ---
  const detailModal = document.getElementById('detailModal');
  const modalTitle = document.getElementById('modalTitle');
  const modalContent = document.getElementById('modalContent');

  function showDetailModal(type) {
    modalContent.innerHTML = '<p class="text-center py-4">Loading...</p>'; // Show loading
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
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.length === 0) {
          modalContent.innerHTML = `<p class="text-center py-4">No ${type.replace('plan', ' plan').toLowerCase()}s submitted yet.</p>`;
        } else {
          let html = '<ul class="list-disc pl-5 space-y-2">';
          data.forEach(item => {
            if (type === 'mealplan') {
              // Format date and time for better readability
              const mealDate = new Date(item.date + 'T' + item.time); // Combine date and time
              html += `<li><strong>${item.type} (${mealDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })})</strong>: ${item.meal_name} (${item.calories} kcal) on ${mealDate.toLocaleDateString()} - Note: ${item.note || 'N/A'}</li>`;
            } else if (type === 'workout') {
              const workoutDate = new Date(item.date); // Assuming workout has a 'date' field
              html += `<li><strong>${item.name}</strong> on ${workoutDate.toLocaleDateString()} - Category: ${item.kategori || 'N/A'} Difficulty: ${item.difficult || 'N/A'} Reps: ${item.reps || 'N/A'} </li>`;
            }
          });
          html += '</ul>';
          modalContent.innerHTML = html;
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        modalContent.innerHTML = `<p class="text-center py-4 text-red-500">Failed to load details. Please try again.</p>`;
      });
  }

  function hideDetailModal() {
    detailModal.classList.add('hidden');
    modalContent.innerHTML = ''; // Clear content when hidden
  }

  // Close modal if clicked outside
  detailModal.addEventListener('click', function(event) {
    if (event.target === detailModal) {
      hideDetailModal();
    }
  });
</script>
<script src="https://cdn.tailwindcss.com"></script> {{-- Pastikan TailwindCSS dimuat --}}
@endsection
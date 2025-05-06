@extends('layouts.trainee')

@section('title', 'Trainee Home')

@section('content')
  {{-- Mulai konten asli, tanpa perubahan --}}
  <header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-black">Trainee</h1>
    <nav class="space-x-6">
      <button id="progressLink" onclick="showTab('progressTab')" class="font-semibold text-gray-500 hover:text-blue-500 hover:underline transition">Progress</button>
      <button id="bmiLink" onclick="showTab('bmiTab')" class="font-semibold text-gray-500 hover:text-blue-500 hover:underline transition">Calculator BMI</button>
    </nav>
  </header>

  <div id="progressTab" class="p-6 space-y-6 hidden">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">This Week`s Summary</h2>
      <div class="grid grid-cols-2 gap-6">
        <div>
          <p class="text-gray-600">Number of Workouts</p>
          <p class="text-3xl font-bold">5</p>
        </div>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">Progress</h2>
      <canvas id="weightChart" class="w-full h-64"></canvas>
    </div>
  </div>

  <main id="bmiTab" class="hidden max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
    <div class="bg-white rounded-lg p-6 shadow">
      <h2 class="text-lg font-semibold mb-4">Input Data</h2>
      <form method="POST" action="{{ url('/trainee/home') }}" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Jenis Kelamin</label>
          <label><input type="radio" name="gender" value="Pria" {{ $gender === 'Pria' ? 'checked' : '' }}> Pria</label>
          <label class="ml-4"><input type="radio" name="gender" value="Wanita" {{ $gender === 'Wanita' ? 'checked' : '' }}> Wanita</label>
        </div>
        <div>
          <label class="block mb-1 font-medium">Berat Badan (kg)</label>
          <input id="weight" name="weight" type="number" step="0.1" class="w-full p-2 border rounded" value="{{ $weight }}" required>
        </div>
        <div>
          <label class="block mb-1 font-medium">Usia (tahun)</label>
          <input name="age" type="number" min="18" placeholder="Minimal 18 tahun" class="w-full p-2 border rounded" value="{{ $age }}" required>
        </div>
        <div>
          <label class="block mb-1 font-medium">Tinggi Badan (cm)</label>
          <input id="height" name="height" type="number" class="w-full p-2 border rounded" value="{{ $height }}" required>
        </div>
        <div class="flex space-x-4 mt-4">
          <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Hitung BMI</button>
          <button type="button" onclick="resetForm()" class="border px-4 py-2 rounded">Reset</button>
        </div>
      </form>
    </div>

    <div class="bg-white rounded-lg p-6 shadow">
      <h2 class="text-lg font-semibold mb-4">Hasil</h2>
      <div class="text-center mt-8 text-gray-800">
        @if ($bmiResult !== null)
          <div class="text-lg font-bold">{{ $bmiCategory }}</div>
          <div class="text-4xl font-bold">{{ $bmiResult }}</div>
          <div class="text-sm mt-2">
            @switch($bmiCategory)
              @case('Kurus') Berat badan Anda kurang dari normal. Pertimbangkan pola makan yang sehat dan seimbang. @break
              @case('Normal') Berat badan Anda ideal. Pertahankan pola hidup sehat! @break
              @case('Gemuk') Anda sedikit kelebihan berat badan. Perhatikan pola makan dan olahraga rutin. @break
              @case('Obesitas') Anda termasuk dalam kategori obesitas. Disarankan konsultasi dengan tenaga kesehatan. @break
              @default
            @endswitch
          </div>
        @else
          <p class="text-gray-500">Silakan isi form di samping untuk melihat hasil BMI Anda.</p>
        @endif
      </div>
    </div>
  </main>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @php
    $weightData = [70, 69.5, 69, 68.7];
    if (!empty($weight)) {
        $weightData[] = (float) $weight;
    }
  @endphp
  <script>
    function toggleDropdown() {
      document.getElementById('profileDropdown').classList.toggle('hidden');
    }

    function showTab(tabId) {
      document.getElementById('progressTab').classList.add('hidden');
      document.getElementById('bmiTab').classList.add('hidden');
      document.getElementById(tabId).classList.remove('hidden');

      const progressLink = document.getElementById('progressLink');
      const bmiLink = document.getElementById('bmiLink');

      progressLink.classList.remove('text-blue-500', 'underline', 'font-semibold');
      bmiLink.classList.remove('text-blue-500', 'underline', 'font-semibold');

      progressLink.classList.add('text-gray-500', 'hover:text-blue-500');
      bmiLink.classList.add('text-gray-500', 'hover:text-blue-500');

      if (tabId === 'progressTab') {
        progressLink.classList.add('text-blue-500', 'underline', 'font-semibold');
      } else {
        bmiLink.classList.add('text-blue-500', 'underline', 'font-semibold');
      }
    }

    function resetForm() {
      document.getElementById('weight').value = '';
      document.getElementById('height').value = '';
      document.getElementById('age').value = '';
      document.querySelectorAll('input[name="gender"]').forEach(input => input.checked = false);
    }

    window.onload = function () {
      showTab(@json($activeTab));

      const weightData = @json($weightData);
      const ctx = document.getElementById('weightChart')?.getContext('2d');

      if (ctx) {
        new Chart(ctx, {
          
          options: {
            responsive: true,
            scales: {
              y: { beginAtZero: false }
            }
          }
        });
      }
    };
  </script>
@endsection

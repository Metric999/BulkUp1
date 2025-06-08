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
    {{-- Summary Mingguan --}}
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">This Week's Summary</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-blue-50 p-4 rounded shadow text-center">
          <p class="text-sm text-gray-600">Kalori Terbakar</p>
          <p class="text-2xl font-bold text-blue-600">{{ $weeklyCaloriesBurned ?? '1500' }} kcal</p>
        </div>
        <div class="bg-green-50 p-4 rounded shadow text-center">
          <p class="text-sm text-gray-600">Rata-rata Durasi</p>
          <p class="text-2xl font-bold text-green-600">{{ $averageDuration ?? '45' }} menit</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded shadow text-center">
          <p class="text-sm text-gray-600">Penurunan Berat</p>
          <p class="text-2xl font-bold text-yellow-600">{{ $weightLoss ?? '1.3' }} kg</p>
        </div>
        <div class="text-center">
          <p class="text-sm text-gray-600">Jumlah Workout</p>
          <p class="text-3xl font-bold">{{ $workoutCount ?? '5' }}</p>
        </div>
      </div>
    </div>

    {{-- Motivational Quote --}}
    @php
      $quotes = [
        "Progress is progress, no matter how small.",
        "Konsistensi lebih penting daripada kecepatan.",
        "Satu langkah lebih dekat ke tujuanmu.",
        "Tetap semangat dan jangan menyerah!",
        "Latihan hari ini adalah kemenangan untuk besok.",
      ];
    @endphp
    <div class="bg-indigo-50 p-6 rounded shadow text-center text-indigo-700 font-semibold italic">
      💡 {{ $quotes[array_rand($quotes)] }}
    </div>

    {{-- Riwayat Progress Terakhir --}}
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">Recent Progress</h2>
      @if(!empty($recentSubmissions) && count($recentSubmissions) > 0)
        <div class="space-y-4 max-h-64 overflow-y-auto">
          @foreach ($recentSubmissions as $submission)
            <div class="bg-gray-100 rounded-lg p-4 shadow flex justify-between items-center">
              <div>
                <div class="font-semibold text-lg">{{ \Carbon\Carbon::parse($submission->created_at)->format('d M Y') }}</div>
                <div class="text-sm text-gray-600">
                  Berat: {{ $submission->weight }} kg | Workout: {{ $submission->workout_name ?? 'N/A' }}
                </div>
              </div>
              <div class="text-sm text-blue-600">{{ $submission->status ?? 'Completed' }}</div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-gray-500">No progress data available.</p>
      @endif
    </div>

    {{-- Achievement Badges --}}
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">Achievements</h2>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @php
          $achievements = [
            ['title' => 'Workout Pertama', 'icon' => '🥉', 'color' => 'yellow'],
            ['title' => '5 Hari Berturut-turut', 'icon' => '🥈', 'color' => 'green'],
            ['title' => 'Turun 1kg dalam 1 minggu', 'icon' => '🥇', 'color' => 'blue'],
          ];
        @endphp
        @foreach ($achievements as $achievement)
          <div class="bg-{{ $achievement['color'] }}-100 p-4 rounded-lg text-center shadow cursor-default select-none">
            <div class="text-2xl">{{ $achievement['icon'] }}</div>
            <div class="font-semibold mt-2">{{ $achievement['title'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <main id="bmiTab" class="hidden max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 p-6 animate-fade-in">
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
          <input id="age" name="age" type="number" min="18" placeholder="Minimal 18 tahun" class="w-full p-2 border rounded" value="{{ $age }}" required>
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
  };
</script>
@endsection

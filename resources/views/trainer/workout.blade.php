<?php
session_start();

// Daftar trainee
$trainees = [
    ["id" => "1", "name" => "Andre"],
    ["id" => "2", "name" => "Marwan"],
    ["id" => "3", "name" => "Raymond"],
];

// Kelola trainee terpilih
if (isset($_POST['trainee_id'])) {
    $selectedTrainee = $_POST['trainee_id'];
    $_SESSION['selected_trainee'] = $selectedTrainee;
} elseif (isset($_SESSION['selected_trainee'])) {
    $selectedTrainee = $_SESSION['selected_trainee'];
} else {
    $selectedTrainee = $trainees[0]['id'];
}

$daysOfWeek = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];

// Fungsi embed video
function getEmbedUrl($url) {
    if (preg_match('#youtube\.com/watch\?v=([^&]+)#', $url, $m)) return "https://www.youtube.com/embed/{$m[1]}";
    if (preg_match('#youtu\.be/([^?&]+)#', $url, $m)) return "https://www.youtube.com/embed/{$m[1]}";
    if (preg_match('#vimeo\.com/(\d+)#', $url, $m)) return "https://player.vimeo.com/video/{$m[1]}";
    return $url;
}

// Inisialisasi session workouts
if (!isset($_SESSION['workouts'])) $_SESSION['workouts'] = [];
$workouts = &$_SESSION['workouts'][$selectedTrainee];

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $tid = $_POST['trainee_id'];
    $day = $_POST['day'];
    $index = $_POST['index'] ?? null;

    if ($action === 'add') {
        $workouts[$day][] = [
            'name'      => $_POST['name'],
            'kategori'  => $_POST['kategori'],
            'difficult' => $_POST['difficult'],
            'reps'      => $_POST['reps'],
            'videoUrl'  => $_POST['videoUrl'],
        ];
    }
    elseif ($action === 'edit' && $index !== null) {
        $workouts[$day][$index] = [
            'name'      => $_POST['name'],
            'kategori'  => $_POST['kategori'],
            'difficult' => $_POST['difficult'],
            'reps'      => $_POST['reps'],
            'videoUrl'  => $_POST['videoUrl'],
        ];
    }
    elseif ($action === 'delete' && $index !== null) {
        unset($workouts[$day][$index]);
        $workouts[$day] = array_values($workouts[$day]);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Nama trainee
$traineeName = 'unknond';
foreach ($trainees as $t) {
    if ($t['id'] === $selectedTrainee) { $traineeName = $t['name']; break; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workout Plan - Trainer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    // JavaScript untuk toggle dropdown
    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

  <!-- Navbar -->
  <header class="bg-[#1f2937] px-6 py-4 flex items-center justify-between shadow-md">
    <!-- Brand -->
    <div class="text-white text-2xl font-bold">Bulk<span class="text-blue-400">Up</span></div>

    <!-- Navigation Menu -->
    <div class="flex items-center space-x-6">
    <a href="home" class="<?= basename($_SERVER['PHP_SELF']) == 'home' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Home</a>
  <a href="workout" class="<?= basename($_SERVER['PHP_SELF']) == 'workout' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Workout</a>
  <a href="mealplan" class="<?= basename($_SERVER['PHP_SELF']) == 'mealplan.' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Mealplan</a>
  <a href="progress" class="<?= basename($_SERVER['PHP_SELF']) == 'progress' ? 'text-blue-500 underline font-semibold' : 'text-white hover:text-gray-300' ?>">Progress</a>
      <div class="relative cursor-pointer">

      <!-- Profile Dropdown -->
      <div class="relative">
        <div onclick="toggleDropdown()" class="text-white text-xl cursor-pointer">👤</div>
        <div id="profileDropdown" class="absolute right-0 mt-2 hidden bg-gray-700 rounded shadow-md p-4 space-y-2 z-10 w-40">
        <a href="profile_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Profile</a>
          <a href="notif_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Notifications</a>
          <a href="feedback_trainer.php" class="flex items-center space-x-2 hover:underline text-white">Feedback</a>
          <a href="#" class="flex items-center space-x-2 hover:underline text-white">Log Out</a>
        </div>
      </div>
    </div>
  </header>

  <div class="w-full px-6 py-8 space-y-8">
    <h1 class="text-3xl font-bold">Workout Plan - Trainer</h1>

    <!-- Pilih Trainee -->
    <form method="POST" class="mb-6">
      <label class="block mb-2 font-semibold">Select Trainee:</label>
      <select name="trainee_id" onchange="this.form.submit()" class="w-full p-2 border rounded-md max-w-sm">
        <?php foreach ($trainees as $t): ?>
          <option value="<?= $t['id'] ?>" <?= $selectedTrainee === $t['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($t['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </form>

    <!-- Form Tambah Workout -->
    <div class="bg-white p-6 rounded shadow">
      <h2 class="text-xl font-semibold mb-4">Add Workout for <?= htmlspecialchars($traineeName) ?></h2>
      <form method="POST" class="grid grid-cols-2 gap-4">
        <input type="hidden" name="trainee_id" value="<?= $selectedTrainee ?>">
        <input type="hidden" name="action" value="add">
        <select name="day" class="col-span-2 p-2 border rounded-md">
          <?php foreach ($daysOfWeek as $d): ?>
            <option value="<?= $d ?>"><?= $d ?></option>
          <?php endforeach; ?>
        </select>
        <input type="text" name="name" placeholder="Workout Name" required class="p-2 border rounded">
        <input type="text" name="kategori" placeholder="Category" required class="p-2 border rounded">
        <input type="text" name="difficult" placeholder="Difficulty" required class="p-2 border rounded">
        <input type="text" name="reps" placeholder="Reps (e.g. 3x12)" required class="p-2 border rounded">
        <input type="text" name="videoUrl" placeholder="Video URL" class="col-span-2 p-2 border rounded">
        <button type="submit" class="col-span-2 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Add Workout</button>
      </form>
    </div>

    <!-- Daftar Workout per Hari -->
    <div class="space-y-6">
      <?php foreach ($daysOfWeek as $d): ?>
        <div class="bg-white p-6 rounded shadow">
          <h3 class="text-xl font-bold mb-2"><?= $d ?></h3>
          <?php if (empty($workouts[$d])): ?>
            <p class="text-gray-500">No workouts for this day.</p>
          <?php else: ?>
            <?php foreach ($workouts[$d] as $i => $w): ?>
              <div class="mt-4 border-t pt-4">
                <p class="font-semibold text-lg"><?= htmlspecialchars($w['name']) ?></p>
                <p class="text-sm">Category: <?= htmlspecialchars($w['kategori']) ?></p>
                <p class="text-sm">Difficulty: <?= htmlspecialchars($w['difficult']) ?></p>
                <p class="text-sm">Reps: <?= htmlspecialchars($w['reps']) ?></p>
                <div class="flex gap-4 text-sm font-medium mt-2">
                  <button onclick="openEditModal('<?= $d ?>', <?= $i ?>, '<?= htmlspecialchars(addslashes($w['name'])) ?>', '<?= htmlspecialchars(addslashes($w['kategori'])) ?>', '<?= htmlspecialchars(addslashes($w['difficult'])) ?>', '<?= htmlspecialchars(addslashes($w['reps'])) ?>', '<?= htmlspecialchars(addslashes($w['videoUrl'])) ?>')"
                          class="text-blue-600 hover:underline">Edit</button>
                  <form method="POST"> <!-- Delete form -->
                    <input type="hidden" name="trainee_id" value="<?= $selectedTrainee ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="day" value="<?= $d ?>">
                    <input type="hidden" name="index" value="<?= $i ?>">
                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline text-sm">Delete</button>
                  </form>
                </div>
                <?php if (!empty($w['videoUrl'])): ?>
                  <div class="aspect-video mt-2">
                    <iframe src="<?= getEmbedUrl($w['videoUrl']) ?>" class="w-full h-full rounded" frameborder="0" allowfullscreen></iframe>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Edit Workout</h2>
        <form method="POST" class="space-y-4">
          <input type="hidden" name="trainee_id" value="<?= $selectedTrainee ?>">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="day" id="modal_day">
          <input type="hidden" name="index" id="modal_index">
          <div>
            <label class="block font-medium">Workout Name</label>
            <input type="text" name="name" id="modal_name" required class="w-full p-2 border rounded">
          </div>
          <div>
            <label class="block font-medium">Category</label>
            <input type="text" name="kategori" id="modal_kategori" required class="w-full p-2 border rounded">
          </div>
          <div>
            <label class="block font-medium">Difficulty</label>
            <input type="text" name="difficult" id="modal_difficult" required class="w-full p-2 border rounded">
          </div>
          <div>
            <label class="block font-medium">Reps</label>
            <input type="text" name="reps" id="modal_reps" required class="w-full p-2 border rounded">
          </div>
          <div>
            <label class="block font-medium">Video URL</label>
            <input type="text" name="videoUrl" id="modal_videoUrl" class="w-full p-2 border rounded">
          </div>
          <div class="flex justify-end gap-2">
            <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
          </div>
        </form>
      </div>
    </div>

  </div>
  <script>
    function openEditModal(day, index, name, kategori, difficult, reps, videoUrl) {
      document.getElementById('modal_day').value = day;
      document.getElementById('modal_index').value = index;
      document.getElementById('modal_name').value = name;
      document.getElementById('modal_kategori').value = kategori;
      document.getElementById('modal_difficult').value = difficult;
      document.getElementById('modal_reps').value = reps;
      document.getElementById('modal_videoUrl').value = videoUrl;
      const modal = document.getElementById('editModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
    function closeEditModal() {
      const modal = document.getElementById('editModal');
      modal.classList.add('hidden');
    }
  </script>
</body>
</html>

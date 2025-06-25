<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainer Invite Code - BulkUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

  <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Trainer Invitation Code</h2>

    <p class="text-gray-600 text-sm mb-6">
      If you want to register as a <span class="font-semibold text-blue-600">Trainer</span>, please contact the number or email available on the <a href="/contact" class="text-blue-500 underline">Contact</a> page. 
      After getting the invitation code, enter the code below to continue the registration process as a Trainer.
    </p>
    <button onclick="showDetailModal()" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-sm mb-4">
  Requirements
</button>

    {{-- Modal untuk Persyaratan --}}
  <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3 max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center mb-4 border-b pb-2">
        <h2 id="modalTitle" class="text-xl font-semibold">Requirements to become a trainer</h2>
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

    <form method="POST" action="{{ route('trainer.invite.verify') }}">
      @csrf
      <div class="mb-4">
        <label for="invite_code" class="block text-gray-700 font-semibold mb-1">Invite Code</label>
        <input type="text" id="invite_code" name="invite_code" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               value="{{ old('invite_code') }}">
        @error('invite_code')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
        Submit Code
      </button>
    </form>
  </div>

  <!-- Alert on success -->
  @if (session('success'))
  <script>
    window.onload = function () {
      alert({!! json_encode(session('success')) !!});
      window.location.href = "{{ route('trainer.register.form') }}";
    }
  </script>
  @endif
  <script>
  function showDetailModal() {
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('modalContent').innerHTML = `
      <ul class="list-disc list-inside space-y-2">
        <li>Have a valid fitness training certification</li>
        <li>Minimum 1 year experience in guiding clients</li>
        <li>Able to create workout plans and meal plans</li>
        <li>Willing to attend internal training on the BulkUp platform</li>
      </ul>
    `;
  }

  function hideDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
  }
</script>
</body>
</html>

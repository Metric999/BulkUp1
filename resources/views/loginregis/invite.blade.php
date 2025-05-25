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

</body>
</html>

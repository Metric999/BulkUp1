<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <title>Register - BulkUp</title>
</head>
<body class="flex flex-col md:flex-row h-screen font-[Poppins]">

  <!-- Left Side -->
  <div class="w-full md:w-1/2 bg-[#1f2937] text-white flex flex-col justify-center px-6 sm:px-10 py-10">
    <h1 class="text-3xl sm:text-4xl font-bold mb-4">Welcome to BulkUp</h1>
    <p class="text-base sm:text-xl">Ready to build your dream body? Join now and start your journey!</p>
  </div>

  <!-- Right Side -->
  <div class="w-full md:w-1/2 bg-gray-400 flex flex-col justify-center items-center px-6 sm:px-10 py-10">
    <h2 class="text-white text-2xl sm:text-3xl font-bold mb-6">REGISTER</h2>
    <form class="w-full max-w-md flex flex-col" method="POST" action="{{ route('register') }}">
      @csrf
      @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
          {{ $errors->first() }}
        </div>
      @endif

      <input type="text" name="username" placeholder="Enter Username" class="mb-4 px-4 py-2 rounded" required>
      <input type="password" name="password" placeholder="Enter Password" class="mb-4 px-4 py-2 rounded" required>
      <input type="email" name="email" placeholder="Enter Email" class="mb-4 px-4 py-2 rounded" required>
      <button type="submit" class="bg-white text-black px-6 py-2 rounded font-semibold hover:bg-indigo-500 transition">REGISTER</button>

      <p class="text-white mt-4 text-sm">Already have an account? <a href="{{ route('login') }}" class="underline">Login</a></p>
    </form>
  </div>

</body>
</html>

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
    <p class="text-base sm:text-xl">Ready to build your dream body? Join now and start your bulking journey with BulkUp!</p>
  </div>

  <!-- Right Side -->
<div class="w-full md:w-1/2 bg-gray-400 flex flex-col justify-center items-center px-6 sm:px-10 py-10">
  <h2 class="text-white text-2xl sm:text-3xl font-bold mb-6">REGISTER AS TRAINEE</h2>

  @if ($errors->any())
    <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4 w-full max-w-md">
      <ul class="list-disc pl-4">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="w-full max-w-md flex flex-col" method="POST" action="{{ route('trainee.register.submit') }}">
    @csrf
    <input type="text" name="username" placeholder="Enter Username" class="mb-4 px-4 py-2 rounded" required>
    <input type="password" name="password" placeholder="Enter Password" class="mb-4 px-4 py-2 rounded" required>
    <input type="email" name="email" placeholder="Enter Email" class="mb-4 px-4 py-2 rounded" required>
    <button type="submit" class="bg-white text-black px-6 py-2 rounded font-semibold hover:bg-indigo-500 transition">
      REGISTER
    </button>
  </form>
</div>


</body>
</html>

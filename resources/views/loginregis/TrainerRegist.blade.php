<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <title>Register - BulkUp</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #1F2937;
    }
    input:focus {
      outline: none;
      border-color: #3B82F6;
      box-shadow: 0 0 8px rgba(59,130,246,0.6);
      transition: all 0.3s ease;
    }
    button:hover {
      box-shadow: 0 0 14px #3B82F6;
      transition: box-shadow 0.3s ease;
    }
  </style>
</head>
<body class="flex flex-col md:flex-row h-screen">

  <!-- Left Side -->
  <div class="w-full md:w-1/2 bg-gradient-to-br from-[#111827] to-[#1E293B] text-white flex flex-col justify-center px-10 py-16">
    <h1 class="text-4xl font-extrabold mb-5 leading-snug">
      Welcome to <span class="text-blue-500">BulkUp</span>
    </h1>
    <p class="text-lg max-w-md leading-relaxed mb-10">
      Ready to build your dream body? Join now and start your <span class="font-semibold text-blue-400">bulking journey</span> with BulkUp!
    </p>
  </div>

  <!-- Right Side Register Form -->
  <div class="w-full md:w-1/2 bg-[#1F2937] flex justify-center items-center px-10 py-16">
    <div class="w-full max-w-md bg-[#111827] rounded-lg p-10 shadow-lg">

      <h2 class="text-white text-3xl font-bold mb-10 text-center tracking-wide">REGISTER AS TRAINER</h2>

      @if ($errors->any())
        <div class="bg-red-600 text-red-100 px-4 py-3 rounded mb-6">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('trainer.register.submit') }}" class="space-y-6">
        @csrf

        <label class="relative block">
          <input
            type="text"
            name="username"
            placeholder="Enter Username"
            required
            class="w-full rounded-md bg-gray-700 text-white px-4 py-3 placeholder-gray-400 focus:ring-0 focus:border-blue-500"
          />
        </label>

        <label class="relative block">
          <input
            type="password"
            name="password"
            placeholder="Enter Password"
            required
            class="w-full rounded-md bg-gray-700 text-white px-4 py-3 placeholder-gray-400 focus:ring-0 focus:border-blue-500"
          />
        </label>

        <label class="relative block">
          <input
            type="email"
            name="email"
            placeholder="Enter Email"
            required
            class="w-full rounded-md bg-gray-700 text-white px-4 py-3 placeholder-gray-400 focus:ring-0 focus:border-blue-500"
          />
        </label>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition shadow-md"
        >
          REGISTER
        </button>
      </form>

    </div>
  </div>

</body>
</html>

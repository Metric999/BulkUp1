<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <title>Login - BulkUp</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #1F2937; /* Dark background */
    }
    /* Input focus style */
    input:focus,
    select:focus {
      outline: none;
      border-color: #3B82F6; /* Tailwind blue-500 */
      box-shadow: 0 0 8px rgba(59, 130, 246, 0.6);
      transition: all 0.3s ease;
    }
    /* Button hover glow */
    button:hover {
      box-shadow: 0 0 12px #3B82F6;
      transition: box-shadow 0.3s ease;
    }
  </style>
</head>
<body class="flex flex-col md:flex-row h-screen">

  <!-- Left Side with illustration and welcome -->
  <section
    class="w-full md:w-1/2 bg-[#111827] text-white flex flex-col justify-center px-6 sm:px-10 py-10 sm:py-16 relative overflow-hidden"
  >
    <h1 class="text-3xl sm:text-4xl font-bold mb-4">
      Welcome Back to BulkUp
    </h1>
    <p class="text-base sm:text-lg mb-8 max-w-lg leading-relaxed">
      Let's keep pushing toward your dream body! Stay consistent, stay strong.
      💪
    </p>

    <!-- Fitness SVG icon, hidden on mobile -->
    <svg
      class="hidden sm:block w-24 sm:w-40 h-24 sm:h-40 opacity-20 absolute bottom-10 right-10"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      viewBox="0 0 24 24"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6"
      />
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 20h12" />
    </svg>
  </section>

  <!-- Right Side Login Form -->
  <section
    class="w-full md:w-1/2 bg-[#1F2937] flex flex-col justify-center items-center px-6 sm:px-10 py-10 sm:py-16"
  >
    <div class="w-full max-w-md bg-[#111827] rounded-lg p-6 sm:p-10 shadow-lg">
      <h2 class="text-white text-3xl font-bold mb-8 text-center">Login</h2>

      <form class="flex flex-col" method="POST" action="{{ route('login.process') }}">
        @csrf

        @if ($errors->any())
          <div class="bg-red-600 text-red-100 px-4 py-2 mb-6 rounded">
            {{ $errors->first() }}
          </div>
        @endif

        <!-- Username -->
        <label class="relative block mb-5">
          <span class="sr-only">Username</span>
          <input
            type="text"
            name="username"
            placeholder="Enter Username"
            required
            class="w-full rounded-md bg-gray-700 text-white px-12 py-3 placeholder-gray-400 focus:ring-0 focus:border-blue-500"
          />
          <svg
            class="absolute left-4 top-3.5 w-6 h-6 text-blue-400 pointer-events-none"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M5.121 17.804A6 6 0 1118 6.121m-6 6v.01"
            />
          </svg>
        </label>

        <!-- Password -->
        <label class="relative block mb-5">
          <span class="sr-only">Password</span>
          <input
            type="password"
            name="password"
            placeholder="Enter Password"
            required
            class="w-full rounded-md bg-gray-700 text-white px-12 py-3 placeholder-gray-400 focus:ring-0 focus:border-blue-500"
          />
          <svg
            class="absolute left-4 top-3.5 w-6 h-6 text-blue-400 pointer-events-none"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2c0 .557.302 1.037.754 1.528A2.992 2.992 0 0112 13a2.992 2.992 0 011.246-1.472A2.99 2.99 0 0112 11z"
            />
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 11v6a4 4 0 01-8 0v-6" />
          </svg>
        </label>

        <!-- Role -->
        <label class="block mb-6">
          <select
            name="role"
            required
            class="w-full rounded-md bg-gray-700 text-white px-4 py-3 focus:ring-0 focus:border-blue-500"
          >
            <option value="" disabled selected>Select Role</option>
            <option value="trainer">Trainer</option>
            <option value="trainee">Trainee</option>
          </select>
        </label>

        <!-- Submit button -->
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition shadow-md"
        >
          Login
        </button>

        <!-- Motivational text -->
        <p class="text-gray-300 text-center mt-4 italic text-sm">
          Stay consistent, and progress will follow!
        </p>

        <!-- Divider -->
        <hr class="my-8 border-gray-600" />

        <!-- Register link -->
        <p class="text-gray-300 text-center text-sm">
          Don't have an account?
          <a href="{{ route('trainee.register.form') }}" class="text-blue-500 hover:underline">Register</a>
        </p>
      </form>
    </div>
  </section>
</body>
</html>

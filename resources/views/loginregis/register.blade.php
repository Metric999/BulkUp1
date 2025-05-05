<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <title>Register - BulkUp</title>
</head>
<body class="flex h-screen font-[Poppins]">
  <div class="w-1/2 bg-[#1f2937] text-white flex flex-col justify-center px-16">
    <h1 class="text-4xl font-bold mb-4">Welcome to BulkUp</h1>
    <p class="text-xl">Ready to build your dream body? Join now and start your bulking journey with BulkUp!</p>
  </div>
  <div class="w-1/2 bg-gray-400 flex flex-col justify-center items-center px-10">
    <h2 class="text-white text-3xl font-bold mb-6">REGISTER</h2>
    <form class="w-full max-w-md flex flex-col" method="POST">
      <input type="text" name="username" placeholder="Enter Username" class="mb-4 px-4 py-2 rounded" required>
      <input type="password" name="password" placeholder="Enter Password" class="mb-4 px-4 py-2 rounded" required>
      <input type="email" name="email" placeholder="Enter Email" class="mb-4 px-4 py-2 rounded" required>
      <button type="submit" class="bg-white text-black px-6 py-2 rounded font-semibold hover:bg-indigo-500 transition">REGISTER</button>
    </form>
  </div>
</body>
</html>

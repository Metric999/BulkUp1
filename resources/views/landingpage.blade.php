<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BulkUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    
  </style>
</head>
<body class="bg-red-800 text-white w-full h-full">

  <!-- Navbar -->
  <nav id="navbar" class="fixed top-5 left-10 flex items-center justify-between w-[90%] z-50 transition-transform duration-300">
    <div class="text-xl font-bold">BulkUp</div>
    <div class="flex gap-8">
      <a href="#home" class="nav-link font-semibold hover:text-black transition">Home</a>
      <a href="#about" class="nav-link font-semibold hover:text-black transition">About</a>
      <a href="#contact" class="nav-link font-semibold hover:text-black transition">Contact</a>
    </div>
    <a href="loginregis/login" class="bg-white text-red-800 px-6 py-2 rounded-full font-bold hover:text-black transition">Sign Up</a>
  </nav>

  <!-- Home -->
<section id="home" class="relative min-h-screen flex flex-col justify-center items-start px-10 md:px-40 pt-32 overflow-hidden">
  <!-- Background image -->
  <div class="absolute inset-0 z-0">
    <img src="https://klinikpelitasehat.com/uploads/post/apa-itu-bulking.jpg" 
         alt="Background" 
         class="w-full h-full object-cover brightness-50">
  </div>

  <!-- Content -->
  <div class="relative z-10">
    <h1 class="text-4xl md:text-6xl font-bold mb-4">Hello, Welcome to BulkUp</h1>
    <p class="text-lg md:text-xl">Ready to build your dream body? Join now and</p>
    <p class="text-lg md:text-xl mb-6">start your bulking journey with BulkUp!</p>
    <a href="login" class="bg-white text-black px-6 py-3 rounded-full font-semibold hover:text-red-800 transition">Get Started</a>
  </div>
</section>


  <!-- About -->
  <section id="about" class="bg-gray-900 text-white min-h-screen flex flex-col justify-center items-start px-10 md:px-40 pt-32">
    <div class="flex flex-col md:flex-row items-center gap-10">
      <div>
        <img src="Screenshot 2025-04-18 190600.png" alt="BulkUp Logo" class="w-64 rounded">
      </div>
      <div class="max-w-xl text-lg leading-relaxed">
        <p class="text-2xl md:text-1xl font-bold mb-2">
          BulkUp is a daily workout app designed to help you shape your ideal body and stay consistent with your workout routine.
          With flexible and structured workout features, BulkUp is ready to accompany you every step of your physical transformation — 
          from beginner to seasoned athlete.
        </p>
      </div>
    </div>
  </section>

  <!-- Contact -->
<section id="contact" class="bg-gray-900 text-white py-16 px-6 md:px-20">
  <div class="grid md:grid-cols-3 gap-10">
    <div>
      <h3 class="text-xl font-bold mb-4">Thanks for Training with BulkUp</h3>
      <p class="mb-2">Thank you for using BulkUp – the daily workout app to help you stay consistent, healthy and strong. Join and start your body transformation today.</p>
      <p><strong>Stay strong 💪. Consistency is key!</strong></p>
    </div>
    <div>
      <h3 class="text-xl font-bold mb-4">Quick links</h3>
      <ul class="space-y-2">
        <li><a href="#home" class="hover:underline">➤ Home</a></li>
        <li><a href="login.php" class="hover:underline">➤ Workouts</a></li>
        <li><a href="login.php" class="hover:underline">➤ Progress</a></li>
        <li><a href="login.php" class="hover:underline">➤ MealPlan</a></li>
      </ul>
    </div>
    <div>
      <h3 class="text-xl font-bold mb-4">Contact Info</h3>
      <p class="mb-2">📱 <strong>WhatsApp:</strong> +62 812-3456-7890</p>
      <p class="mb-2">📧 <strong>Email:</strong> bulkup.support@gmail.com</p>
      <p>📍 <strong>Address:</strong> Batam, Indonesia</p>
    </div>
  </div>
</section>

  <!-- JS: Scroll Hide Navbar + Active Link Highlight -->
  <script>
    const navbar = document.getElementById("navbar");
    const navLinks = document.querySelectorAll(".nav-link");
    const sections = document.querySelectorAll("section");

    let lastScrollTop = 0;

    window.addEventListener("scroll", () => {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      // Show/hide navbar
      if (scrollTop > lastScrollTop) {
        navbar.style.transform = "translateY(-100%)";
      } else {
        navbar.style.transform = "translateY(0)";
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

      // Active section highlight
      let current = "";
      sections.forEach((section) => {
        const sectionTop = section.offsetTop - 120;
        if (scrollTop >= sectionTop) {
          current = section.getAttribute("id");
        }
      });

      navLinks.forEach((link) => {
        link.classList.remove("text-black");
        if (link.getAttribute("href").includes(current)) {
          link.classList.add("text-black");
        }
      });
    });
  </script>

</body>
</html>
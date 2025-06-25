<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BulkUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    /* Simple fade-in */
    .fade-in {
      opacity: 0;
      transition: opacity 0.6s ease-out;
    }
    .fade-in.visible {
      opacity: 1;
    }
    /* FAQ expand animation */
    details > summary {
      cursor: pointer;
      list-style: none;
    }
    details[open] > summary::after {
      content: "▲";
      float: right;
      transition: transform 0.3s ease;
    }
    details > summary::after {
      content: "▼";
      float: right;
      transition: transform 0.3s ease;
    }
    /* Nav link hover animation */
    .nav-link {
      position: relative;
      transition: color 0.3s ease;
    }
    .nav-link::after {
      content: "";
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -3px;
      left: 0;
      background-color: #3B82F6; /* blue-500 */
      transition: width 0.3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    /* Button hover scale and shadow */
    .btn-animate:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(59, 130, 246, 0.5);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
  </style>
</head>
<body class="bg-[#1F2937] text-white w-full min-h-screen">

  <!-- Navbar -->
  <nav id="navbar" class="fixed top-0 left-0 w-full z-50 px-6 md:px-10 py-4 flex items-center justify-between bg-[#111827] shadow-md">
    <div class="text-2xl font-bold text-white">BulkUp</div>

    <!-- Mobile menu button -->
    <button id="menu-btn" class="md:hidden focus:outline-none text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Links -->
    <div id="menu" class="hidden md:flex md:items-center justify-between w-[68%] z-50 gap-6 text-white">
      <a href="#home" class="nav-link font-semibold hover:text-blue-400 transition">Home</a>
      <a href="#about" class="nav-link font-semibold hover:text-blue-400 transition">About</a>
      <a href="#faq" class="nav-link font-semibold hover:text-blue-400 transition">FAQ</a>
      <a href="#contact" class="nav-link font-semibold hover:text-blue-400 transition">Contact</a>
      <a href="loginregis/login" class="bg-blue-600 text-white px-5 py-2 rounded-full font-bold hover:bg-blue-700 transition btn-animate">Sign In</a>
    </div>
  </nav>

  <!-- Home -->
  <section id="home" class="relative min-h-screen flex items-center px-6 md:px-40 pt-28 fade-in" style="transition-delay: 0.2s;">
    <div class="absolute inset-0 -z-10">
      <img src="https://klinikpelitasehat.com/uploads/post/apa-itu-bulking.jpg" 
           alt="Background" 
           class="w-full h-full object-cover brightness-50 transition-transform duration-500 hover:scale-105" />
    </div>
    <div class="z-10 max-w-2xl">
      <h1 class="text-4xl md:text-6xl font-bold mb-4">Hello, Welcome to BulkUp</h1>
      <p class="text-lg md:text-xl">Ready to build your dream body? Join now and</p>
      <p class="text-lg md:text-xl mb-6">start your bulking journey with BulkUp!</p>
      <div class="flex gap-4 flex-wrap">
        <a href="/loginregis/login" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition btn-animate">Get Started</a>
        <a href="/loginregis/invite" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition btn-animate">Register as Trainer</a>
      </div>
    </div>
  </section>

  <!-- About -->
<section id="about" class="bg-[#111827] text-white py-20 px-6 md:px-20 lg:px-40">
  <div class="flex flex-col md:flex-row items-center justify-center gap-10 md:gap-16 lg:gap-20">
    {{-- Mengubah ukuran gambar agar lebih besar dan responsif --}}
    <img src="Screenshot 2025-04-18 190600.png" alt="BulkUp Logo" 
         class="w-48 sm:w-56 md:w-64 lg:w-80 xl:w-96 rounded-lg mx-auto md:mx-0 fade-in object-contain" 
         style="transition-delay: 0.4s;" />
    
    <div class="max-w-full md:max-w-3xl lg:max-w-4xl text-lg leading-relaxed text-center md:text-left fade-in" 
         style="transition-delay: 0.6s;">
      {{-- Mengubah ukuran teks agar lebih besar dan memenuhi ruang --}}
      <p class="text-xl sm:text-1xl md:text-2xl lg:text-3xl font-bold mb-4">
        BulkUp is a daily workout app designed to help you shape your ideal body and stay consistent with your workout routine.
        With flexible and structured workout features, BulkUp is ready to accompany you every step of your physical transformation — 
        from beginner to seasoned athlete.
      </p>
    </div>
  </div>
</section>

  <!-- FAQ -->
  <section id="faq" class="bg-[#1F2937] py-16 px-6 md:px-40">
    <h2 class="text-3xl font-bold mb-10 text-center text-blue-400 fade-in" style="transition-delay: 0.8s;">Frequently Asked Questions</h2>
    <div class="max-w-4xl mx-auto space-y-6">
      <details class="bg-[#111827] rounded-md p-5 cursor-pointer group transition-all duration-300 ease-in-out" open>
        <summary class="font-semibold text-lg text-blue-300 group-open:text-blue-400">What is BulkUp?</summary>
        <p class="mt-2 text-gray-300">BulkUp is a daily workout app to help you stay consistent and build your ideal body with structured workout plans.</p>
      </details>
      <details class="bg-[#111827] rounded-md p-5 cursor-pointer group transition-all duration-300 ease-in-out">
        <summary class="font-semibold text-lg text-blue-300 group-open:text-blue-400">Is BulkUp suitable for beginners?</summary>
        <p class="mt-2 text-gray-300">Yes! BulkUp offers workouts for all levels, from beginners to advanced athletes.</p>
      </details>
      <details class="bg-[#111827] rounded-md p-5 cursor-pointer group transition-all duration-300 ease-in-out">
        <summary class="font-semibold text-lg text-blue-300 group-open:text-blue-400">Can I track my progress?</summary>
        <p class="mt-2 text-gray-300">Definitely! BulkUp allows you to track workouts, progress, and meal plans easily.</p>
      </details>
    </div>
  </section>

  <!-- Testimonials Carousel -->
  <section id="testimonials" class="bg-[#111827] py-16 px-6 md:px-40">
    <h2 class="text-3xl font-bold mb-10 text-center text-blue-400 fade-in" style="transition-delay: 1s;">What Our Users Say</h2>
    <div class="max-w-3xl mx-auto relative">
      <div id="carousel" class="overflow-hidden relative rounded-lg shadow-lg">
        <div class="flex transition-transform duration-700 ease-in-out" style="transform: translateX(0%);" >
          <div class="min-w-full p-6 bg-[#1F2937] rounded-lg mx-3">
            <p class="mb-4 italic text-gray-300">"BulkUp helped me stay motivated and track my progress easily. Highly recommended!"</p>
            <h4 class="font-bold text-blue-400">– Anna</h4>
          </div>
          <div class="min-w-full p-6 bg-[#1F2937] rounded-lg mx-3">
            <p class="mb-4 italic text-gray-300">"The workout plans are great for all levels. I’ve seen amazing results."</p>
            <h4 class="font-bold text-blue-400">– David</h4>
          </div>
          <div class="min-w-full p-6 bg-[#1F2937] rounded-lg mx-3">
            <p class="mb-4 italic text-gray-300">"Love the meal planning feature. Makes bulking easier and healthier."</p>
            <h4 class="font-bold text-blue-400">– Maria</h4>
          </div>
        </div>
      </div>
      <div class="flex justify-center gap-4 mt-6">
        <button class="carousel-btn bg-blue-600 px-4 py-2 rounded-full text-white hover:bg-blue-700 btn-animate" data-dir="-1">Prev</button>
        <button class="carousel-btn bg-blue-600 px-4 py-2 rounded-full text-white hover:bg-blue-700 btn-animate" data-dir="1">Next</button>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="bg-[#1F2937] text-white py-16 px-6 md:px-40 fade-in" style="transition-delay: 1.2s;">
    <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
      <div>
        <h3 class="text-xl font-bold mb-4">Thanks for Training with BulkUp</h3>
        <p class="mb-2">Thank you for using BulkUp – the daily workout app to help you stay consistent, healthy and strong. Join and start your body transformation today.</p>
        <p><strong>Stay strong 💪. Consistency is key!</strong></p>
      </div>
      <div>
        <h3 class="text-xl font-bold mb-4">Quick links</h3>
        <ul class="space-y-2">
          <li><a href="#home" class="hover:underline hover:text-blue-400">➤ Home</a></li>
          <li><a href="/loginregis/login" class="hover:underline hover:text-blue-400">➤ Workouts</a></li>
          <li><a href="/loginregis/login" class="hover:underline hover:text-blue-400">➤ Progress</a></li>
          <li><a href="/loginregis/login" class="hover:underline hover:text-blue-400">➤ MealPlan</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-xl font-bold mb-4">Contact Info</h3>
        <p class="mb-2">📱 <strong>WhatsApp:</strong> +62 822-8643-0352 (Ruby Bengkong 24)</p>
        <p class="mb-2">📧 <strong>Email:</strong> bulkup.support@gmail.com</p>
        <p>📍 <strong>Address:</strong> Batam, Indonesia</p>
      </div>
    </div>
  </section>

  <!-- JS for mobile menu, smooth scroll, fade-in and carousel -->
  <script>
    // Mobile menu toggle
    const menuBtn = document.getElementById("menu-btn");
    const menu = document.getElementById("menu");
    menuBtn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
      menu.classList.toggle("flex");
      menu.classList.add("flex-col", "absolute", "top-16", "left-0", "w-full", "px-6", "pb-4", "bg-[#111827]");
    });

    // Smooth scroll for nav links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        const targetId = link.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);
        if(targetSection) {
          targetSection.scrollIntoView({ behavior: 'smooth' });
        }
        if (!menu.classList.contains('hidden')) {
          menu.classList.add('hidden');
          menu.classList.remove('flex', 'flex-col', 'absolute', 'top-16', 'left-0', 'w-full', 'px-6', 'pb-4', 'bg-[#111827]');
        }
      });
    });

    // Fade-in on scroll
    const fadeElements = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if(entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => observer.observe(el));

    // Carousel
    const carousel = document.querySelector("#carousel > div");
    const btns = document.querySelectorAll(".carousel-btn");
    let currentIndex = 0;
    const totalSlides = carousel.children.length;

    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        const dir = parseInt(btn.getAttribute('data-dir'));
        currentIndex = (currentIndex + dir + totalSlides) % totalSlides;
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
      });
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Trainee Home')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @stack('head')

  <style>
    /* Custom gradient backgrounds */
    .bg-gradient-primary {
      background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
    }
    
    .bg-gradient-secondary {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    /* Glassmorphism effect */
    .glass-effect {
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background: rgba(31, 41, 55, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    /* Custom animations */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    @keyframes pulse-glow {
      0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
      50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.8); }
    }

    @keyframes slideIn {
      from { transform: translateX(-100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .animate-float {
      animation: float 3s ease-in-out infinite;
    }

    .animate-pulse-glow {
      animation: pulse-glow 2s ease-in-out infinite;
    }

    .animate-slide-in {
      animation: slideIn 0.5s ease-out;
    }

    .animate-fade-in {
      animation: fadeIn 0.3s ease-out;
    }

    /* Hover effects */
    .nav-item {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .nav-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .nav-item:hover::before {
      left: 100%;
    }

    .nav-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(45deg, #3b82f6, #06b6d4);
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(45deg, #2563eb, #0891b2);
    }

    /* Button hover effects */
    .btn-hover {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-hover::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.3s, height 0.3s;
    }

    .btn-hover:hover::after {
      width: 300px;
      height: 300px;
    }

    .btn-hover:hover {
      transform: scale(1.05);
    }

    /* Dropdown animation */
    .dropdown-menu {
      transform: translateY(-10px);
      opacity: 0;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      pointer-events: none;
    }

    .dropdown-menu.show {
      transform: translateY(0);
      opacity: 1;
      pointer-events: auto;
    }

    /* Mobile menu animation */
    .mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
    }

    .mobile-menu.show {
      max-height: 500px;
    }

    /* Notification badge */
    .notification-badge {
      position: absolute;
      top: -8px;
      right: -8px;
      background: linear-gradient(45deg, #ef4444, #f97316);
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: bold;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.1); }
    }
  </style>

  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
      
      // Add smooth animation
      if (!dropdown.classList.contains('hidden')) {
        dropdown.classList.add('show');
      } else {
        dropdown.classList.remove('show');
      }
    }

    function toggleMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      menu.classList.toggle('hidden');
      menu.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('profileDropdown');
      const profileButton = event.target.closest('[onclick="toggleDropdown()"]');
      
      if (!profileButton && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('show');
      }
    });
  </script>
</head>
<body class="bg-gradient-secondary text-gray-900 min-h-screen">

<!-- Navbar -->
<header class="bg-gradient-primary px-6 py-4 flex items-center justify-between shadow-2xl relative backdrop-blur-sm">
  <!-- Logo with glow effect -->
  <div class="text-white text-2xl font-bold animate-pulse-glow">
    Bulk<span class="text-cyan-300 animate-float">Up</span>
  </div>

  <!-- Mobile Hamburger with animation -->
  <button class="text-white md:hidden focus:outline-none btn-hover p-2 rounded-lg" onclick="toggleMobileMenu()">
    <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <!-- Desktop Menu -->
  <nav class="hidden md:flex items-center space-x-6">
    <!-- Home -->
    <a href="{{ route('trainee.home') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg {{ request()->routeIs('trainee.home') ? 'bg-white bg-opacity-20 text-cyan-300 font-semibold' : 'text-white hover:text-cyan-300' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M3 9.75L12 3l9 6.75V21a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 21V9.75z"/>
      </svg>
      <span>Home</span>
    </a>

    <!-- Workout -->
    <a href="{{ route('trainee.workout') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg {{ request()->routeIs('trainee.workout') ? 'bg-white bg-opacity-20 text-cyan-300 font-semibold' : 'text-white hover:text-cyan-300' }}">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M4 10v4m16-4v4M7 9v6m10-6v6M4 13h16" />
      </svg>
      <span>Workout</span>
    </a>

    <!-- Mealplan -->
    <a href="{{ route('trainee.mealplan') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg {{ request()->routeIs('trainee.mealplan') ? 'bg-white bg-opacity-20 text-cyan-300 font-semibold' : 'text-white hover:text-cyan-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="20" height="20" class="icon">
        <path d="M215.078,8.156c-9.297,0-16.828,7.531-16.828,16.844v84.188h-27.203V23.328C171.047,10.438,160.609,0,147.734,0c-12.891,0-23.328,10.438-23.328,23.328v85.859H97.219V25c0-9.313-7.547-16.844-16.844-16.844S63.531,15.688,63.531,25v107.5h0.313c2.563,19.625,22.344,38.313,51.484,46.375v294.281c0,17.875,14.516,32.375,32.406,32.375c17.875,0,32.359-14.5,32.359-32.375V178.094c25.313-7.219,48.906-22.516,51.547-45.594h0.266V25C231.906,15.688,224.375,8.156,215.078,8.156z"></path>
        <path d="M363.266,16.031c-18.797-6.375-47.188-10.188-47.188,18.656c0,0,0,419.594,0,443.375c0,23.75,13.578,33.938,30.547,33.938s30.531-10.188,30.531-30.563c0-20.344,0-185.281,0-185.281s35.656,0,50.938,0s20.375-18.688,20.375-32.281c0,0,0-50.969,0-93.406C448.469,78.281,403.031,29.563,363.266,16.031z"></path>
      </svg>
      <span>Mealplan</span>
    </a>

    <!-- User Dropdown -->
    <div class="relative">
      <div onclick="toggleDropdown()" class="nav-item text-white text-2xl cursor-pointer p-2 rounded-full bg-white bg-opacity-10 hover:bg-opacity-20 relative">
        👤
        <!-- Notification badge -->
        <div class="notification-badge">3</div>
      </div>
      
      <div id="profileDropdown" class="dropdown-menu absolute right-0 mt-2 hidden glass-effect rounded-xl shadow-2xl p-4 space-y-2 z-10 w-48 border border-white border-opacity-20">
        <!-- Profile -->
        <a href="{{ route('trainee.profile') }}" class="nav-item flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('trainee.profile') ? 'bg-white bg-opacity-20 text-blue-300 font-semibold' : 'text-white hover:bg-white hover:bg-opacity-10' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5.121 17.804A6 6 0 0112 15a6 6 0 016.879 2.804M12 13a5 5 0 100-10 5 5 0 000 10z"/>
          </svg>
          <span>Profile</span>
        </a>

        <!-- Notification -->
        <a href="{{ route('trainee.notification') }}" class="nav-item flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('trainee.notification') ? 'bg-white bg-opacity-20 text-blue-300 font-semibold' : 'text-white hover:bg-white hover:bg-opacity-10' }} relative">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9"/>
          </svg>
          <span>Notification</span>
          <div class="notification-badge" style="position: absolute; top: 8px; right: 8px; width: 8px; height: 8px;"></div>
        </a>

        <!-- Feedback -->
        <a href="{{ route('trainee.feedback') }}" class="nav-item flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('trainee.feedback') ? 'bg-white bg-opacity-20 text-blue-300 font-semibold' : 'text-white hover:bg-white hover:bg-opacity-10' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 3.866-4.03 7-9 7a9.77 9.77 0 01-3.55-.64L3 21l1.36-3.64A6.987 6.987 0 013 12c0-3.866 4.03-7 9-7s9 3.134 9 7z"/>
          </svg>
          <span>Feedback</span>
        </a>

        <!-- Divider -->
        <div class="border-t border-white border-opacity-20 my-2"></div>

        <!-- Logout Button -->
        <button type="button" onclick="openLogoutModal()" class="nav-item flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-red-500 hover:bg-opacity-20 w-full text-left">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
          </svg>
          <span>Log Out</span>
        </button>
      </div>
    </div>
  </nav>
</header>

<!-- Mobile Menu -->
<div id="mobileMenu" class="mobile-menu md:hidden hidden px-6 pt-2 pb-4 bg-gradient-primary space-y-4">
  <a href="{{ route('trainee.home') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-lg">Home</a>
  <a href="{{ route('trainee.workout') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-lg">Workout</a>
  <a href="{{ route('trainee.mealplan') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-lg">Mealplan</a>
  <a href="{{ route('trainee.profile') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-lg">Profile</a>
  <a href="{{ route('trainee.notification') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-lg">Notification</a>
  <a href="{{ route('trainee.feedback') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-lg">Feedback</a>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-item block text-white hover:text-red-400 w-full text-left p-3 rounded-lg">Log Out</button>
  </form>
</div>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden backdrop-blur-sm">
  <div class="bg-white rounded-2xl shadow-2xl w-80 p-6 text-center animate-fade-in">
    <div class="mb-4">
      <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
        </svg>
      </div>
    </div>
    <h2 class="text-xl font-bold mb-2">Yakin ingin logout?</h2>
    <p class="text-sm text-gray-600 mb-6">Anda akan keluar dari sesi saat ini.</p>

    <div class="flex justify-center space-x-4">
      <!-- Cancel Button -->
      <button onclick="closeLogoutModal()" class="btn-hover px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 font-semibold">
        Batal
      </button>

      <!-- Confirm Logout Form -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-hover px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 font-semibold">
          Logout
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Main Content -->
<main class="w-full py-8 px-4 space-y-6 animate-fade-in">
  @yield('content')
</main>

<script>
  function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
  }

  function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
  }

  // Add smooth scroll behavior
  document.documentElement.style.scrollBehavior = 'smooth';

  // Add intersection observer for animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fade-in');
      }
    });
  }, observerOptions);

  // Observe all elements that should animate
  document.addEventListener('DOMContentLoaded', () => {
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    animateElements.forEach(el => observer.observe(el));
  });
</script>

@yield('scripts')
</body>
</html>
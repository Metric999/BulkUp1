<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Trainee Home')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @stack('head')

  <style>
    /* Custom Gradients */
    .bg-gradient-primary {
      background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
    }
    
    .bg-gradient-secondary {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 50%, #93c5fd 100%);
      min-height: 100vh;
    }
    
    .bg-gradient-card {
      background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.2);
    }

    /* Glass Effect */
    .glass-effect {
      background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.9) 100%);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    }

    /* Enhanced Animations */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    @keyframes pulse-glow {
      0%, 100% { text-shadow: 0 0 20px rgba(255,255,255,0.5); }
      50% { text-shadow: 0 0 30px rgba(255,255,255,0.8), 0 0 40px rgba(255,255,255,0.3); }
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideDown {
      from { transform: translateY(-100%); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes scaleIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    
    .animate-pulse-glow {
      animation: pulse-glow 2s ease-in-out infinite;
    }
    
    .animate-fade-in {
      animation: fadeIn 0.6s ease-out;
    }
    
    .animate-slide-down {
      animation: slideDown 0.4s ease-out;
    }
    
    .animate-scale-in {
      animation: scaleIn 0.3s ease-out;
    }

    /* Enhanced Navigation */
    .nav-item {
      position: relative;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
    }
    
    .nav-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .nav-item:hover::before {
      left: 100%;
    }
    
    .nav-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* Enhanced Buttons */
    .btn-hover {
      position: relative;
      overflow: hidden;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      transform: translateZ(0);
    }
    
    .btn-hover::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s;
    }
    
    .btn-hover:hover::before {
      left: 100%;
    }
    
    .btn-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }

    /* Enhanced Dropdown */
    .dropdown-menu {
      transform: translateY(-20px) scale(0.95);
      opacity: 0;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      pointer-events: none;
      z-index: 999 !important;
    }

    .dropdown-menu.show {
      transform: translateY(0) scale(1);
      opacity: 1;
      pointer-events: auto;
    }

    /* Enhanced Mobile Menu */
    .mobile-menu {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      transform: translateY(-20px);
      opacity: 0;
    }
    
    .mobile-menu.show {
      transform: translateY(0);
      opacity: 1;
    }

    /* Notification Badge */
    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
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
      border: 2px solid white;
      box-shadow: 0 0 10px rgba(255,107,107,0.5);
    }

    /* Enhanced Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.1);
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #1e3a8a, #3b82f6);
      border-radius: 10px;
      border: 2px solid transparent;
      background-clip: content-box;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, #3b82f6, #1e3a8a);
      background-clip: content-box;
    }

    /* Enhanced Modal */
    .modal-backdrop {
      backdrop-filter: blur(10px);
      background: rgba(0,0,0,0.6);
      transition: all 0.3s ease;
    }
    
    .modal-content {
      background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.9) 100%);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    }

    /* Logo Enhancement */
    .logo {
      background: linear-gradient(135deg, #ffffff, #e0f2fe);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    }

    /* Active State Enhancement */
    .nav-active {
      background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0.1) 100%);
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Improved Hover Effects */
    .hover-lift {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    /* Header Enhancement */
    .header-blur {
      backdrop-filter: blur(20px);
      background: linear-gradient(135deg, rgba(30,58,138,0.95) 0%, rgba(59,130,246,0.95) 50%, rgba(96,165,250,0.95) 100%);
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }
  </style>

  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
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

    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('profileDropdown');
      const profileButton = event.target.closest('[onclick="toggleDropdown()"]');
      if (!profileButton && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('show');
      }
    });

    // Enhanced loading animation
    document.addEventListener('DOMContentLoaded', function() {
      const elements = document.querySelectorAll('.animate-fade-in');
      elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
      });
    });
  </script>
</head>
<body class="bg-gradient-secondary text-gray-900 min-h-screen">

<!-- Navbar -->
<header class="header-blur px-6 py-4 flex items-center justify-between shadow-2xl relative z-[999] animate-slide-down">
  <div class="logo text-white text-2xl font-bold animate-pulse-glow">
    BulkUp<span class="text-cyan-300 animate-float"></span>
  </div>

  <button class="text-white md:hidden focus:outline-none btn-hover p-2 rounded-lg hover-lift" onclick="toggleMobileMenu()">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <nav class="hidden md:flex items-center space-x-6">
    <!-- Menu: Home, Workout, Mealplan -->
    <a href="{{ route('trainee.home') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg hover-lift {{ request()->routeIs('trainee.home') ? 'nav-active text-cyan-300 font-semibold' : 'text-white hover:text-cyan-300' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
      </svg>
      <span>Home</span>
    </a>

    <a href="{{ route('trainee.workout') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg hover-lift {{ request()->routeIs('trainee.workout') ? 'nav-active text-cyan-300 font-semibold' : 'text-white hover:text-cyan-300' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/>
      </svg>
      <span>Workout</span>
    </a>

    <a href="{{ route('trainee.mealplan') }}" class="nav-item flex items-center space-x-2 px-4 py-2 rounded-lg hover-lift {{ request()->routeIs('trainee.mealplan') ? 'nav-active text-cyan-300 font-semibold' : 'text-white hover:text-cyan-300' }}">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5c0-.621-.504-1.125-1.125-1.125H9.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125h1.5c.621 0 1.125-.504 1.125-1.125ZM12 8.25V12m0 0v4.25c0 .621.504 1.125 1.125 1.125h1.5c.621 0 1.125-.504 1.125-1.125V12c0-.621-.504-1.125-1.125-1.125h-1.5c-.621 0-1.125.504-1.125 1.125Z"/>
      </svg>
      <span>Mealplan</span>
    </a>

    <!-- Enhanced Dropdown -->
    <div class="relative z-[999]">
      <div onclick="toggleDropdown()" class="nav-item text-white text-2xl cursor-pointer p-3 rounded-full glass-effect hover-lift relative">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275"/>
        </svg>
        <div class="notification-badge">3</div>
      </div>

      <div id="profileDropdown" class="dropdown-menu absolute right-0 mt-2 hidden glass-effect rounded-2xl shadow-2xl p-4 space-y-2 w-64 border border-gray-200 z-[999]">
        <a href="{{ route('trainee.profile') }}" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover-lift {{ request()->routeIs('trainee.profile') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275"/>
          </svg>
          <span>Profile</span>
        </a>
        <a href="{{ route('trainee.notification') }}" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover-lift {{ request()->routeIs('trainee.notification') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
          </svg>
          <span>Reminder</span>
        </a>
        <a href="{{ route('trainee.feedback') }}" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover-lift {{ request()->routeIs('trainee.feedback') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
          </svg>
          <span>Feedback</span>
        </a>
        <div class="border-t border-gray-300 my-2"></div>
        <button type="button" onclick="openLogoutModal()" class="nav-item flex items-center space-x-3 p-3 rounded-xl text-gray-700 hover:bg-red-50 hover:text-red-600 w-full text-left hover-lift">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
          </svg>
          <span>Log Out</span>
        </button>
      </div>
    </div>
  </nav>
</header>

<!-- Enhanced Mobile Menu -->
<div id="mobileMenu" class="mobile-menu md:hidden hidden px-6 pt-4 pb-6 bg-gradient-primary space-y-3 z-50 shadow-2xl">
  <a href="{{ route('trainee.home') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-xl hover-lift">
    <span class="flex items-center space-x-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
      </svg>
      <span>Home</span>
    </span>
  </a>
  <a href="{{ route('trainee.workout') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-xl hover-lift">
    <span class="flex items-center space-x-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/>
      </svg>
      <span>Workout</span>
    </span>
  </a>
  <a href="{{ route('trainee.mealplan') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-xl hover-lift">
    <span class="flex items-center space-x-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5c0-.621-.504-1.125-1.125-1.125H9.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125h1.5c.621 0 1.125-.504 1.125-1.125ZM12 8.25V12m0 0v4.25c0 .621.504 1.125 1.125 1.125h1.5c.621 0 1.125-.504 1.125-1.125V12c0-.621-.504-1.125-1.125-1.125h-1.5c-.621 0-1.125.504-1.125 1.125Z"/>
      </svg>
      <span>Mealplan</span>
    </span>
  </a>
  <a href="{{ route('trainee.profile') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-xl hover-lift">
    <span class="flex items-center space-x-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275"/>
      </svg>
      <span>Profile</span>
    </span>
  </a>
  <a href="{{ route('trainee.notification') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-xl hover-lift">
    <span class="flex items-center space-x-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
      </svg>
      <span>Reminder</span>
    </span>
  </a>
  <a href="{{ route('trainee.feedback') }}" class="nav-item block text-white hover:text-cyan-300 p-3 rounded-xl hover-lift">
    <span class="flex items-center space-x-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
      </svg>
      <span>Feedback</span>
    </span>
  </a>
  <div class="border-t border-white border-opacity-20 my-3"></div>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-item flex items-center space-x-3 text-white hover:text-red-400 w-full text-left p-3 rounded-xl hover-lift">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
      </svg>
      <span>Log Out</span>
    </button>
  </form>
</div>

<!-- Enhanced Logout Modal -->
<div id="logoutModal" class="fixed inset-0 flex items-center justify-center modal-backdrop z-[1000] hidden">
  <div class="modal-content rounded-2xl shadow-2xl w-96 p-8 text-center animate-scale-in">
    <div class="mb-6">
      <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800 mb-2">Konfirmasi Logout</h2>
      <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari sesi saat ini?</p>
    </div>
    <div class="flex justify-center space-x-4">
      <button onclick="closeLogoutModal()" class="btn-hover px-8 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 font-semibold transition-all duration-300 hover-lift">
        Batal
      </button>
      <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="btn-hover px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 font-semibold transition-all duration-300 hover-lift">
          Logout
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Main Content -->
<main class="w-full py-8 px-4 space-y-6 animate-fade-in z-0">
  @yield('content')
</main>

<script>
  function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
  }
  function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
  }
</script>

@yield('scripts')
</body>
</html>
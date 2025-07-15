@extends('layouts.trainee')
/**
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <div class="max-w-6xl mx-auto space-y-8 px-4 sm:px-6 py-8">
        <!-- Header Section -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                My Workout Plan
            </h1>
            <div class="bg-white/70 backdrop-blur-sm rounded-full px-6 py-3 inline-block shadow-lg">
                <p class="text-gray-700 text-lg font-medium">Welcome back, <span class="text-blue-600 font-bold">{{ $traineeName }}</span>! 💪</p>
            </div>
        </div>

        @forelse($workouts as $day => $dayWorkouts)
            <div class="group hover:scale-[1.02] transition-all duration-300">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-2xl border border-white/50 overflow-hidden">
                    <!-- Day Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-white relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative z-10 flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">{{ \Carbon\Carbon::parse($day)->format('l, d M, Y') }}</h3>
                        </div>
                        <!-- Decorative circles -->
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full"></div>
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/5 rounded-full"></div>
                    </div>

                    <!-- Workouts List -->
                    <div class="p-6 space-y-6">
                        @foreach($dayWorkouts as $index => $w)
                            <div class="group/workout relative">
                                <div class="bg-gradient-to-r from-gray-50 to-blue-50/50 rounded-xl p-6 border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-md">
                                    <!-- Workout Number Badge -->
                                    <div class="absolute -top-3 -left-3 w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg">
                                        {{ $index + 1 }}
                                    </div>

                                    <!-- Workout Header -->
                                    <div class="mb-4">
                                        <h4 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            {{ $w->name }}
                                        </h4>
                                        
                                        <!-- Workout Info Grid -->
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div class="flex items-center space-x-2 bg-white/70 rounded-lg px-3 py-2">
                                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                                <span class="text-sm font-medium text-gray-600">Category:</span>
                                                <span class="text-sm font-bold text-gray-800">{{ $w->kategori }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 bg-white/70 rounded-lg px-3 py-2">
                                                <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                                <span class="text-sm font-medium text-gray-600">Difficulty:</span>
                                                <span class="text-sm font-bold text-gray-800">{{ $w->difficult }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 bg-white/70 rounded-lg px-3 py-2">
                                                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                                <span class="text-sm font-medium text-gray-600">Reps:</span>
                                                <span class="text-sm font-bold text-gray-800">{{ $w->reps }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Video Section -->
                                    @if(!empty($w->videoUrl))
                                        <div class="mb-4">
                                            <div class="aspect-video rounded-xl overflow-hidden shadow-lg border-2 border-white">
                                                @php
                                                    $videoUrl = $w->videoUrl;
                                                    $embedUrl = '';

                                                    if (str_contains($videoUrl, 'youtube.com/watch?v=')) {
                                                        $embedUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                                                    } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                                        $videoId = substr(parse_url($videoUrl, PHP_URL_PATH), 1);
                                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                    } elseif (str_contains($videoUrl, 'vimeo.com')) {
                                                        $videoId = preg_replace('/[^0-9]/', '', $videoUrl);
                                                        $embedUrl = 'https://player.vimeo.com/video/' . $videoId;
                                                    } elseif (preg_match('/\.(mp4|webm|ogg)$/i', $videoUrl)) {
                                                        $embedUrl = null;
                                                    } else {
                                                        $embedUrl = $videoUrl;
                                                    }
                                                @endphp

                                                @if($embedUrl)
                                                    <iframe class="w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                                @else
                                                    <video class="w-full h-full" controls>
                                                        <source src="{{ $videoUrl }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Submit Section -->
                                    @php
                                        $isSubmitted = in_array($w->id, $submitted ?? []);
                                    @endphp

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                        @if(!$isSubmitted)
                                            <div class="flex items-center space-x-2">
                                                <div class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                                                <span class="text-sm text-gray-600 font-medium">Ready to submit</span>
                                            </div>
                                            <a href="{{ route('trainee.workout', ['submitted' => implode(',', $submitted ?? []), 'toggle' => $w->id]) }}"
                                                class="group/btn relative overflow-hidden bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                                <span class="relative z-10 flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>Submit Workout</span>
                                                </span>
                                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover/btn:scale-x-100 transition-transform origin-left duration-300"></div>
                                            </a>
                                        @else
                                            <div class="flex items-center space-x-3">
                                                <div class="flex items-center space-x-2 bg-green-100 rounded-full px-4 py-2">
                                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                                    <span class="text-sm text-green-700 font-bold">Completed!</span>
                                                </div>
                                                <span class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>Submitted</span>
                                                </span>
                                            </div>
                                            <a href="{{ route('trainee.workout', ['submitted' => implode(',', $submitted ?? []), 'toggle' => $w->id]) }}"
                                                class="group/cancel relative overflow-hidden bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-full font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                                <span class="relative z-10 flex items-center space-x-1 text-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    <span>Cancel</span>
                                                </span>
                                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover/cancel:scale-x-100 transition-transform origin-left duration-300"></div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No Workouts Scheduled</h3>
                <p class="text-gray-500 text-lg">Your trainer hasn't assigned any workouts yet. Check back soon!</p>
            </div>
        @endforelse
    </div>
</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.group:hover .animate-float {
    animation: float 2s ease-in-out infinite;
}

/* Custom scrollbar for better aesthetics */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #2563eb, #7c3aed);
}
</style>
@endsection
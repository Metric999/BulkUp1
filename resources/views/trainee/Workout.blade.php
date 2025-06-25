@extends('layouts.trainee')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 px-4 sm:px-6 py-6">
    <h1 class="text-2xl sm:text-3xl font-bold">My Workout Plan</h1>
    <p class="text-gray-600 text-base sm:text-lg">Welcome, {{ $traineeName }}!</p>

    @forelse($workouts as $day => $dayWorkouts)
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h3 class="text-lg sm:text-xl font-semibold">{{ \Carbon\Carbon::parse($day)->format('l, d M, Y,') }}</h3>
            @foreach($dayWorkouts as $w)
                <div class="mt-4 border-t pt-2 space-y-1">
                    <p class="font-semibold text-base sm:text-lg">{{ $w->name }}</p>
                    <p class="text-sm text-gray-700">Category: {{ $w->kategori }}</p>
                    <p class="text-sm text-gray-700">Difficulty: {{ $w->difficult }}</p>
                    <p class="text-sm text-gray-700">Reps: {{ $w->reps }}</p>

                    @if(!empty($w->videoUrl))
                        <div class="aspect-video mt-2">
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
                                <iframe class="w-full h-full rounded" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                            @else
                                <video class="w-full h-full rounded" controls>
                                    <source src="{{ $videoUrl }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    @endif

                    @php
                        $isSubmitted = in_array($w->id, $submitted ?? []);
                    @endphp

                    @if(!$isSubmitted)
    <a href="{{ route('trainee.workout', ['submitted' => implode(',', $submitted ?? []), 'toggle' => $w->id]) }}"
        class="inline-block mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded-full text-sm transition-all">
         Submit
    </a>
@else
    <div class="mt-3 space-y-1">
        <span class="inline-block bg-green-500 text-white px-4 py-1 rounded-full text-sm">
            ✅ Submitted
        </span>
        <a href="{{ route('trainee.workout', ['submitted' => implode(',', $submitted ?? []), 'toggle' => $w->id]) }}"
            class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-sm transition-all">
            ❌ Cancel Submit
        </a>
    </div>
@endif       
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-gray-500">You have no workouts scheduled by your trainer.</p>
    @endforelse
</div>
@endsection

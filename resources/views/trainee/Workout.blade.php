@extends('layouts.trainee')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 p-6">
    <h1 class="text-3xl font-bold">My Workout Plan</h1>
    <p class="text-gray-600 text-lg">Welcome, {{ $traineeName }}!</p>

    @foreach ($daysOfWeek as $day)
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-xl font-semibold">{{ $day }}</h3>

            @if (empty($workouts[$day]))
                <p class="text-gray-500">No workouts scheduled.</p>
            @else
                @foreach ($workouts[$day] as $w)
                    <div class="mt-4 border-t pt-2 space-y-1">
                        <p class="font-semibold text-lg">{{ $w['name'] ?? '' }}</p>
                        <p class="text-sm text-gray-700">Category: {{ $w['kategori'] ?? '' }}</p>
                        <p class="text-sm text-gray-700">Difficulty: {{ $w['difficult'] ?? '' }}</p>
                        <p class="text-sm text-gray-700">Reps: {{ $w['reps'] ?? '' }}</p>

                        @if (!empty($w['videoUrl']))
                            @php
                                function embedUrl($url) {
                                    if (preg_match("#youtube\.com/watch\?v=([^&]+)#", $url, $matches)) {
                                        return "https://www.youtube.com/embed/" . $matches[1];
                                    }
                                    if (preg_match("#youtu\.be/([^?&]+)#", $url, $matches)) {
                                        return "https://www.youtube.com/embed/" . $matches[1];
                                    }
                                    if (preg_match("#vimeo\.com/(\d+)#", $url, $matches)) {
                                        return "https://player.vimeo.com/video/" . $matches[1];
                                    }
                                    return $url;
                                }
                            @endphp
                            <div class="aspect-video mt-2">
                                <iframe class="w-full h-full rounded" src="{{ embedUrl($w['videoUrl']) }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
</div>
@endsection

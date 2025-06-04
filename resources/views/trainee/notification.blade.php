@extends('layouts.trainee') 

@section('title', 'Notifikasi')

@section('content')
<div class="container mt-5">
    <h1>Notifikasi</h1>

    @if ($notifications->count() > 0)
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item">
                    <strong>{{ $notification->judul }}</strong>
                    <p>{{ $notification->pesan }}</p>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($notification->tanggal)->translatedFormat('d F Y H:i') }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">Belum ada notifikasi.</div>
    @endif
</div>
@endsection

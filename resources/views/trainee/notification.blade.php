@extends('layouts.trainee')

@section('content')
    <h1>Notifikasi</h1>

    @foreach ($notifications as $notification)
        <div>
            <h2>{{ $notification->judul }}</h2>
            <p>{{ $notification->pesan }}</p>
            <small>{{ $notification->tanggal }}</small>
        </div>
    @endforeach
@endsection

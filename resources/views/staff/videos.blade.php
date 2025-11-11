@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')

@foreach($videos as $v)
<div class="card p-3 mb-3">
    <h5>{{ $v->title }}</h5>
    <p>{{ $v->description }}</p>

    {{-- Jika durasi habis --}}
    @if($v->isExpired())
        <p class="text-danger fw-bold">Waktu akses untuk video ini telah habis.</p>

    @else

        {{-- Tampilkan sisa waktu hanya jika memiliki durasi --}}
        @if($v->duration)
            <p>
                Sisa waktu: <span id="timer-{{ $v->id }}" class="fw-bold text-primary"></span>
            </p>
        @endif

        {{-- Video tetap tampil --}}
        <video id="video-{{ $v->id }}" width="400" controls>
            <source src="{{ asset('storage/'.$v->video_path) }}">
        </video>

        @if($v->duration)
        <script>
            let remaining{{ $v->id }} = {{ $v->remainingWatchSeconds() }}; // total detik
            let video{{ $v->id }} = document.getElementById("video-{{ $v->id }}");
            let timer{{ $v->id }} = document.getElementById("timer-{{ $v->id }}");
            let interval{{ $v->id }} = null;

            function updateTimer{{ $v->id }}() {
                let m = Math.floor(remaining{{ $v->id }} / 60);
                let s = remaining{{ $v->id }} % 60;
                timer{{ $v->id }}.innerHTML = `${m}m ${s}s`;
            }

            video{{ $v->id }}.addEventListener('play', function () {
                if (interval{{ $v->id }} === null) {
                    interval{{ $v->id }} = setInterval(function () {
                        remaining{{ $v->id }}--;
                        updateTimer{{ $v->id }}();

                        if (remaining{{ $v->id }} <= 0) {
                            clearInterval(interval{{ $v->id }});
                            video{{ $v->id }}.pause();
                            video{{ $v->id }}.controls = false;
                            timer{{ $v->id }}.innerHTML = "Waktu habis";
                        }
                    }, 1000);
                }
            });

            video{{ $v->id }}.addEventListener('pause', function () {
                clearInterval(interval{{ $v->id }});
                interval{{ $v->id }} = null;
            });

            updateTimer{{ $v->id }}();
        </script>
        @endif

    @endif

    {{-- Label akses terbatas --}}
    @if($v->access_level != 'full')
        <p class="text-warning"><i>Mode Pratinjau (Akses Terbatas)</i></p>
    @endif

</div>
@endforeach

@endsection

@extends('layouts.app')

@section('content')

<h1>Daftar Kamar</h1>

<div class="grid">
    @foreach($rooms as $room)
        <div class="card">

            <h2>{{ $room->type }}</h2>

            <p>{{ $room->facilities }}</p>

            <p>
                Kapasitas {{ $room->capacity }} tamu
                |
                Stok {{ $room->stock }}
            </p>

            <h3>
                Rp {{ number_format($room->price, 0, ',', '.') }}/malam
            </h3>

            @if($room->stock > 0)
                <a
                    class="btn"
                    href="{{ route('customer.bookings.create', $room) }}"
                >
                    Booking
                </a>
            @else
                <b>Habis</b>
            @endif

        </div>
    @endforeach
</div>

@endsection
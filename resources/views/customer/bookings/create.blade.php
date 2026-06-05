@extends('layouts.app')

@section('content')

<div class="card small">

    <h1>Booking {{ $room->type }}</h1>

    <p>
        Harga:
        Rp {{ number_format($room->price, 0, ',', '.') }}
        / malam
    </p>

    <form method="POST">
        @csrf

        <label>Check In</label>
        <input
            type="date"
            name="check_in"
            required
        >

        <label>Jumlah Malam (1 - 30)</label>
        <input
            type="number"
            name="nights"
            min="1"
            max="30"
            required
        >

        <label>
            Jumlah Tamu
            (maks {{ $room->capacity }})
        </label>

        <input
            type="number"
            name="guests"
            min="1"
            max="{{ $room->capacity }}"
            required
        >

        <button class="primary" type="submit">
            Buat Booking
        </button>

    </form>

</div>

@endsection
@extends('layouts.app')

@section('content')

<h1>Data Booking</h1>

<table>
    <tr>
        <th>Kode</th>
        <th>Customer</th>
        <th>Kamar</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($bookings as $b)
        <tr>
            <td>{{ $b->booking_code }}</td>
            <td>{{ $b->user->name }}</td>
            <td>{{ $b->room->type }}</td>
            <td>
                Rp {{ number_format($b->total_price, 0, ',', '.') }}
            </td>
            <td>{{ $b->status }}</td>
            <td>
                @if($b->status === 'paid')
                    <form
                        method="POST"
                        action="{{ route('admin.bookings.confirm', $b) }}"
                    >
                        @csrf

                        <button type="submit">
                            Konfirmasi
                        </button>
                    </form>
                @endif

                @if(!in_array($b->status, ['completed', 'cancelled']))
                    <form
                        method="POST"
                        action="{{ route('admin.bookings.cancel', $b) }}"
                    >
                        @csrf

                        <button type="submit">
                            Batal
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</table>

@endsection
@extends('layouts.app')

@section('content')

<h1>Riwayat Booking</h1>

<table>
    <tr>
        <th>Kode</th>
        <th>Kamar</th>
        <th>Check In</th>
        <th>Malam</th>
        <th>Tamu</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($bookings as $b)
        <tr>
            <td>{{ $b->booking_code }}</td>
            <td>{{ $b->room->type }}</td>
            <td>{{ $b->check_in }}</td>
            <td>{{ $b->nights }}</td>
            <td>{{ $b->guests }}</td>
            <td>
                Rp {{ number_format($b->total_price, 0, ',', '.') }}
            </td>
            <td>{{ $b->status }}</td>
            <td>
                @if($b->status === 'waiting_payment')
                    <form
                        method="POST"
                        action="{{ route('customer.bookings.pay', $b) }}"
                    >
                        @csrf

                        <select name="method" required>
                            <option value="">Metode</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>

                        <input
                            type="number"
                            name="amount_paid"
                            value="{{ $b->total_price }}"
                            required
                        >

                        <button type="submit">
                            Bayar
                        </button>
                    </form>
                @endif

                @if($b->status === 'confirmed')
                    <form
                        method="POST"
                        action="{{ route('customer.bookings.checkout', $b) }}"
                    >
                        @csrf

                        <button type="submit">
                            Checkout
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</table>

@endsection
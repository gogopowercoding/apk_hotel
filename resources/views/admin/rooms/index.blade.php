@extends('layouts.app')

@section('content')

<h1>Kelola Kamar</h1>

<a
    class="btn"
    href="{{ route('admin.rooms.create') }}"
>
    Tambah Kamar
</a>

<br>
<br>


<table>
    <tr>
        <th>Kode</th>
        <th>Tipe</th>
        <th>Harga</th>
        <th>Kapasitas</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach($rooms as $room)
        <tr>
            <td>{{ $room->code }}</td>
            <td>{{ $room->type }}</td>
            <td>
                Rp {{ number_format($room->price, 0, ',', '.') }}
            </td>
            <td>{{ $room->capacity }}</td>
            <td>{{ $room->stock }}</td>

            <td>
                <a class="btn" href="{{ route('admin.rooms.edit', $room) }}">
                    Edit
                </a>

                <form
                    method="POST"
                    action="{{ route('admin.rooms.destroy', $room) }}"
                    style="display:inline;"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>
                </form>
            </td>
                </tr>
    @endforeach
</table>

{{ $rooms->links() }}

@endsection
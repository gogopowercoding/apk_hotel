@extends('layouts.app')

@section('content')

<div class="card small">

    <h1>
        {{ isset($room) && $room->exists ? 'Edit Kamar' : 'Tambah Kamar' }}
    </h1>

    <form
        method="POST"
        action="{{ isset($room) && $room->exists
            ? route('admin.rooms.update', ['room' => $room->id])
            : route('admin.rooms.store') }}"
    >
        @csrf

        @if(isset($room) && $room->exists)
            @method('PUT')
        @endif

        <label>Kode Kamar</label>
        <input
            type="text"
            name="code"
            value="{{ old('code', $room->code ?? '') }}"
            required
        >

        <label>Tipe Kamar</label>
        <input
            type="text"
            name="type"
            value="{{ old('type', $room->type ?? '') }}"
            required
        >

        <label>Harga</label>
        <input
            type="number"
            name="price"
            value="{{ old('price', $room->price ?? '') }}"
            required
        >

        <label>Kapasitas</label>
        <input
            type="number"
            name="capacity"
            value="{{ old('capacity', $room->capacity ?? '') }}"
            required
        >

        <label>Stok</label>
        <input
            type="number"
            name="stock"
            value="{{ old('stock', $room->stock ?? '') }}"
            required
        >

        <label>Fasilitas</label>
        <textarea
            name="facilities"
        >{{ old('facilities', $room->facilities ?? '') }}</textarea>

        <label>Deskripsi</label>
        <textarea
            name="description"
        >{{ old('description', $room->description ?? '') }}</textarea>

        <label>Status</label>
        <select name="status" required>
            <option
                value="available"
                {{ old('status', $room->status ?? 'available') === 'available' ? 'selected' : '' }}
            >
                Available
            </option>

            <option
                value="unavailable"
                {{ old('status', $room->status ?? '') === 'unavailable' ? 'selected' : '' }}
            >
                Unavailable
            </option>
        </select>

        <button class="primary" type="submit">
            Simpan
        </button>
    </form>

</div>

@endsection
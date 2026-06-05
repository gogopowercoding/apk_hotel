@extends('layouts.auth')

@section('content')
<div class="card small">

    <h1>Register</h1>

    <form method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="name">

        <label>Email</label>
        <input type="email" name="email">

        <label>Password</label>
        <input type="password" name="password">

        <label>Konfirmasi Password</label>
        <input
            type="password"
            name="password_confirmation"
        >

        <button class="primary" type="submit">
            Daftar
        </button>

        <br>
        <br>
        <a href="{{ route('login') }}">
            Kembali Login
        </a>
    </form>

</div>
@endsection
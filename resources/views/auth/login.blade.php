@extends('layouts.app')

@section('content')
<div class="card small">

    <h1 style="text-align: center;">Login</h1>

    <!-- 
    <p>
        Admin : admin@hotel.test / admin123 <br>
        Customer : budi@hotel.test / budi123
    </p>
    -->

    <form method="POST">
        @csrf

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
        >

        <button class="primary" type="submit">
            Login
        </button>
        <br>
        <p>Belum punya akun?
            <a href="{{ route('register') }}">
            Daftar akun 
        </a>
        </p>
        
    </form>

</div>
@endsection
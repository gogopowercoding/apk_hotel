<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Nusantara</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav>
        <b>Hotel Nusantara</b>

        <div>
            @auth
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.rooms.index') }}">
                        Kamar
                    </a>

                    <a href="{{ route('admin.bookings.index') }}">
                        Booking
                    </a>
                @else
                    <a href="{{ route('customer.rooms.index') }}">
                        Kamar
                    </a>

                    <a href="{{ route('customer.bookings.index') }}">
                        Riwayat
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="ok">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="err">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
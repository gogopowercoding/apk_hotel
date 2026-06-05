<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Nusantara</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

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

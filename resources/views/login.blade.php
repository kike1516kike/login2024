<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        @include('partials.nav')
        <h1>Login Cofasa</h1>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <pre>{{ Auth::user() }}</pre>
        <form  method="POST">
            @csrf
            <label for="">
                <input name="email" type="email" required autofocus value="{{ old('email') }}" placeholder="email">
            </label>
            <label for="">
                <input name="password" type="password" required placeholder="contraseña">
            </label>
            <label >
                <input name="remember" type="checkbox" placeholder="">
                Recuerda mi sesión
            </label>
            <button type="submit">Login</button>
        </form>

    </body>
</html>

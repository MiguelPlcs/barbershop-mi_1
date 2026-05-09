<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Barbershop') }}</title>

        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js'])
    </head>
    <body style="margin:0; min-height:100vh; background:#000; font-family:'Outfit',sans-serif;">

        <!-- Background pattern -->
        <div style="
            position:fixed; inset:0; z-index:0; pointer-events:none;
            background: radial-gradient(ellipse at 20% 50%, rgba(21,101,192,0.08) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(198,40,40,0.07) 0%, transparent 60%),
                        linear-gradient(180deg, #000 0%, #060d1a 100%);
        "></div>

        <div style="position:relative; z-index:1; min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 16px;">

            <!-- Logo -->
            <a href="{{ url('/') }}" style="display:block; margin-bottom:28px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:70px; display:block; margin:0 auto; filter:drop-shadow(0 8px 24px rgba(198,40,40,0.35));">
            </a>

            <!-- Card -->
            <div style="
                width:100%; max-width:460px;
                background: rgba(17,24,39,0.92);
                border: 1px solid rgba(255,255,255,0.08);
                border-top: 3px solid #C62828;
                border-radius: 18px;
                padding: 36px 32px;
                box-shadow: 0 24px 80px rgba(0,0,0,0.6);
            ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

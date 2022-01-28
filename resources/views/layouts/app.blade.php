<!DOCTYPE html>
<html class="white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap">
        <link rel="stylesheet" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&amp;display=swap">
        <link rel="stylesheet" href="{{ asset(mix('app.css', 'vendor/survey')) }}">
        <script defer src="{{ asset(mix('app.js', 'vendor/survey')) }}"></script>
        @livewireStyles
    </head>
    
    <body class="font-sans antialiased">
      @include('survey::layouts.navigation')
      {{ $slot }}
      @livewireScripts
    </body>
</html>

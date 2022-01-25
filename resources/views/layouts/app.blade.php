<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap">
        <link rel="stylesheet" onload="this.onload=null;this.removeAttribute('media');" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&amp;display=swap">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
              darkMode: 'class',
              theme: {
                extend: {
                    fontFamily: {
                        sans: ["Nunito"],
                        heading: ["Inter"],
                    },
                }
              },
            }
          </script>
    </head>
    
    <body class="font-sans antialiased">
      {{ $slot }}
    </body>
</html>

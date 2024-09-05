<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

  <script>
    window.assets = {
      public_image:"{{asset('image_path')}}"
    }
  </script>

  <!-- Scripts -->
  @routes
  @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
  @inertiaHead
</head>
<body class="bg-black text-white font-hanken-grotesk">
  {{ $slot }}
</body>
</html>

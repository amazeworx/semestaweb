<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Semesta Indovest') }}</title>
  <link rel="icon" href="/images/favicon_semestaindovest-32x32.png" sizes="32x32" />
  <link rel="icon" href="/images/favicon_semestaindovest-192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon" href="/images/appicon_semestaindovest.png" />
  <meta name="msapplication-TileImage" content="/images/appicon_semestaindovest.png" />

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
  <div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
  </div>
</body>

</html>
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

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ mix('js/vue-open-account.js') }}" defer></script>
</head>

<body class="font-sans antialiased" x-data="{ menuopen: false }" x-bind:class="{ 'overflow-hidden': menuopen }">

  <div class="min-h-screen">
    <x-site-header />

    <!-- Page Content -->
    <base href="http://localhost:3000/vue-open-account/" />
    <div id="app">
    </div>

    <x-site-footer />

  </div>

</html>
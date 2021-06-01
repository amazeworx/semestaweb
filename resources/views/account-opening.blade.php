<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Semesta</title>

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <!-- Scripts -->
  {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
  <script src="{{ mix('js/open-account.js') }}" defer></script>

  <script>
    window._locale = '{{ app()->getLocale() }}';
    window._translations = {!! cache('translations') !!};
  </script>

</head>

<body class="antialiased">

  <div id="app">
  </div>

</body>

</html>
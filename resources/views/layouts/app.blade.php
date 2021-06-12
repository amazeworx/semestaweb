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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @livewireStyles

  <!-- Scripts -->
  <script src="https://cdn.tiny.cloud/1/c9ejmb2ej69lwq8m38mkrqkvm6qestd5liboxy07xsaq7de9/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
  <x-jet-banner />

  <div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
    @endif

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  @stack('modals')

  @livewire('livewire-ui-modal')
  @livewireUIScripts
  @livewireScripts
</body>

</html>
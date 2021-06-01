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
  <script src="{{ mix('js/app.js') }}" defer></script>

  <script>
    window._locale = '{{ app()->getLocale() }}';
    window._translations = {!! cache('translations') !!};
  </script>

</head>

<body class="antialiased">

  <div id="app" class="min-h-screen">
    <!-- Page Content -->
    <main>

      <div class="bg-gray-50 py-32 min-h-screen md:px-4 lg:px-6">
        <div class="max-w-5xl mx-auto">
          <h1 class="text-center text-4xl font-display font-bold text-blue mb-4">{{ __("Form Pembukaan Rekening") }}
          </h1>

          <div class="open-account flex flex-col flex-wrap">

            <open-account></open-account>

            {{-- <wizard-open-account></wizard-open-account> --}}

            {{-- <form-open-account></form-open-account> --}}

          </div>

        </div>
      </div>
    </main>

  </div>

</body>

</html>
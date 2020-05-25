<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pombo System</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="container">
    @yield('content')
  </div>
  
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  <script src="{{ asset('js/jquery.min.js') }}" defer></script>
  <script src="{{ asset('js/jquery.mask.min.js') }}" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('js/custom.js') }}" defer></script>
</body>
</html>
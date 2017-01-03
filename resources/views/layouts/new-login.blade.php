<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>TPZ - Connexion</title>
  
  <link rel="stylesheet" href="{{ asset('css/reset.min.css') }}">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='{{ asset('font-awesome/css/font-awesome.css') }}'>

  <link rel="stylesheet" href="{{ asset('flat-form/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('flat-form/css/custom-form.css') }}">

  
</head>

<body>
  
  @yield('content')
  
  <script src='{{ asset('js/jquery-2.1.3.min.js') }}'></script>
  <script src="{{ asset('flat-form/js/index.js') }}"></script>
</body>
</html>

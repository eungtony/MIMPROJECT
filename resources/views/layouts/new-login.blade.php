<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>TPZ - Connexion</title>
  
  <link rel="stylesheet" href="{{ asset('css/reset.min.css') }}">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='{{ asset('font-awesome/css/font-awesome.css') }}'>

  <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('login/css/custom-form.css') }}">

  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">

</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Inscription</div>
  </div>
  <div class="form">
    <h2>Me connecter à mon compte</h2>
    <form>
      <input type="text" placeholder="Adresse mail"/>
      <input type="password" placeholder="Mot de passe"/>
      <button>Connexion</button>
    </form>
  </div>
  <div class="form">
    <h2>Créer un compte</h2>
    <form>
      <input type="text" placeholder="Nom / Prénom"/>
      <input type="email" placeholder="Adresse mail"/>
      <input type="password" placeholder="Mot de passe"/>
      <input type="password" placeholder="Confirmez Mot de passe"/>
      <button>Créer mon compte</button>
    </form>
  </div>
  <div class="cta"><a href="">Mot de passe oublié?</a></div>
</div>
  <script src='{{ asset('js/jquery-2.1.3.min.js') }}'></script>
  <script src="{{ asset('login/js/index.js') }}"></script>
</body>
</html>

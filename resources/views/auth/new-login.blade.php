@extends('layouts.new-login')

@section('content')
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
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Adresse mail"/>

        <span class="help-block">
        	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </span>

		@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif

        <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe"/>

        @if ($errors->has('password'))
			<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
		@endif

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
  <div class="cta"><a href="{{ url('/password/reset') }}">Mot de passe oublié?</a></div>
</div>
@endsection 
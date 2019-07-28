@extends('view::layouts.login')

@section('title', 'Email')
@section('img', 'bg-login-image')

@section('content')
    <form class="user" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                   id="email" aria-describedby="emailHelp"
                   placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Senha" autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">Lembrar-me</label>
            </div>
        </div>
        <button class="btn btn-primary btn-user btn-block">
            Login
        </button>

    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('password.request') }}">Esqueceu a senha?</a>
    </div>
@endsection

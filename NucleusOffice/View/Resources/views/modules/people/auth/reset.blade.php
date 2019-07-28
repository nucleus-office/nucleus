

@extends('view::layouts.login')

@section('title', 'Reset')
@section('img', 'bg-register-image')

@section('content')
    <div class="text-center">
        <p class="mb-4">Use o formulário abaixo para definir sua nova senha</p>
    </div>
    <form class="user" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
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
            <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" id="password" placeholder="Confirmação de Senha" autocomplete="current-password">
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button class="btn btn-primary btn-user btn-block">
            Redefinir Senha
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('login') }}">Login</a>
    </div>
@endsection

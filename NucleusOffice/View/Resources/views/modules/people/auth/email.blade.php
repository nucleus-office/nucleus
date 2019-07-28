@extends('view::layouts.login')

@section('title', 'Login')
@section('img', 'bg-password-image')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-2">Esqueceu sua senha?</h1>
        <p class="mb-4">Um link para redefinição de senha será enviado para seu email</p>
    </div>
    <form class="user" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if (session('status'))
                <br>
                <div class="alert alert-success" role="alert" style="background-color: #fff">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <button class="btn btn-primary btn-user btn-block">
            Enviar
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('login') }}">Login</a>
    </div>
@endsection


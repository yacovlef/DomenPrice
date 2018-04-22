@extends('admin.layout.admin')

@section('title', ' / Вход в панель администратора')

@section('content')
  <div class="card mt-3">
    <h5 class="card-header bg-white">Вход в панель администратора</h5>

    <div class="card-body">
      <form method="post" action="{{ route('admin.users.login') }}">
        @csrf

        <div class="form-group">
          <label for="email">Эл. почта</label>
          <input id="email" name="email" type="text" class="form-control{{ ($errors->has('email')) ? ' is-invalid' : null }}" value="{{ old('email') }}">

          @if ($errors->has('email'))
            <div class="invalid-feedback">
              {{ $errors->first('email') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="password">Пароль</label>
          <input id="password" name="password" type="password" class="form-control{{ ($errors->has('password')) ? ' is-invalid' : null }}">

          @if ($errors->has('password'))
            <div class="invalid-feedback">
              {{ $errors->first('password') }}
            </div>
          @endif
        </div>

        <a class="btn btn-outline-secondary" href="{{ route('index') }}" role="button">Отменить</a>
        <button type="submit" class="btn btn-outline-dark">Войти</button>
      </form>
    </div>
  </div>
@endsection

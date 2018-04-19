@extends('admin.layout.dashboard')

@section('title', ' / Панель администратора / Пользователи / Новый пользователь')

@section('content')
  <div class="card mt-3">
    <h5 class="card-header">Новый пользователь</h5>
    
    <div class="card-body">
      <form method="post" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
          <label for="first_name">Имя</label>
          <input id="first_name" name="first_name" type="text" class="form-control{{ ($errors->has('first_name')) ? ' is-invalid' : null }}">

          @if ($errors->has('first_name'))
            <div class="invalid-feedback">
              {{ $errors->first('first_name') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="last_name">Фамилия</label>
          <input id="last_name" name="last_name" type="text" class="form-control{{ ($errors->has('last_name')) ? ' is-invalid' : null }}">

          @if ($errors->has('last_name'))
            <div class="invalid-feedback">
              {{ $errors->first('last_name') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="email">Эл. почта</label>
          <input id="email" name="email" type="text" class="form-control{{ ($errors->has('email')) ? ' is-invalid' : null }}">

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

        <div class="form-group">
          <label for="password_confirmation">Подтвердите пароль</label>
          <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-outline-dark">Сохранить</button>
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}" role="button">Отменить</a>
      </form>
    </div>
  </div>
@endsection

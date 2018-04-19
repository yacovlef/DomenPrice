@extends('admin.layout.dashboard')

@section('title', ' / Панель администратора / Пользователи / Новый пользователь')

@section('content')
<div class="card mt-3">
  <div class="card-header">
    Новый пользователь
  </div>
  <div class="card-body">
    <form>
      <div class="form-group">
        <label for="first_name">Имя</label>
        <input id="first_name" name="first_name" type="text" class="form-control">
      </div>

      <div class="form-group">
        <label for="last_name">Фамилия</label>
        <input id="last_name" name="last_name" type="text" class="form-control">
      </div>

      <div class="form-group">
        <label for="email">Эл. почта</label>
        <input id="email" name="email" type="text" class="form-control">
      </div>

      <div class="form-group">
        <label for="password">Пароль</label>
        <input id="password" name="password" type="password" class="form-control">
      </div>

      <div class="form-group">
        <label for="confirm_password">Подтвердите пароль</label>
        <input id="confirm_password" name="confirm_password" type="password" class="form-control">
      </div>

      <button type="button" class="btn btn-outline-dark">Сохранить</button>
      <a class="btn btn-outline-secondary" href="{{ route('users.index') }}" role="button">Отменить</a>
    </form>
  </div>
</div>
@endsection

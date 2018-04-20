@extends('admin.layout.admin')

@section('title', ' / Панель администратора / Пользователи')

@section('content')
  <a class="btn btn-outline-dark mt-3" href="{{ route('admin.users.create') }}" role="button">Добавить пользователя</a>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Эл. почта</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.users.edit', ['id' => $user->id]) }}" role="button">Редактировать</a>

            <form method="post" action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" class="d-inline">
              @method('DELETE')
              @csrf

              <button type="submit" class="btn btn-outline-dark btn-sm">Удалить</button>
            </form>

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

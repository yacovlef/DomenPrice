@extends('admin.layout.admin')

@section('title', ' | Панель администратора | Регистраторы')

@section('content')
  <a class="btn btn-outline-dark" href="{{ route('admin.registrars.create') }}" role="button">Добавить регистратора</a>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Slug</th>
        <th scope="col">Имя</th>
        <th scope="col">Логотип</th>
        <th scope="col">WWW</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($registrars as $registrar)
        <tr>
          <th scope="row">{{ $registrar->id }}</th>
          <td>{{ $registrar->slug }}</td>
          <td>{{ $registrar->name }}</td>
          <td><img src="{{ Storage::url($registrar->logo) }}" height="25" alt="registrar_logo"></td>
          <td>{{ $registrar->www }}</td>
          <td>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.registrars.edit', ['id' => $registrar->id]) }}" role="button">Редактировать</a>

            <form method="post" action="{{ route('admin.registrars.destroy', ['id' => $registrar->id]) }}" class="d-inline">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-outline-dark btn-sm" onclick="return confirm ('Удалить регистратора?')">Удалить</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $registrars->links() }}
@endsection

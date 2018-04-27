@extends('admin.layout.admin')

@section('title', ' | Панель администратора | Домены')

@section('content')
  <a class="btn btn-outline-dark" href="{{ route('admin.domains.create') }}" role="button">Добавить домен</a>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Slug</th>
        <th scope="col">Имя</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($domains as $domain)
        <tr>
          <th scope="row">{{ $domain->id }}</th>
          <td>{{ $domain->slug }}</td>
          <td>{{ $domain->name }}</td>
          <td>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.domains.edit', ['id' => $domain->id]) }}" role="button">Редактировать</a>

            <form method="post" action="{{ route('admin.domains.destroy', ['id' => $domain->id]) }}" class="d-inline">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-outline-dark btn-sm" onclick="return confirm ('Удалить домен?')">Удалить</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $domains->links() }}
@endsection

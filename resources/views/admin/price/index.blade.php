@extends('admin.layout.admin')

@section('title', ' / Панель администратора / Цены')

@section('content')
  <a class="btn btn-outline-dark mt-3" href="{{ route('admin.prices.create') }}" role="button">Добавить цену</a>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Цена</th>
        <th scope="col">Домен</th>
        <th scope="col">Регистратор</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($prices as $price)
        <tr>
          <th scope="row">{{ $price->id }}</th>
          <td>{{ $price->price }}</td>
          <td>{{ $price->domain->name }}</td>
          <td>{{ $price->registrar->name }}</td>
          <td>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.prices.edit', ['id' => $price->id]) }}" role="button">Редактировать</a>

            <form method="post" action="{{ route('admin.prices.destroy', ['id' => $price->id]) }}" class="d-inline">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-outline-dark btn-sm" onclick="return confirm ('Удалить цену?')">Удалить</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $prices->links() }}
@endsection

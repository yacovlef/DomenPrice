@extends('layout.app')

@section('title', ' / Регистраторы')

@section('content')
  <div class="row justify-content-center">
    <div class="col-auto">
      <h1 class="mt-3">{{ $registrar->name }}</h1>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-auto col-sm-8 col-md-6">
      <table class="table mt-3">
        <thead>
          <tr>
            <th scope="col" class="border-0 text-center">Цена</th>
            <th scope="col" class="border-0 text-center">Домен</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($prices as $price)
            <tr>
              <td class="text-center">{{ $price->price }} руб.</td>
              <td class="text-center"><a href="{{ route('domains.show', ['slug' => $price->domain->slug]) }}" class="text-dark">{{ $price->domain->name }}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-auto">
      {{ $prices->links() }}
    </div>
  </div>
@endsection

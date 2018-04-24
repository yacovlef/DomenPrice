@extends('layout.app')

@section('title', ' / Домены')

@section('content')
  <div class="row justify-content-center">
    <div class="col-auto">
      <h1 class="mt-3">{{ $domain->name }}</h1>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-auto col-sm-8 col-md-6">
      <table class="table mt-3">
        <thead>
          <tr>
            <th scope="col" class="border-0 text-center">Цена</th>
            <th scope="col" class="border-0 text-center">Регистратор</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($prices as $price)
            <tr>
              <td class="text-center">{{ $price->price }} руб.</td>
              <td class="text-center"><img src="{{ Storage::url($price->registrar->logo) }}" height="20" alt="registrar_logo"> <a href="" class="text-dark">{{ $price->registrar->name }}</a></td>
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

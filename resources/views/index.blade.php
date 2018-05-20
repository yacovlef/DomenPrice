@extends('layout.app')

@section('title', ' - сравнение цен на доменные зоны')

@section('content')
  <div class="row">
    <div class="col text-center">
      <h5>Найдите лучшее ценовое предложение на доменные зоны</h5>
    </div>
  </div>
  <div class="row">
    <div class="col text-center">
      <h6>{{ $domainsCount }} доменов | {{ $registrarsCount }} регистраторов | {{ $pricesCount }} предложений</h6>
    </div>
  </div>
  <div class="row">
    <div class="col text-center">
      <h6> Последнее обновление: {{ $priceUpdateLast }}</h6>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-6">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="border-0"></th>
            <th scope="col" colspan="2" class="text-center border-0 bg-light">Лучшая цена</th>
            <th scope="col" class="border-0"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($domains as $domain)
            <tr>
              <th scope="row"><a href="{{ route('domains.show', ['slug' => $domain->slug]) }}" class="text-dark">{{ $domain->name }}</a></th>
              <td class="text-center bg-light">{{ $domain->registrar_price }} руб.</td>
              <td class="text-center bg-light"><img src="{{ Storage::url($domain->registrar_logo) }}" height="25" alt="registrar_logo"> <a href="{{ $domain->registrar_www }}" target="_blank" class="text-dark">{{ $domain->registrar_name }}</a></td>
              <td class="text-right"><a href="{{ route('domains.show', ['slug' => $domain->slug]) }}" class="text-dark">+ {{ $domain->prices_count }} цен(ы)</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-auto">
      {{ $domains->links() }}
    </div>
  </div>
@endsection

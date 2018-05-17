@extends('layout.app')

@section('title', ' - сравнение цен на доменные зоны')

@section('content')
  <div class="row justify-content-center">
    <div class="col-auto">
      <h6>{{ 'Последнее обновление: ' . $priceUpdateLast }}</h6>
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
            @if ($domain->prices_count > 0)
              @php
                $price = $domain->prices()->orderBy('price')->first();
                $registrar = $price->registrar;
              @endphp

              <tr>
                <th scope="row"><a href="{{ route('domains.show', ['slug' => $domain->slug]) }}" class="text-dark">{{ $domain->name }}</a></th>
                <td class="text-center bg-light">{{ $price->price }} руб.</td>
                <td class="text-center bg-light"><img src="{{ Storage::url($registrar->logo) }}" height="25" alt="registrar_logo"> <a href="{{ $registrar->www }}" class="text-dark">{{ $registrar->name }}</a></td>
                <td class="text-right"><a href="{{ route('domains.show', ['slug' => $domain->slug]) }}" class="text-dark">+ {{ $domain->prices_count }} цен(ы)</a></td>
              </tr>
            @endif
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

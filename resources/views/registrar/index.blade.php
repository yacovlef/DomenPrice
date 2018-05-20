@extends('layout.app')

@section('title', ' | Регистраторы')

@section('content')
  <div class="row">
    <div class="col text-center">
      <h5>Регистраторы</h5>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-6">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="border-0 text-center"></th>
            <th scope="col" class="border-0 text-center">WWW</th>
            <th scope="col" class="border-0 text-center">Доменов</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($registrars as $registrar)
            <tr>
              <td class="text-center"><img src="{{ Storage::url($registrar->logo) }}" height="25" alt="registrar_logo"> <a href="{{ route('registrars.show', ['slug' => $registrar->slug]) }}" class="text-dark">{{ $registrar->name }}</a></td>
              <td class="text-center"><a href="{{ $registrar->www }}" target="_blank" class="text-dark">{{ $registrar->www }}</a></td>
              <td class="text-center"><a href="{{ route('registrars.show', ['slug' => $registrar->slug]) }}" class="text-dark">{{ $registrar->prices_count }}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-auto">
      {{ $registrars->links() }}
    </div>
  </div>
@endsection

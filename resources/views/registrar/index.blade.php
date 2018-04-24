@extends('layout.app')

@section('title', ' / Регистраторы')

@section('content')
  <div class="row justify-content-center">
    <div class="col-auto">
      <h1 class="mt-3">Регистраторы</h1>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-auto col-sm-10 col-md-8">
      <table class="table mt-3">
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
              <td class="text-center"><img src="{{ Storage::url($registrar->logo) }}" height="20" alt="registrar_logo"> <a href="" class="text-dark">{{ $registrar->name }}</a></td>
              <td class="text-center"><a class="text-dark" href="{{ $registrar->www }}">{{ $registrar->www }}</a></td>
              <td class="text-center">{{ $registrar->prices_count }}</td>
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

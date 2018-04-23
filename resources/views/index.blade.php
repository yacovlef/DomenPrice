@extends('layout.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-auto col-sm-8">
      <table class="table table-hover mt-5">
        <thead>
          <tr>
            <th scope="col" class="border-0"></th>
            <th scope="col" colspan="2" class="text-center border-0">Лучшая цена</th>
            <th scope="col" class="border-0"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($domains as $domain)
            <tr>
              <th scope="row">{{ $domain->name }}</th>
              <td class="text-center">{{ $domain->prices()->orderBy('price')->first()->price }} руб.</td>
              <td class="text-center"><img src="{{ Storage::url($domain->prices()->orderBy('price')->first()->registrar->logo) }}" height="20" alt="registrar_logo"> {{ $domain->prices()->orderBy('price')->first()->registrar->name }}</td>
              <td class="text-right">+ {{ $domain->prices()->count() }} цен(ы)</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $domains->links() }}
    </div>
  </div>

@endsection

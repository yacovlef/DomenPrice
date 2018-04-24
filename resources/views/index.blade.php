@extends('layout.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-auto col-sm-10 col-md-8">
      <table class="table mt-3">
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
              <tr>
                <th scope="row"><a href="{{ route('domains.show', ['slug' => $domain->slug]) }}" class="text-dark">{{ $domain->name }}</a></th>
                <td class="text-center bg-light">{{ $domain->prices()->orderBy('price')->first()->price }} руб.</td>
                <td class="text-center bg-light"><img src="{{ Storage::url($domain->prices()->orderBy('price')->first()->registrar->logo) }}" height="20" alt="registrar_logo"> <a href="" class="text-dark">{{ $domain->prices()->orderBy('price')->first()->registrar->name }}</a></td>
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

<div class="card mt-3">
  <h5 class="card-header bg-white">{{ (request()->is('admin/prices/create')) ? 'Новая цена' : 'Редактирование цены'}}</h5>

  <div class="card-body">
    <form method="post" action="{{ (request()->is('admin/prices/create')) ? route('admin.prices.store') : route('admin.prices.update', ['id' => $price->id]) }}">
      @csrf
      @unless (request()->is('admin/prices/create'))
        @method('PUT')
      @endunless

      <div class="form-group">
        <label for="price">Цена</label>
        <input id="price" name="price" type="text" class="form-control{{ ($errors->has('price')) ? ' is-invalid' : null }}" value="{{ (request()->is('admin/prices/create')) ? old('price') : $price->price }}">

        @if ($errors->has('price'))
          <div class="invalid-feedback">
            {{ $errors->first('price') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="domain">Домен</label>
        <select id="domain" name="domain" class="form-control{{ ($errors->has('domain')) ? ' is-invalid' : null }}">
          <option></option>
          @foreach ($domains as $domain)
            <option value="{{ $domain->id }}"{{ (request()->is('admin/prices/create')) ? null : ($price->domain_id == $domain->id) ? ' selected' : null }}>{{ $domain->name }}</option>
          @endforeach
        </select>

        @if ($errors->has('domain'))
          <div class="invalid-feedback">
            {{ $errors->first('domain') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="registrar">Регистратор</label>
        <select id="registrar" name="registrar" class="form-control{{ ($errors->has('registrar')) ? ' is-invalid' : null }}">
          <option></option>
          @foreach ($registrars as $registrar)
            <option value="{{ $registrar->id }}"{{ (request()->is('admin/prices/create')) ? null : ($price->registrar_id == $registrar->id) ? ' selected' : null }}>{{ $registrar->name }}</option>
          @endforeach
        </select>

        @if ($errors->has('registrar'))
          <div class="invalid-feedback">
            {{ $errors->first('registrar') }}
          </div>
        @endif
      </div>

      <a class="btn btn-outline-secondary" href="{{ route('admin.prices.index') }}" role="button">Отменить</a>
      <button type="submit" class="btn btn-outline-dark">Сохранить</button>
    </form>
  </div>
</div>

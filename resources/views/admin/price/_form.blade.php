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
        <label for="domain_id">Домен</label>
        <select id="domain_id" name="domain_id" class="form-control{{ ($errors->has('domain_id')) ? ' is-invalid' : null }}">
          <option></option>
          @foreach ($domains as $domain)
            <option value="{{ $domain->id }}"{{ (request()->is('admin/prices/create')) ? null : ($price->domain_id == $domain->id) ? ' selected' : null }}>{{ $domain->name }}</option>
          @endforeach
        </select>

        @if ($errors->has('domain_id'))
          <div class="invalid-feedback">
            {{ $errors->first('domain_id') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="registrar_id">Регистратор</label>
        <select id="registrar_id" name="registrar_id" class="form-control{{ ($errors->has('registrar_id')) ? ' is-invalid' : null }}">
          <option></option>
          @foreach ($registrars as $registrar)
            <option value="{{ $registrar->id }}"{{ (request()->is('admin/prices/create')) ? null : ($price->registrar_id == $registrar->id) ? ' selected' : null }}>{{ $registrar->name }}</option>
          @endforeach
        </select>

        @if ($errors->has('registrar_id'))
          <div class="invalid-feedback">
            {{ $errors->first('registrar_id') }}
          </div>
        @endif
      </div>

      <a class="btn btn-outline-secondary" href="{{ route('admin.prices.index') }}" role="button">Отменить</a>
      <button type="submit" class="btn btn-outline-dark">Сохранить</button>
    </form>
  </div>
</div>

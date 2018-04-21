<div class="card mt-3">
  <h5 class="card-header bg-white">Новый домен</h5>

  <div class="card-body">
    <form method="post" action="{{ (Route::currentRouteName() == 'admin.domains.create') ? route('admin.domains.store') : route('admin.domains.update', ['id' => $domain->id]) }}">
      @csrf
      @unless (Route::currentRouteName() == 'admin.domains.create')
        @method('PUT')
      @endunless

      <div class="form-group">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" type="text" class="form-control{{ ($errors->has('slug')) ? ' is-invalid' : null }}" value="{{ (Route::currentRouteName() == 'admin.domains.create') ? old('slug') : $domain->slug }}">

        @if ($errors->has('slug'))
          <div class="invalid-feedback">
            {{ $errors->first('slug') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="name">Имя</label>
        <input id="name" name="name" type="text" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : null }}" value="{{ (Route::currentRouteName() == 'admin.domains.create') ? old('name') : $domain->name }}">

        @if ($errors->has('name'))
          <div class="invalid-feedback">
            {{ $errors->first('name') }}
          </div>
        @endif
      </div>

      <a class="btn btn-outline-secondary" href="{{ route('admin.domains.index') }}" role="button">Отменить</a>
      <button type="submit" class="btn btn-outline-dark">Сохранить</button>
    </form>
  </div>
</div>

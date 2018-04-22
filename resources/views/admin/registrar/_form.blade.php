<div class="card mt-3">
  <h5 class="card-header bg-white">{{ (request()->is('admin/prices/create')) ? 'Новый регистратор' : 'Редактирование регистратора'}}</h5>

  <div class="card-body">
    <form enctype="multipart/form-data" method="post" action="{{ (request()->is('admin/registrars/create')) ? route('admin.registrars.store') : route('admin.registrars.update', ['id' => $registrar->id]) }}">
      @csrf
      @unless (request()->is('admin/registrars/create'))
        @method('PUT')
      @endunless

      <div class="form-group">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" type="text" class="form-control{{ ($errors->has('slug')) ? ' is-invalid' : null }}" value="{{ (request()->is('admin/registrars/create')) ? old('slug') : $registrar->slug }}">

        @if ($errors->has('slug'))
          <div class="invalid-feedback">
            {{ $errors->first('slug') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="name">Имя</label>
        <input id="name" name="name" type="text" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : null }}" value="{{ (request()->is('admin/registrars/create')) ? old('name') : $registrar->name }}">

        @if ($errors->has('name'))
          <div class="invalid-feedback">
            {{ $errors->first('name') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="logo">Логотип</label>
        <input id="logo" name="logo" type="file" class="form-control{{ ($errors->has('logo')) ? ' is-invalid' : null }}">

        @if ($errors->has('logo'))
          <div class="invalid-feedback">
            {{ $errors->first('logo') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="www">WWW</label>
        <input id="www" name="www" type="text" class="form-control{{ ($errors->has('www')) ? ' is-invalid' : null }}" value="{{ (request()->is('admin/registrars/create')) ? old('www') : $registrar->www }}">

        @if ($errors->has('www'))
          <div class="invalid-feedback">
            {{ $errors->first('www') }}
          </div>
        @endif
      </div>

      <a class="btn btn-outline-secondary" href="{{ route('admin.registrars.index') }}" role="button">Отменить</a>
      <button type="submit" class="btn btn-outline-dark">Сохранить</button>
    </form>
  </div>
</div>

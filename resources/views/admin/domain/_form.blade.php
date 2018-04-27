<div class="card">
  <h5 class="card-header bg-white">{{ (request()->is('admin/prices/create')) ? 'Новый домен' : 'Редактирование домена'}}</h5>

  <div class="card-body">
    <form method="post" action="{{ (request()->is('admin/domains/create')) ? route('admin.domains.store') : route('admin.domains.update', ['id' => $domain->id]) }}">
      @csrf
      @unless (request()->is('admin/domains/create'))
        @method('PUT')
      @endunless

      <div class="form-group">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" type="text" class="form-control{{ ($errors->has('slug')) ? ' is-invalid' : null }}" value="{{ (request()->is('admin/domains/create')) ? ((old('slug')) ? old('slug') : null) : ((old('slug')) ? old('slug') : $domain->slug) }}">

        @if ($errors->has('slug'))
          <div class="invalid-feedback">
            {{ $errors->first('slug') }}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label for="name">Имя</label>
        <input id="name" name="name" type="text" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : null }}" value="{{ (request()->is('admin/domains/create')) ? ((old('name')) ? old('name') : null) : ((old('name')) ? old('name') : $domain->name) }}">                                                                                                                          

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

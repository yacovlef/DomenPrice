<nav class="navbar navbar-expand-lg navbar-light mb-3">
  <a class="navbar-brand" href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item{{ (request()->is('registrars*')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('registrars.index') }}">Регистраторы</a>
      </li>
      <li class="nav-item{{ (request()->is('feedback')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('feedback') }}">Обратная связь</a>
      </li>
    </ul>
  </div>
</nav>

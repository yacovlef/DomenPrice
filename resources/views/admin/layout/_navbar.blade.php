<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item{{ (URL::current() == route('admin.dashboard.index')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">Главная</a>
      </li>
      <li class="nav-item{{ (URL::current() == route('admin.domains.index')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('admin.domains.index') }}">Домены</a>
      </li>
      <li class="nav-item{{ (URL::current() == route('admin.registrars.index')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('admin.registrars.index') }}">Регистраторы</a>
      </li>
      <li class="nav-item{{ (URL::current() == route('admin.prices.index')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('admin.prices.index') }}">Цены</a>
      </li>
      <li class="nav-item{{ (URL::current() == route('admin.users.index')) ? ' active' : null }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">Пользователи</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Яковлев Алексей
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Выход</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

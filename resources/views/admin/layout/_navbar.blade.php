<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Главная</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Домены</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Регистраторы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Цены</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Пользователи</a>
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

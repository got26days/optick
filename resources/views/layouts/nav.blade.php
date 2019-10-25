<nav class="navbar navbar-expand-lg navbar-dark navbar-grid">
  <div class="container">
    {{-- <a class="navbar-brand" href="#">LOGO</a> --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item {{ (\Request::route()->getName() == 'index') ? 'active' : '' }}">
          <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-dot">
          <span></span>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'catalog') ? 'active' : '' }}">
          <a class="nav-link" href="/catalog">Каталог <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-dot">
          <span></span>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'stock') ? 'active' : '' }}">
          <a class="nav-link" href="/stock">Акции <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-dot">
          <span></span>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'services') ? 'active' : '' }}">
          <a class="nav-link" href="/services">Услуги <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-dot">
          <span></span>
        </li>
        <li class="nav-item {{ (\Request::route()->getName() == 'contact') ? 'active' : '' }}">
          <a class="nav-link" href="/contact">Контакты <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      {{-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> --}}
    </div>
  </div>
</nav>

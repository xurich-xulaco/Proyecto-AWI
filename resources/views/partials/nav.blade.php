<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">Pizza-Hat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Ingresar</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrar</a></li>
        @else
          <x-pizza-loader class="me-3"/> {{-- Animación 3D --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a href="{{ route('home') }}" class="dropdown-item">Dashboard</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item">Salir</button>
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<adw-appbar>
  <div slot="start">
    <a href="{{ url('/') }}">
      <adw-button variant="text">{{ config('app.name', 'PizzaHat') }}</adw-button>
      {{-- Logo 3D inclinada --}}
      <x-pizza-logo size="40" />
      <adw-button variant="text">{{ config('app.name', 'PizzaHat') }}</adw-button>
    </a>
  </div>

  <div slot="end">
    @guest
      <a href="{{ route('login') }}">
        <adw-button variant="text">Iniciar sesión</adw-button>
      </a>
      <a href="{{ route('register') }}">
        <adw-button variant="text">Registro</adw-button>
      </a>
    @else
      <adw-dropdown>
        <span slot="trigger">{{ Auth::user()->name }}</span>
        <adw-list slot="dropdown">
          <adw-list-item>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Cerrar sesión
            </a>
          </adw-list-item>
        </adw-list>
      </adw-dropdown>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
      </form>
    @endguest
  </div>
</adw-appbar>

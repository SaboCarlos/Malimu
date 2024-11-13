<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="{{url('/#hero')}}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{asset('assets/img/logo.png')}}" alt="">
        <!--<h1 class="sitename">Append</h1><span>.</span> -->
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{url('/#hero')}}" class="active">Home</a></li>
          <li><a href="{{url('/#about')}}">Sobre nós</a></li>
          <li><a href="{{url('/#services')}}">Serviços</a></li>
          <li><a href="{{url('/#portfolio')}}">Portfólio</a></li>
          <li><a href="{{url('/#team')}}">Assistentes</a></li>
          <li><a href="{{route('start')}}">StartMozBiz</a></li>
          <li><a href="{{url('/#contact')}}">Contacto</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      @if (Route::has('login'))
        @auth
          @if (Auth::user()->role == 'admin')
            <a class="btn-getstarted" href="{{route('admin.dashboard')}}">Dashboard</a>
          @else   
            <a href="#" class="btn-getstarted dropdown-toggle" data-bs-toggle="dropdown">
                      <i class="bi bi-person"></i>
                      <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                      <a href="{{ route('perfil')}}" class="dropdown-item">Meu Perfil</a>
                      <a href="{{ route('informação.index')}}" class="dropdown-item">Assistente</a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}</a>
      
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </div>

          @endif
            
        @else
            <a class="btn-getstarted" href="{{route('login')}}">Get Started</a>
        @endauth
      @endif
    </div>
  </header>
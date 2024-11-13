<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
  <a href="{{ url('admin/dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
      <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
  </a>
  <a href="#" class="sidebar-toggler flex-shrink-0">
      <i class="fa fa-bars"></i>
  </a>

  <div class="navbar-nav align-items-center ms-auto">
      <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fa fa-home me-lg-2"></i>
              <span class="d-none d-lg-inline-flex">publicações</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
            {{--@foreach ($userImovel as $usermob )
                @if($usermob->user_id != auth()->user()->id)
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        @if ($usermob->produtoImages->count() > 0)
                            <img class="rounded-circle" src="{{ asset($usermob->produtoImages[0]->imagem)}}" alt="" style="width: 40px; height: 40px;">
                        @endif
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">{{$usermob->nome}}</h6>
                            <small>{{$usermob->preco}} Mt</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                @endif
            @endforeach--}}
              
              <a href="{{ url('admin/usermob')}}" class="dropdown-item text-center">Ver Todas</a>
          </div>
      </div>
      <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fa fa-bell me-lg-2"></i>
              <span class="d-none d-lg-inline-flex">Notificações</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
           {{--@forelse ($users as $user )
              
              <a href="#" class="dropdown-item">
                  <h6 class="fw-normal mb-0">{{ $user->name}}</h6>
                  <small>{{ $user->created_at}}</small>
              </a>
              <hr class="dropdown-divider">
            @empty
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Sem Notificações</h6>
                </a>
            @endforelse--}}
            <a href="{{ url('admin/users')}}" class="dropdown-item text-center">Ver Todos</a>
          </div>
      </div>
      <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img class="rounded-circle me-lg-2" src="{{ asset('admin/img/favicon.png')}}" alt="" style="width: 40px; height: 40px;">
              <span class="d-none d-lg-inline-flex"> {{ Auth::user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
              <a href="{{ url('admin/configuracao') }}" class="dropdown-item">Settings</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              
      </div>
  </div>
</nav>
<!-- Navbar End -->
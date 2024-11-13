        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
          <nav class="navbar bg-light navbar-light">
              <a href="{{ url('/')}}" class="navbar-brand mx-4 mb-3">
                  <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>MALIMU</h3>
              </a>
              <div class="d-flex align-items-center ms-4 mb-4">
                  <div class="position-relative">
                      <img class="rounded-circle" src="{{ asset('assets/img/favicon.png')}}" alt="" style="width: 40px; height: 40px;">
                      <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                  </div>
                  <div class="ms-3">
                      <h6 class="mb-0"> {{ Auth::user()->name }}</h6>
                      <span>Admin</span>
                  </div>
              </div>
              <div class="navbar-nav w-100">
                  <a href="{{ url('admin/dashboard')}}" class="nav-item nav-link {{ Request::is('admin/dashboard') ? 'active':''}} "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                  <a href="{{ url('admin/assistentes')}}" class="nav-item nav-link {{ Request::is('admin/assistentes') ? 'active':''}}"><i class="fa fa-users me-2"></i>Assistentes</a>
                  <a href="{{ url('admin/cadastros')}}" class="nav-item nav-link {{ Request::is('admin/cadastros') ? 'active':''}}"><i class="fa fa-book me-2"></i>Cadastros</a>
                  <a href="{{ url('admin/solicitacoes')}}" class="nav-item nav-link {{ Request::is('admin/solicitacoes') ? 'active':''}}"><i class="fa fa-inbox me-2"></i>Solicitações</a>
                  <a href="{{ url('admin/newsletters/whatsapp')}}" class="nav-item nav-link {{ Request::is('admin/newsletters/whatsapp') ? 'active':''}}"><i class="fab fa-whatsapp me-2"></i>Whatsapp</a>
                  <a href="{{ url('admin/newsletters/email')}}" class="nav-item nav-link {{ Request::is('admin/newsletters/email') ? 'active':''}}"><i class="fa fa-envelope me-2"></i>Email</a>
                  <a href="{{ route('admin.user')}}" class="nav-item nav-link {{ Request::is('admin/user') ? 'active':''}}"><i class="fa fa-user me-2"></i>Usuarios</a>
              </div>
          </nav>
      </div>
      <!-- Sidebar End -->
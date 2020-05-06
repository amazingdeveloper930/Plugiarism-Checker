<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">

              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              <div class="ripple-container"></div></button>
            </div>

            <a class="navbar-brand">
              @if (request()->is('user/newsearch'))
                      <h1>New Search</h1>
              @elseif (request()->is('user/price'))
                      <h1>Pricing</h1>
              @elseif (request()->is('user/report'))
                      <h1>Reports</h1>
              @elseif (request()->is('user/help'))
                      <h1>Help Tool</h1>
              @elseif (request()->is('user/dashboard'))
                      <h1>Dashboard</h1>
              @elseif (request()->is('user/demoview'))
                      <h1>Demo User</h1>
              @elseif (request()->is('user/reports'))
                      <h1>Reports List</h1>
              @endif
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  @if(!Auth::check())
                  <a class="dropdown-item" href="{{ route('login') }}">Log in</a>
                  @else
                  <a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
                  @endif
                  <a class="dropdown-item" href="{{ route('user.newsearch') }}">New Searching</a>
                  <a class="dropdown-item" href="{{ route('user.price') }}">Pricing</a>
                  <a class="dropdown-item" href="{{ route('user.reports') }}">Reports</a>
                  <a class="dropdown-item" href="{{ route('user.help') }}">Help</a>
                  @if(Auth::check())
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('user.logout') }}">Log out</a>
                  @endif
                </div>
               
              </li>
            </ul>
          </div>
        </div>
      </nav>
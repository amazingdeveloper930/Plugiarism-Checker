    <div class="sidebar" data-color=<?php echo session()->get('sidebar_fore_color', function () {
        return 'purple';
      }); ?>

     data-background-color=<?php echo session()->get('sidebar_back_color', function () {
        return 'white';
      }); ?> >
      <div class="logo">
        <a  class="simple-text logo-mini">
          &nbsp;
        </a>
        <a  class="simple-text logo-normal">
          Text Checker
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          @if(Auth::check())
          <li class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.dashboard') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          @endif
          <li class="nav-item {{ request()->is('user/newsearch') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.newsearch') }}">
              <i class="material-icons">search</i>
              <p>New Search</p>
            </a>
          </li>
          @if(Session::has('demo_amount'))
          <li class="nav-item {{ request()->is('user/demoview') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.demo') }}">
              <i class="material-icons">donut_small</i>
              <p>My users</p>
            </a>
          </li>
          @endif
          <li class="nav-item {{ request()->is('user/reports') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.reports') }}">
              <i class="material-icons">assignment_returned</i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('user/help') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.help') }}">
              <i class="material-icons">help</i>
              <p>Help</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
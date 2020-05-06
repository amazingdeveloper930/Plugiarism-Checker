    <div class="sidebar" data-color=<?php echo session()->get('sidebar_fore_color', function () {
        return 'purple';
      }); ?>

     data-background-color=<?php echo session()->get('sidebar_back_color', function () {
        return 'white';
      }); ?> >
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a  class="simple-text logo-mini">
          &nbsp;
        </a>
        <a  class="simple-text logo-normal">
          Admin
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/paymentlist') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.paymentlist') }}">
              <i class="material-icons">attach_money</i>
              <p>Payment List</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/orderlist') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.orderlist') }}">
              <i class="material-icons">assignment</i>
              <p>Order List</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/settings') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.settings') }}">
              <i class="material-icons">settings</i>
              <p>Settings</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('admin.logout') }}">
              <i class="material-icons">power_settings_new</i>
              <p>Log out</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
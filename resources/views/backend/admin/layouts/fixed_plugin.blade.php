<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple {{ session()->get('sidebar_fore_color') == 'purple'?'active':''}}" data-color="purple"></span>
              <span class="badge filter badge-azure {{ session()->get('sidebar_fore_color') == 'azure'?'active':''}}" data-color="azure"></span>
              <span class="badge filter badge-green {{ session()->get('sidebar_fore_color') == 'green'?'active':''}}" data-color="green"></span>
              <span class="badge filter badge-warning {{ session()->get('sidebar_fore_color') == 'orange'?'active':''}}" data-color="orange"></span>
              <span class="badge filter badge-danger {{ session()->get('sidebar_fore_color') == 'danger'?'active':''}}" data-color="danger"></span>
              <span class="badge filter badge-rose {{ session()->get('sidebar_fore_color') == 'rose'?'active':''}}" data-color="rose"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="ml-auto mr-auto">
              <?php 
              $sidebar_back_color  = session()->get('sidebar_back_color', function () {
                  return 'white';
              });
              ?>
              
                <span class="badge filter badge-black {{$sidebar_back_color == 'black'?'active':''}}" data-background-color="black"></span>
                <span class="badge filter badge-white {{$sidebar_back_color == 'white'?'active':''}}" data-background-color="white"></span>
                <span class="badge filter badge-red {{$sidebar_back_color == 'red'?'active':''}}" data-background-color="red"></span>
             
            </div>
            <div class="clearfix"></div>
          <div class="ripple-container"></div></a>
        </li>
      </ul>
    </div>
  </div>
@extends('backend.admin.layouts.default')

@section('content')
<script type="text/javascript">
  
  $( document ).ready(function() {
   swal({ title:"Sorry!", text: "This function is not opened yet", type: "error", buttonsStyling: false, confirmButtonClass: "btn btn-success"}).then((result) => {
      window.location.href = "{{ route('admin.settings') }}";
});
  });
</script>
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">content_copy</i>
        </div>
        <p class="card-category">Used Space</p>
        <h3 class="card-title">49/50
          <small>GB</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          Current Status is good
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
          <i class="material-icons">store</i>
        </div>
        <p class="card-category">Total Payment</p>
        <h3 class="card-title">$34,245</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">date_range</i> All Times
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">info_outline</i>
        </div>
        <p class="card-category">Total Tasks</p>
        <h3 class="card-title">75</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">date_range</i> All Times
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="card card-chart">
      <div class="card-header card-header-success">
        <div class="ct-chart" id="dailySalesChart"></div>
      </div>
      <div class="card-body">
        <h4 class="card-title">Daily Sales</h4>
        <p class="card-category">
          <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> updated 4 minutes ago
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card card-chart">
      <div class="card-header card-header-danger">
        <div class="ct-chart" id="completedTasksChart"></div>
      </div>
      <div class="card-body">
        <h4 class="card-title">Completed Tasks</h4>
        <p class="card-category">Last Campaign Performance</p>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> campaign sent 2 days ago
        </div>
      </div>
    </div>
  </div>
</div>


@stop
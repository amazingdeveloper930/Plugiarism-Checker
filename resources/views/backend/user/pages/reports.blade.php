@extends('backend.user.layouts.default')
@section('title', 'Plagiarismchecker | Report List Page')
@section('description', "Plagiarismchecker | Report List Page")
@section('content')

<input id = "deletereporturl" value="{{route('report.delete')}}" hidden>

<div class="row">
   @if(Session::has('demo_amount'))
 
   <button type = "button" class = "col-md-3 col-sm-12 btn btn-primary" onclick="upload_file()" style="margin-left: 30%">Upload file and check for plagiarism</button>
   @endif
	<div class="col-md-12">
    
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment_returned</i>
                  </div>
                  <h4 class="card-title">My Reports</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id = "report-list">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th >File Name</th>
                          <th class="text-center">Score</th>
                          <th class="text-center">Progress</th>
                          <th class="text-center">Search Type</th>
                          <th class="text-center">Date</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($report_list) == 0)
                        <tr>
                          <td colspan="7" class="text-center">There is no report</td>
                        </tr>
                        @else
                        <?php
                        $index = 1;
                        ?>
                        @foreach ($report_list as $report)
                        <tr id = "{{'report-'.$report['report_id']}}">
                          <td class="text-center" >{{ $index }}</td>
                          
                          @if ($report['status'] == 0 || $report['status'] == '0')
                          <td ><span class="text-primary">{{ $report['file_name'] }}</span></td>
                          <td class="text-center"> ------- </td>
                          <td class="text-center">Progressing...</td>
                          <td class="text-center"> ------- </td>
                          <td class="text-center">{{$report['made_at']}}</td>
                          <td class="td-actions text-right">
                            -------
                          </td>
                          @else
                          <td ><a href = "{{route('user.report', ['id' => $report['report_id']])}}" data-original-title="View Report" title="View Report">{{ $report['file_name'] }}</a></td>
                          <td class="text-center">
                          	<div class="progress-container">
    							<span class="progress-badge">{{$report['score']}}%</span>
		                          	<div class="progress">
									  <div class="progress-bar progress-bar-striped progress-bar-danger" role="progressbar" style="width: {{$report['score']}}%" aria-valuenow={{$report['score']}} aria-valuemin="0" aria-valuemax="100">
									  </div>
									</div>
							</div>
                          </td>
                          <td class="text-center"><i class="fa fa-check text-success"></i></span></td>

                          <td class="text-center">{{$report['search_type'] == 0 ? 'Basic Search': 'Deep Search'}}</td>
                          <td class="text-center">{{$report['made_at']}}</td>
                          <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="View Report" title="View Report" onclick="gotoReport({{'"'.route('user.report', ['id' => $report['report_id']]).'"'}})">
                              <i class="material-icons">remove_red_eye</i>
                            <div class="ripple-container"></div></button>
                            <a rel="tooltip" class="btn btn-success btn-round" data-original-title="Download Report" title="Download Report" style="color: white" href = "{{ route('report.download', ['filename' => $report['report_file_url']])}}">
                              <i class="material-icons">save_alt</i>
                            </a>
                            <button type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="Delete Report" title="Delete Report" onclick="deleteReport('{{$report['report_id']}}')">
                              <i class="material-icons">close</i>
                            </button>
                          </td>
                        </tr>
                        @endif
                        <?php
                        $index ++;
                        ?>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>
<script type="text/javascript">
	 function gotoReport(url)
	{
		window.location.href = url;
	}
  function my_alert(type, message)
	{
	  Swal.fire({
	      type: type,
	      title: message,
	      showConfirmButton: true,
	    });
	}
  function upload_file()
	{
		my_alert('warning', 'This is demo version, no checking for plagiarism available in demo');
	}
  function deleteReport(report_id)
  {
    Swal.fire({
    title: 'Are you sure about deleting report?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
                type:'post',
                dataType: "json",
                url: $('#deletereporturl').val(),
                data:{_token: "{{ csrf_token() }}",
                report_id: report_id
                },
                success: function(response){


                   Swal.fire({
                    type: response.status,
                    title: response.data,
                    showConfirmButton: false,
                    timer: 1500
                  });
                   if(response.status == 'success')
                  {
                      $('#report-' + report_id).remove();
                      if($('#report-list tbody tr').length == 0)
                      {
                        $('#report-list tbody').append('<tr><td colspan="7" class="text-center">There is no report</td></tr>');
                      }
                  }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                  Swal.fire({
                  type: 'error',
                  title: 'Network Error',
                  showConfirmButton: false,
                  timer: 1500
                });
                }
              });
      }
  })
  }
</script>
@stop
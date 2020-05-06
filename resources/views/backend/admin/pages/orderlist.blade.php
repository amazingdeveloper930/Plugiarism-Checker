@extends('backend.admin.layouts.default')

@section('content')

<div class="card">
    <div class="card-header card-header-rose card-header-icon">
      <div class="card-icon">
        <i class="material-icons">assignment</i>
      </div>
      <h4 class="card-title">Order List</h4>
    </div>
    <div class="card-body">
            <table id="report-list" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>File Name</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Last Modified</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 1; ?>
                    @foreach ($report_list as $report)
                        <tr id = "{{ 'report-' . $report-> report_id}}">
                            <td>{{ $index++ }}</td>
                            <td>{{ $report -> email}}</td>
                            <td>{{ $report -> file_name }}</td>
                            @if($report -> status == 2)
                            <td>Uploaded</td>
                            <td>No</td>
                            
                            <td>{{ $report -> updated_at }}</td>
                            <td class="text-right">
                                    <a class="btn btn-danger btn-sm" id = "{{ "btn-delete-" . $report -> report_id}}" href="javascript:void(0)" onclick="deleteReport('{{$report -> report_id}}')">Delete</a></td>

                            </td>
                            @elseif($report -> status == 1)
                            <td>Done</td>
                            <td>Yes</td>
                            <td>{{ $report -> updated_at }}</td>
                            <td class="text-right"><a class="btn btn-info btn-sm" href="">View</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('report.download', ['filename' => $report -> report_file_url])}}">Download</a>
                                <a class="btn btn-danger btn-sm" id = "{{ "btn-delete-" . $report -> report_id}}" href="javascript:void(0)" onclick="deleteReport('{{  $report -> report_id}}')">Delete</a></td>
                            @elseif($report -> status == 0)
                            <td>Processing</td>
                            <td>Yes</td>
                            <td>{{ $report -> updated_at }}</td>
                            <td class="text-right"><a class="btn btn-danger btn-sm" id = "{{ "btn-delete-" . $report -> report_id}}" href="javascript:void(0)" onclick="deleteReport('{{$report -> report_id}}')">Delete</a></td></td>
                            @endif
                            
                            

                        </tr>
                    @endforeach
            </tbody>
            </table>
    </div>
</div>
<script>
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
                url: '{{ route("report.delete") }}',
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
                      var row = $('#report-' + report_id);
                      var mytable = $("#report-list").DataTable();
                      mytable.row( $("#btn-delete-" + report_id).parents('tr') ).remove().draw( false );
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
    $(document).ready(function() {
        $('#report-list').DataTable();


    } );
</script>

@stop
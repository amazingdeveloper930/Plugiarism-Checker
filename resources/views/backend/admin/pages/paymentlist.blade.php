@extends('backend.admin.layouts.default')

@section('content')
<div class="card">
        <div class="card-header card-header-rose card-header-icon">
          <div class="card-icon">
            <i class="material-icons">attach_money</i>
          </div>
          <h4 class="card-title">Payment List</h4>
        </div>
        <div class="card-body">
                <table id="payment-table" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Email</th>
                                <th>Payment Method</th>
                                <th>Mode</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            ?>
                            @foreach ($payment_list as $payment)
                            <?php
                            $index ++;
                            ?>
                            <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $payment -> updated_at }}</td>
                            <td>{{ $payment -> user_email }}</td>
                            <td>{{ $payment -> method == "Cardinity Payment API" ? 'Card' : ''}}</td>
                            <td>{{ $payment -> mode == "1" ?  'File Check': 'User Purchase' }}</td>
                            <td>{{ $payment -> amount }}</td>
                            @if($payment -> paid == 0)
                            <td><span class="badge badge-pill badge-warning">Progressing</span></td>
                            @elseif($payment -> paid == 1)
                            <td><span class="badge badge-pill badge-info">Approved</span></td>
                            @elseif($payment -> paid == 2)
                            <td><span class="badge badge-pill badge-rose">Pending</span></td>
                            @elseif($payment -> paid == 3)
                            <td><span class="badge badge-pill badge-danger">Declined</span></td>
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                </table>
        </div>
</div>
<script>
        $(document).ready(function() {
            $('#payment-table').DataTable();
        } );
    </script>
@stop
@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">

@endsection

@section('main-content')

<div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                         <h4 class="card-title mb-3">{{count($all_booked)}} No of Booked Clients </h4>
                         <div style="margin-bottom:10px; ">

                            </div>
                            <div class="col-md-12" style="margin-top:10px; ">

                            </div>
                                <div class="table-responsive">
                                    <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>UPN</th>
                                                <th>Client Name</th>
                                                <th>Appointment Date</th>
                                                <th>Appointment Type</th>

                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_booked) > 0)
                                                @foreach($all_booked as $booked)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>  {{$booked->clinic_number}}</td>
                                                        <td>  {{$booked->client_name}}</td>
                                                        <td>  {{$booked->appntmnt_date}}</td>
                                                        <td>  {{$booked->app_type}}</td>

                                                        <td>
                                                            <button onclick="traceclient({{$booked}});"  data-toggle="modal" data-target="#traceclient" type="button" class="btn btn-primary btn-sm">Assign</button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>

                                </div>

                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div id="traceclient" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">

                        <div class="card-title mb-3">Assign Client</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form role="form" method="post" action="{{route('assign-tracer')}}">
                            {{ csrf_field() }}
                                <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">CCC Number</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id" placeholder="CCC Number" readonly/>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Tracer</label>
                                        <select id ="tracer_id" name="tracer_id" class="form-control" required="">
                                            <option >Select Tracer</option>

                                              @if (count($get_tracers) > 0)
                                                        @foreach($get_tracers as $tracers)
                                                        <option value="{{$tracers->id }}">{{ ucwords($tracers->tracer_name) }}</option>
                                                         @endforeach
                                              @endif

                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <button id="assign" type="submit" class="btn btn-block btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>

                    </div>
                </div>

@endsection

@section('page-js')


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

 <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>

 <script type="text/javascript">

$(function () {

    $("#txt_time").datetimepicker({
    format: 'HH:mm'
});

});

function traceclient(booked){

$('#client_id').val(booked.client_id);

}

$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
});


   // multi column ordering
   $('#multicolumn_ordering_table').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }],
        "paging": true,
        "responsive":true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });</script>


@endsection

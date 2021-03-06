@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection

@section('main-content')

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
            <h4 class="card-title mb-3">A list of Units in the system</h4>
            <div class="col-md-12" style="margin-bottom:20px;">
                <a type="button" href="" data-toggle="modal" data-target="#addunit" class="btn btn-primary btn-md pull-right">Add Unit</a>

            </div>
            <div class="table-responsive">
                <table id="multicolumn_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Unit Name</th>
                            <th>Service</th>
                            <th>Date Added</th>
                            <th>Time Stamp</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @if (count($all_unit) > 0)
                        @foreach($all_unit as $unit)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            <td> {{$unit->unit_name}}</td>
                            <td> {{$unit->partner_name}}</td>
                            <td> {{$unit->created_at}}</td>
                            <td> {{$unit->updated_at}}</td>
                            <td>
                                <button onclick="editunit({{ $unit }});" data-toggle="modal" data-target="#editunit" type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button onclick="deleteunit({{ $unit->id }});" data-toggle="modal" data-target="#deleteunit" type="button" class="btn btn-primary btn-sm">Delete</button>
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
<div id="addunit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <div class="card-title mb-3">Add Unit</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form role="form" method="post" action="{{route('add-units')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Unit Name</label>
                                        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" />
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Service Name</label>
                                        <select id="service" name="service" class="form-control" required="">
                                            <option>Select Service</option>
                                            @if (count($services) > 0)
                                            @foreach($services as $service)
                                            <option value="{{$service->id }}">{{ ucwords($service->name) }}</option>
                                            @endforeach
                                            @endif
                                            <option></option>
                                        </select>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Add Unit</button>
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

<!-- end of col -->
<div id="editunit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <div class="card-title mb-3">Edit Unit</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">

                            <form role="form" method="post" action="{{route('editunits')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Unit Name</label>
                                        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit name">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="picker1">Service Name</label>
                                        <select id="service" name="service" class="form-control" required="">
                                            <option>Select Service</option>
                                            @if (count($services) > 0)
                                            @foreach($services as $service)
                                            <option value="{{$service->id }}">{{ ucwords($service->name) }}</option>
                                            @endforeach
                                            @endif
                                            <option></option>
                                        </select>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Submit</button>
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

<div id="deleteunit" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Unit?</p>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button id="delete" type="button" class="btn btn-danger">Delete</button>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')

<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script type="text/javascript">
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
        "responsive": true,
        "ordering": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    function editunit(unit) {

        $('#unit_name').val(unit.unit_name);
        $('#service_id').val(unit.service);
        $('#id').val(unit.id);
    }

    function deleteunit(id) {
        $('#deleteunit').modal('show');
        console.log(id);
        $(document).off("click", "#delete").on("click", "#delete", function(event) {
            $.ajax({
                type: "POST",
                url: '/delete/unit',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token()}}"
                },
                dataType: "json",
                success: function(data) {
                    toastr.success(data.details);
                    $('#deleteunit').modal('hide');
                }
            })
        });
    }
</script>


@endsection
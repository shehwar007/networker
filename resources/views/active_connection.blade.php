@extends('layout')
@section('title', 'Connection')
@push('mycss')

<!--here is you css-->
<style>
    .btn-icon-circle-sm {
        width: 12px;
        height: 21px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 100%;
        line-height: 1;
    }
</style>


@endpush

@section('page_content')


<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">


            @if (session('alert'))
            <div class="alert icon-custom-alert alert-outline-{{ session('alert') }}" role="alert">
                <i class="mdi mdi-check-all alert-icon"></i>
                <div class="alert-text">
                    {!! session('alert-message') !!}
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="mdi mdi-close text-success font-16"></i></span>
                    </button>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col">
                    <h4 class="page-title">Active Connection</h4>

                </div>
                <div class="col-auto align-self-center">
                    <a href="{{route('connection.create')}}" type="button" class="btn btn-outline-primary btn-sm">
                        New Connection
                    </a>
                   


                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
           

            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th></th>

                            <th id="mytool_name" data-tippy-theme="light rounded">Name</th>

                            <th id="mytool_type" data-tippy-theme="light rounded">Type</th>

                            <th id="mytool_date" data-tippy-theme="light rounded">Month Since <br>Last Contact</th>
                            <th id="mytool_activity" data-tippy-theme="light rounded">Next Activity</th>
                            <th id="mytool_help" data-tippy-theme="light rounded">How to Help <br> the connection</th>
                            <th>Notes</th>

                        </tr>
                    </thead>


                    <tbody>
                        @foreach($connection as $data)
                        <tr>
                            <td class="text-right">
                                <div class="dropdown d-inline-block">
                                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">

                                     <a class="dropdown-item" href="{{route('connection.edit',$data->id)}}">Edit</a>

                                        <!-- <a class="dropdown-item" onclick="ModalShow('edit','{{ $data->id }}');">Edit</a> -->

                                        <form action="{{ route('connection.action') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <button type="submit" class="dropdown-item" name="park" value="park" onclick="return confirm('Are you sure, you want parked?')">Park</button>
                                            <button type="submit" class="dropdown-item" name="duplicate" value="duplicate" onclick="return confirm('Are you sure, you want Duplicate?')">Duplicate</button>
                                            <button type="submit" class="dropdown-item" name="delete" value="Delete" onclick="return confirm('Are you sure, you want Delete?')">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </td>

                            <td>{{$data->connection_name}}</td>

                            <td>{{$data->contype->connection_type ?? "NOT FOUND"}}</td>
                            <td style="text-align: center;">
                                @php


                                $diffInMonths = Carbon\Carbon::create($data->date_of_last_contact)->diffInMonths(Carbon\Carbon::now());


                                @endphp

                                @if($diffInMonths>3)
                                <button type="button" class="btn  btn-icon-circle-sm" style="background-color: red;"></button>
                                {{$diffInMonths}}
                                @else
                                <button type="button" class="btn  btn-icon-circle-sm" style="background-color: #03d87f;"></button>
                                {{$diffInMonths}}
                                @endif
                            </td>
                            <!-- <td>{{$data->date_of_last_contact }}</td> -->
                            <td>{{$data->conactivity->activity ?? "NOT FOUND"}}</td>
                            <td>{{$data->conhelp->connection_help }}</td>
                            <td> {{$data->notes }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!--Start Modal-->

@include('tooltip')
<!--end modal-->
<!--End Modal-->
@endsection
@push('myscript')
<script>
    $(document).ready(function() {
        var table = $('#datatable-buttons').DataTable({
            columnDefs: [{
                    "width": "0px",
                    "targets": 0
                },
                {
                    "width": "0px",
                    "targets": 2
                },
                {
                    "width": "1px",
                    "targets": 3
                },
                {
                    "width": "10px",
                    "targets": 4
                },
                {
                    "width": "11px",
                    "targets": 5
                }
            ],
            lengthChange: false,
            buttons: ['excel', 'print']
        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    });
</script>


<script>
    tippy('.tippy-btn');
    tippy('#mytool_name', {
        html: document.querySelector('#tool_name'), // DIRECT ELEMENT option
        arrow: true,
        animation: 'fade'
    });
    tippy('#mytool_type', {
        html: document.querySelector('#tool_type'), // DIRECT ELEMENT option
        arrow: true,
        animation: 'fade'
    });
    tippy('#mytool_date', {
        html: document.querySelector('#tool_date'), // DIRECT ELEMENT option
        arrow: true,
        animation: 'fade'
    });
    tippy('#mytool_activity', {
        html: document.querySelector('#tool_activity'), // DIRECT ELEMENT option
        arrow: true,
        animation: 'fade'
    });
    tippy('#mytool_help', {
        html: document.querySelector('#tool_help'), // DIRECT ELEMENT option
        arrow: true,
        animation: 'fade'
    });
</script>
@endpush
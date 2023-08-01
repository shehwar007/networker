@extends('layout')
@section('title', 'Connection')
@push('mycss')

<!--here is you css-->
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
                    <h4 class="page-title">Connection</h4>

                </div><!--end col data-toggle="modal" data-target="#connection"-->
                <div class="col-auto align-self-center">



                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Parked Connection</h4>
                <p class="text-muted mb-0">
                </p>
            </div><!--end card-header-->

            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th id="myElement1" data-tippy-theme="light rounded">Type</th>

                            <th>Month Since <br><small>Last Contact<small></th>
                            <th>Next Activity</th>
                            <th>How to Help <br> the connection</th>
                            <!-- <th>Notes</th> -->

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
                                        <a class="dropdown-item" onclick="ModalShow('edit','{{ $data->id }}');">Edit</a>

                                        <form action="{{ route('connection.action') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <button type="submit" class="dropdown-item" name="unpark" value="park" onclick="return confirm('Are you sure, you want parked?')">Un Park</button>

                                        </form>

                                    </div>
                                </div>
                            </td>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->connection_name}}</td>
                            <td>{{$data->is_individual}}</td>
                            <td>{{$data->contype->connection_type ?? "NOT FOUND"}}</td>
                            <td>
                                @php


                                $diffInMonths = Carbon\Carbon::create($data->date_of_last_contact)->diffInMonths(Carbon\Carbon::now());


                                @endphp

                                @if($diffInMonths>6)
                                <button type="button" class="btn" style="background-color: red;"></button>
                                {{$diffInMonths}}
                                @else
                                <button type="button" class="btn" style="background-color: #03d87f;"></button>
                                {{$diffInMonths}}
                                @endif
                            </td>
                            <!-- <td>{{$data->date_of_last_contact}}</td> -->
                            <td>{{$data->conactivity->activity ?? "NOT FOUND"}}</td>
                            <td>{{$data->conhelp->connection_help }}</td>
                            <!-- <td> {{$data->notes }}</td> -->

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!--Start Modal-->

<div class="modal fade bd-example-modal-xl" id="connectionModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form id="connectionForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Connection</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationServer01"><strong>Connection Name</strong></label>
                            <input id="connection_name" name="connection_name" class="form-control" type="text" placeholder="Enter connection name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationServer01"><strong>Type</strong></label>
                            <select class="form-control" id="connection_type_id" name="connection_type_id">
                                <option value="">----Select----</option>
                                @foreach($connection_types as $data)
                                <option value="{{$data->id}}">{{$data->connection_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationServer01"><strong>Date of Last Contact</strong></label>
                            <input type="date" class="form-control" name="date_of_last_contact" id="date_of_last_contact" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>Individual/Organisation</strong></label>
                            <select class="form-control" id="is_individual" name="is_individual">
                                <option value="1">Individual</option>
                                <option value="0">Organisation</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>Next Activity</strong></label>
                            <select class="form-control" id="activity_id" name="activity_id" required>
                                <option value="">----Select----</option>
                                @foreach($activities as $data)
                                <option value="{{$data->id}}">{{$data->activity}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>How to Help the Connection</strong></label>
                            <select class="form-control" id="connection_help_id" name="connection_help_id">
                                <option value="">----Select----</option>
                                @foreach($connection_helps as $data)
                                <option value="{{$data->id}}">{{$data->connection_help}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </div><!--end modal-content-->
        </form>
    </div><!--end modal-dialog-->
</div>
<!-- @include('tooltip') -->
<!--end modal-->
<!--End Modal-->
@endsection
@push('myscript')
<script>
    $("#is_individual").change(function() {
        hideshow(this.value);

    });

    function hideshow(data) {
        if (data == 0) {
            $(".display").hide();
            $('.display').addClass('d-none');
        } else {
            $(".display").show();
            $('.display').removeClass('d-none');
        }
    }

    function ModalShow(action, id) {
        if (action == 'store') {
            $("#put").remove();
            $('#connectionForm')[0].reset();
            $("#connectionForm").attr('action', "{{route('connection.store')}}");
            $('#htmlAppend').html("");
            $("htmlAppendy").hide();
            hideshow(1);

        } else if (action == 'edit') {
            url_edit = GetUrl(id, "{{ route('connection.edit', ':id') }}");
            GetData(url_edit);
            url_update = GetUrl(id, "{{ route('connection.update', ':id') }}");
            $('#connectionForm').append('<input type="hidden" name="_method" value="PUT" id="put">');
            $("#connectionForm").attr('action', url_update);
        }

        $('#connectionModal').modal('toggle');
    }

    function GetData(url) {
        $.get(url, function(d) {
            let result = d.data;
            console.log(result);
            $("#connection_name").val(result.connection_name);
            $("#connection_type_id").val(result.connection_type_id);
            if (result.is_individual == "Individual") {
                $("#is_individual").val(1);
                $("#connection_id").val(result.connection_id);
                $("#team_id").val(result.team_id);
                hideshow(1);
                $('#htmlAppend').html("");
                $("htmlAppendy").hide();


            } else {
                $("#is_individual").val(0);
                hideshow(0);
                $("#htmlAppend").html(d.html);
                $("htmlAppendy").show();


            }
            $("#activity_id").val(result.activity_id);
            $("#connection_help_id").val(result.connection_help_id);
            $("#date_of_last_contact").val(result.date_of_last_contact);
            $("#notes").val(result.notes);
        })
    }


    function GetUrl(id, url) {
        return url.replace(':id', id);
    }
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
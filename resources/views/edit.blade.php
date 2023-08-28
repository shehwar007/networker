@extends('layout')
@section('title', 'Edit Connection')
@push('mycss')


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


        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">View/Edit Connetion</h4>

            </div><!--end card-header-->
            <div class="card-body">
                <form id="connectionForm" method="post" action="{{route('connection.update',$connection->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationServer01" id="mytool_name" data-tippy-theme="light rounded"><strong>Connection Name</strong></label>
                            <input id="connection_name" name="connection_name" value="{{$connection->connection_name}}" class="form-control" type="text" placeholder="Enter connection name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationServer01" id="mytool_type" data-tippy-theme="light rounded"><strong>Type</strong></label>
                            <select class="form-control" id="connection_type_id" name="connection_type_id">
                                <option value="">----Select----</option>
                                @foreach($connection_types as $data)
                                <option {{ $connection->connection_type_id == $data->id ? 'selected':'' }} value="{{$data->id}}">{{$data->connection_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationServer01" id="mytool_date" data-tippy-theme="light rounded"><strong>Date of Last Contact</strong></label>
                            <input type="date" class="form-control" value="{{$connection->date_of_last_contact}}" name="date_of_last_contact" id="date_of_last_contact" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>Individual/Organisation</strong></label>
                            <select class="form-control" id="is_individual" name="is_individual" required>
                                <option>---Select---</option>
                                <option {{ $connection->getRawOriginal('is_individual') == "1" ? 'selected':'' }} value="1">Individual</option>
                                <option {{ $connection->getRawOriginal('is_individual') == "0" ? 'selected':'' }} value="0">Organisation</option>
                                <!-- <option {{ $connection->is_individual == "Individual" ? 'selected':'' }} value="1">Individual</option>
                                <option {{ $connection->is_individual == "Organization" ? 'selected':'' }} value="0">Organisation</option> -->
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01" id="mytool_activity" data-tippy-theme="light rounded"><strong>Next Activity</strong></label>
                            <select class="form-control" id="activity_id" name="activity_id" required>
                                <option value="">----Select----</option>
                                @foreach($activities as $data)
                                <option value="{{$data->id}}" {{ $connection->activity_id == $data->id ? 'selected':'' }}>{{$data->activity}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01" id="mytool_help" data-tippy-theme="light rounded"><strong>How to Help the Connection</strong></label>
                            <select class="form-control" id="connection_help_id" name="connection_help_id">
                                <option value="">----Select----</option>
                                @foreach($connection_helps as $data)
                                <option value="{{$data->id}}" {{ $connection->connection_help_id == $data->id ? 'selected':'' }}>{{$data->connection_help}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{$connection->notes}}</textarea>
                            </div>
                        </div>



                    </div>

                    <br></hr>
                    </hr>

                    <div class="row display  @if($connection->getRawOriginal('is_individual') == '1') d-none @endif">

                        <div class="col-md-6">

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-9">
                                            <h4 class="card-title">Member</h4>
                                        </div>
                                        <div class="col-3 text-right">
                                            <button onclick="ModalShow2('store');" type="button" class="btn btn-outline-primary btn-sm text-right">
                                                New
                                            </button>

                                        </div>
                                    </div>




                                </div><!--end card-header-->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Member</th>
                                                    <th>Team</th>
                                                    <th>Action</th>

                                                    <!-- <th class="text-right">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($member_table as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->member_data->connection_name ?? ""}}</td>
                                                    <td>{{$data->team_data->title ?? ""}}</td>
                                                    <td>

                                                        <a href="{{route('delete_member.destroy',['id'=>$data->id])}}" class="btn btn-sm btn-outline-danger waves-effect waves-light" onclick="return confirm('Are you sure, you want Delete?')">Delete Member</a>

                                                    </td>


                                                </tr>
                                                @endforeach


                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                </div><!--end card-body-->
                            </div>



                        </div>
                        <div class="col-md-6">

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-9">
                                            <h4 class="card-title">Create/Edit Team</h4>
                                        </div>
                                        <div class="col-3 text-right">
                                            <button onclick="ModalShow('store');" type="button" class="btn btn-outline-primary btn-sm text-right">
                                                Team
                                            </button>

                                        </div>
                                    </div>




                                </div>

                            </div>



                        </div>


                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right">

                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->

    </div>
</div>

<!------HER IS THE MODAL---------->

<div class="modal fade bd-example-modal-xl" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <form id="Form" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Team</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationServer01"><strong>Team Name</strong></label>
                            <input id="title" name="title" class="form-control" type="text" placeholder="Enter  Name" required>
                        </div>

                    </div>
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div><!--end modal-footer-->
            </div>
            <div class="modal-content">
                <div class="row">


                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Team Name</th>

                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team as $data)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$data->title}}</td>
                                                <td class="text-right">
                                                    <div class="dropdown d-inline-block">
                                                        <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                            <i class="las la-ellipsis-v font-20 text-muted"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                            <a class="dropdown-item" onclick="ModalShow('edit','{{ $data->id }}');">Edit</a>
                                                            <a class="dropdown-item" href="/team_delete/{{$data->id}}" onclick="return confirm('Are you sure, you want Delete?')">Delete</a>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table><!--end /table-->
                                </div>

                            </div>

                        </div>



                    </div>


                </div>
            </div>
            <!--end modal-content-->
        </form>

    </div><!--end modal-dialog-->
</div>

<!--------HERE IS THE END OF THE MODAL----------->

<!--MODEL 2 START-->
<div class="modal fade bd-example-modal-xl" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="Form2" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Member</h6>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times"></i></span>
                    </button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <input type="hidden" name="member_update_id" value="{{$connection->id}}">
                            <label class="control-label">Member</label>
                            <select class="form-control" id="member_id" name="member_id" required>
                                <option value="">----Select----</option>
                                @foreach($member as $data)
                                <option value="{{$data->id}}">{{$data->connection_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Team</label>
                            <select class="form-control" id="team_id" name="team_id" required>
                                <option value="">----Select----</option>
                                @foreach($team as $data)
                                <option value="{{$data->id}}">{{$data->title}}</option>
                                @endforeach
                            </select>
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
<!---MODEL 2 END--->
@include('tooltip')
@endsection
@push('myscript')
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
<script>
    $("#is_individual").change(function() {
        hideshow(this.value);

    });

    function hideshow(data) {
        if (data == 1) {
            // $(".display").hide();
            $('.display').addClass('d-none');
        } else {
            // $(".display").show();
            $('.display').removeClass('d-none');
        }
    }

    function ModalShow2(action, id) {
        if (action == 'store') {
            $('#Form2')[0].reset();
            $("#Form2").attr('action', "{{route('connection_members')}}");

        }
        // else if (action == 'edit') {
        //     url_edit = GetUrl(id, "{{ route('team.edit', ':id') }}");
        //     GetData(url_edit);
        //     url_update = GetUrl(id, "{{ route('team.update', ':id') }}");
        //     $('#Form').append('<input type="hidden" name="_method" value="PUT">');
        //     $("#Form").attr('action', url_update);
        // }

        $('#Modal2').modal('toggle');
    }

    function ModalShow(action, id) {
        if (action == 'store') {
            $('#Form')[0].reset();
            $("#Form").attr('action', "{{route('team.store')}}");

            $('#Modal').modal('toggle');

        } else if (action == 'edit') {
            url_edit = GetUrl(id, "{{ route('team.edit', ':id') }}");
            GetData(url_edit);
            url_update = GetUrl(id, "{{ route('team.update', ':id') }}");
            $('#Form').append('<input type="hidden" name="_method" value="PUT">');
            $("#Form").attr('action', url_update);
        }

    }

    function GetData(url) {
        $.get(url, function(result) {

            $("#title").val(result.title);

        })
    }


    function GetUrl(id, url) {
        return url.replace(':id', id);
    }
</script>
@endpush
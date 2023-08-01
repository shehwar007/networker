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
                <form id="connectionForm" method="post" action="{{route('connection.store')}}" enctype="multipart/form-data">
                    @csrf
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
                                <option {{ $connection->is_individual == "Individual" ? 'selected':'' }}value="1">Individual</option>
                                <option {{ $connection->is_individual == "Organization" ? 'selected':'' }} value="0">Organisation</option>
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

                    <div class="row">
                        <div class="col-md-6">

                            <div class="repeater-custom-show-hide">
                                <div data-repeater-list="family">
                                    <div data-repeater-item="">
                                        <div class="form-group row  d-flex align-items-end">
                                            <div class="col-sm-5">
                                                <label class="control-label">Member</label>
                                                <select class="form-control" id="connection_id" name="connection_id">
                                                    <option value="">----Select----</option>
                                                    @foreach($member as $data)
                                                    <option value="{{$data->id}}">{{$data->connection_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label">Team</label>
                                                <select class="form-control" id="team_id" name="team_id">
                                                    <option value="">----Select----</option>
                                                    @foreach($team as $data)
                                                    <option value="{{$data->id}}">{{$data->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>




                                            <div class="col-sm-1">
                                                <button data-repeater-delete class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>

                                                <!-- <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                      <i class="fa fa-minus"></i>  -->

                                                </span>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end /div-->


                                </div>
                                <!--end repet-list-->

                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">
                                        <button data-repeater-create="" class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>

                                        <!-- <span data-repeater-create="" class="btn btn-secondary btn-sm">
                                                             <span class="fa fa-plus"></span> Add
                                                                 </span> -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end repeter-->

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
@endpush
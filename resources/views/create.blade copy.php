@extends('layout')
@section('title', 'New Connection')
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
                <h4 class="card-title">New Connetion</h4>

            </div><!--end card-header-->
            <div class="card-body">
                <form id="connectionForm" method="post" action="{{route('connection.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
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
                            <select class="form-control" id="is_individual" name="is_individual" required>
                            <option value="">---Select---</option>
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
                        <div class="col-md-6 mb-3 display d-none">
                            <label for="validationServer01"><strong>Organization</strong></label>
                            <select class="form-control" id="connection_id" name="connection_id">
                                <option value="">----Select----</option>
                                @foreach($organization as $data)
                                <option value="{{$data->id}}">{{$data->connection_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 display  d-none">
                            <label for="validationServer01"><strong>Team</strong></label>
                            <select class="form-control" id="team_id" name="team_id">
                                <option value="">----Select----</option>
                                @foreach($team as $data)
                                <option value="{{$data->id}}">{{$data->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr><br>
                        <div class="col-md-6 mb-3">
                            <ul class="list-group" id="htmlAppend">
                            </ul>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-right">

                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->

    </div>
</div>
<!--Start Modal-->



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

<!--here is you JS-->
<script>
    $("#is_individual").change(function() {
        hideshow(this.value);

    });

    function hideshow(data) {
        if (data == 1) {
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
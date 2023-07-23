@extends('layout')
@section('title', 'User')
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
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="ModalShow('store');">
                        New User
                    </button>


                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User</h4>
                <p class="text-muted mb-0">
                </p>
            </div><!--end card-header-->

            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->role_data->role ?? "Not Set"}}</td>
                            <td>
                                @if($data->status==1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">InActive</span>
                                @endif
                            </td>
                          
                            <!-- <td> {{$data->notes }}</td> -->
                            <td class="text-right">
                                <div class="dropdown d-inline-block">
                                    <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="las la-ellipsis-v font-20 text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                        <a class="dropdown-item" onclick="ModalShow('edit','{{ $data->id }}');">Edit</a>
                                       
                                        <form  action="{{ route('connection.action') }}" method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item" name="delete"  value="Delete" onclick="return confirm('Are you sure, you want Delete?')">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </td>
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
        <form id="connectionForm" method="post" enctype="multipart/form-data" autocomplete="off">
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
                            <label for="validationServer01"><strong>Name</strong></label>
                            <input id="name" name="name" class="form-control" type="text" placeholder="Enter  Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationServer01"><strong>Email</strong></label>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Enter Email" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>Password</strong></label>
                            <input id="password" name="password" class="form-control" type="password" autocomplete="off" placeholder="Enter Password">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>Role</strong></label>
                            <select class="form-control" id="user_role_id" name="user_role_id" required>
                                <option value="">----Select----</option>
                                @foreach($role as $data)
                                <option value="{{$data->id}}">{{$data->role}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"><strong>Status</strong></label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
<!-- @include('tooltip') -->
<!--end modal-->
<!--End Modal-->
@endsection
@push('myscript')
<!--here is you JS-->
<script>
    function ModalShow(action, id) {
        if (action == 'store') {
            $('#connectionForm')[0].reset();
            $("#connectionForm").attr('action', "{{route('user.store')}}");

        } else if (action == 'edit') {
            url_edit = GetUrl(id, "{{ route('user.edit', ':id') }}");
        
            GetData(url_edit);
            url_update = GetUrl(id, "{{ route('user.update', ':id') }}");
            $('#connectionForm').append('<input type="hidden" name="_method" value="PUT">');
            $("#connectionForm").attr('action', url_update);
        }

        $('#connectionModal').modal('toggle');
    }

    function GetData(url) {
        $.get(url, function(result) {
            console.log(result);
            $("#name").val(result.name);
            $("#email").val(result.email);
            $("#user_role_id").val(result.user_role_id);
            $("#status").val(result.status);
        })
    }


    function GetUrl(id, url) {
        return url.replace(':id', id);
    }
</script>

<script>
    // tippy('.tippy-btn');
    // tippy('#myElement', {
    //     html: document.querySelector('#feature__html'), // DIRECT ELEMENT option
    //     arrow: true,
    //     animation: 'fade'
    // });
    // tippy('#myElement1', {
    //     html: document.querySelector('#feature__html1'), // DIRECT ELEMENT option
    //     arrow: true,
    //     animation: 'fade'
    // });
</script>
@endpush
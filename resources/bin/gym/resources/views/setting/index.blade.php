@extends('AdminDashboard.Main.app')
@section('page-title','Setting')
@push('mycss')
<link rel="stylesheet" href="{{asset('assets/extensions/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/summernote.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/summernote/summernote-lite.css')}}">
<!--here is you css-->
@endpush
@section('page_content')
<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Setting</h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">View</button>
                        <button class="nav-link" id="v-pills-member-tab" data-bs-toggle="pill" data-bs-target="#v-pills-member" type="button" role="tab" aria-controls="v-pills-member" aria-selected="true">Members</button>
                        <button class="nav-link" id="v-pills-service-tab" data-bs-toggle="pill" data-bs-target="#v-pills-service" type="button" role="tab" aria-controls="v-pills-service" aria-selected="false">Services</button>
                        <button class="nav-link" id="v-pills-expense-tab" data-bs-toggle="pill" data-bs-target="#v-pills-expense" type="button" role="tab" aria-controls="v-pills-expense" aria-selected="false">Expenses</button>
                        <button class="nav-link" id="v-pills-invoice-tab" data-bs-toggle="pill" data-bs-target="#v-pills-invoice" type="button" role="tab" aria-controls="v-pills-invoice" aria-selected="false">Invoice</button>
                        <button class="nav-link" id="v-pills-logo-tab" data-bs-toggle="pill" data-bs-target="#v-pills-logo" type="button" role="tab" aria-controls="v-pills-logo" aria-selected="false">Logo</button>

                    </div>
                    <form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                        @csrf
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">

                                        <table class="table mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Setting_Name</th>
                                                    <th>Setting_Detail</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @empty($data)
                                                no Data
                                                @else
                                                @foreach ($data as $key => $value)
                                                <tr>
                                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                                    <td>{{$value->title ?? "not set"}}</td>
                                                    <td class="text-bold-500">{{$value->description ?? "not set"}}</td>

                                                </tr>
                                                @endforeach

                                                @endempty

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!-- Member -->
                            <div class="tab-pane fade" id="v-pills-member" role="tabpanel" aria-labelledby="v-pills-member-tab">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column" class="form-label">Category</label>

                                                        <input type="text" id="first-name-vertical" class="form-control" name="member" value="{{$member ?? ''}}" placeholder="Members" size="100">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column" class="form-label">Diseases</label>

                                                        <input type="text" id="first-name-vertical" class="form-control" name="member_diseases" value="{{$member_diseases ?? ''}}" placeholder="Diseases" size="100">
                                                    </div>
                                                </div>
                                                <div class="col-10">

                                                </div>


                                                <div class="col-2">
                                                    <button type="submit" name="btn_member" value="1" class="btn btn-primary me-1 mb-1">Update</button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Service -->
                            <div class="tab-pane fade" id="v-pills-service" role="tabpanel" aria-labelledby="v-pills-service-tab">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-10">
                                                    <div class="form-group">

                                                        <input type="text" id="first-name-vertical" class="form-control" name="service" value="{{$service ?? ''}}" placeholder="Services" size="100">
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <button type="submit" name="btn_service" value="btn_service" class="btn btn-primary me-1 mb-1">Update</button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Expense -->
                            <div class="tab-pane fade" id="v-pills-expense" role="tabpanel" aria-labelledby="v-pills-expense-tab">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-10">
                                                    <div class="form-group">

                                                        <input type="text" id="first-name-vertical" class="form-control" name="expense" value="{{$expense ?? ''}}" placeholder="Expenses" size="100">
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <button type="submit" name="btn_expense" value="btn_expense" class="btn btn-primary me-1 mb-1">Update</button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- invoice -->

                            <div class="tab-pane fade" id="v-pills-invoice" role="tabpanel" aria-labelledby="v-pills-invoice-tab">
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">

                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Header</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <textarea id="summernote" name="header">{{$header}}</textarea>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Footer</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <textarea id="summernote1" name="footer">{{$footer}}</textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <!-- <div class="col-10">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="logo" size="100">{{$invoice ?? ''}}</textarea>

                                                        <small>Address,Phone_Number,Footer by $: 051-5419101 / 0315-7601742$Thank You For Shopping With Us. Please Come Again</small>
                                                    </div>
                                                </div> -->
                                                <div class="col-10">

                                                </div>

                                                <div class="col-2">
                                                    <button type="submit" name="btn_logo" value="btn_logo" class="btn btn-primary me-1 mb-1">Update</button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- LoGo -->
                            <div class="tab-pane fade" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">

                                <div class="row">
                                    <div class="col-2">

                                    </div>
                                    <div class="col-10">

                                        <div class='form-group'>
                                            <div>
                                                <label for="formFile" class="form-label">Logo</label>
                                                <input class="form-control form-control-sm" type="file" id="formFile" accept="image/*" name="logo" onchange="document.getElementById('img1').src = window.URL.createObjectURL(this.files[0])">
                                            </div>

                                        </div>


                                        <div class='form-group'>
                                            <div class="avatar avatar-xl  mt-3">
                                                <a id="AFS" href="{{asset('d_img')}}/{{$logo ?? "1.jpg"}}" target="_blank"><img id="img1" src="{{asset('d_img')}}/{{$logo ?? "1.jpg"}}" width="200" height="200"></a>

                                                <!-- <img id="img1" src="{{ asset('assets/images/faces/1.jpg')}}"> -->
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-2">

                                    </div>
                                    <div class="col-10">

                                        <div class='form-group'>
                                            <div>
                                                <label for="formFile" class="form-label">CoverImage</label>
                                                <input class="form-control form-control-sm" type="file" id="formFile" accept="image/*" name="cover" onchange="document.getElementById('img2').src = window.URL.createObjectURL(this.files[0])">
                                            </div>

                                        </div>


                                        <div class='form-group'>
                                            <div class="avatar avatar-xl  mt-3">
                                                <a id="AFS" href="{{asset('d_img')}}/{{$cover ?? "1.jpg"}}" target="_blank"><img id="img2" src="{{asset('d_img')}}/{{$cover ?? "1.jpg"}}" width="200" height="200"></a>

                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">

                                    </div>
                                    <div class="col-2">
                                        <button type="submit" name="btn_logo_img" value="btn_logo_img" class="btn btn-primary me-1 mb-1">Update</button>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="row">
                <div class="col-10">
                    <div class="card-header">
                        <h4 class="card-title">User</h4>
                    </div>
                </div>
                <div class="col-2">

                    <a href="#" class="btn btn-sm btn-info  icon mt-5" data-bs-toggle="modal" data-bs-target="#large"><i class="bi bi-person"></i> Add User</a>


                </div>
            </div>

            <div class="card-body">
                <table class="table mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @empty($user)
                        no Data
                        @else
                        @foreach ($user as $key => $value)
                        <tr>
                            <td class="text-bold-500">{{$loop->iteration}}</td>
                            <td>{{$value->name ?? "not set"}}</td>
                            <td class="text-bold-500">{{$value->email ?? "not set"}}</td>
                            <td class="text-bold-500">{{$value->phone ?? "not set"}}</td>
                            <td class="text-bold-500">{{$value->role ?? "not set"}}</td>
                            <td class="text-bold-500">
                            <!-- <a href="javascript:void(0)" class="btn btn-secondary">Edit</a> -->
                            <a onclick="return confirm('Are you sure?')" href="{{route('user.delete',$value->id)}}" class="btn btn-danger ">Delete</a>


                            </td>

                        </tr>
                        @endforeach

                        @endempty

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@include('setting.modal')
@endsection
@push('myscript')

<script src="{{ asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>>
<script src="{{ asset('assets/extensions/summernote/summernote-lite.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/summernote.js')}}"></script>
@if(Session::has('success'))
<script>
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "{!! Session::get('success') !!}",
    });
</script>
@endif
@if(Session::has('error'))
<script>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "{!! Session::get('error') !!}",
    });
</script>
@endif

<!--here is you css-->
@endpush
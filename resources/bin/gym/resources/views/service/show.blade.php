@extends('AdminDashboard.Main.app')
@section('page-title','Services')
@push('mycss')
<link rel="stylesheet" href="{{asset('assets/extensions/sweetalert2/sweetalert2.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<!--here is you css-->
@endpush
@section('page_content')
<div class="page-heading">


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Service</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column" class="form-label">Service Title:</label>
                                            <input type="text" id="first-name-column" class="form-control" name="service_title" value="{{$service->service_title}}" data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Category</label>
                                            <select class="form-select form-control" id="category" name="service_category">
                                                <option value="">--Select--</option>
                                                @foreach($category as $data)
                                                <option {{ $service->service_category == $data ? 'selected':'' }}>{{$data}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Type</label>
                                            <select class="form-select form-control" id="category" name="service_type" value="{{ old('member_category') }}">
                                                <option value="">--Select--</option>
                                                <option {{ $service->service_type == 'Daily' ? 'selected':'' }}>Daily</option>
                                                <option {{ $service->service_type == 'Monthly' ? 'selected':'' }}>Monthly</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Price (Rs)</label>
                                            <input type="number" id="last-name-column" class="form-control" min="0" name="service_price" value="{{$service->service_price}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Duration (no of days)</label>
                                            <input type="number" id="last-name-column" class="form-control" min="0" name="service_duration" value="{{$service->service_duration}}">

                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Status</label>
                                            <select class="form-select form-control" id="category" name="status" value="{{ old('member_category') }}">
                                                <option {{ $service->status == 'Active' ? 'selected':'' }}>Active</option>
                                                <option {{ $service->status == 'Inactive' ? 'selected':'' }}>Inactive</option>

                                            </select>
                                        </div>
                                    </div>






                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="service_description">{{$service->service_description}}</textarea>
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12">
                                        <div class='form-group'>


                                            <div class=" mt-3">
                                                <img id="img" src="{{asset('images')}}/{{$service->service_icon ?? "1.jpg"}}" width="200" height="200">

                                            </div>


                                        </div>
                                    </div>



                                </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>
@endsection
@push('myscript')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/parsley.js')}}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{ asset('assets/js/pages/form-element-select.js')}}"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>>


<script>
    $(function() {
        $('input[type="text"], textarea').attr('readonly', 'readonly');
        $('.form-control').attr('readonly', 'readonly');
        $('.form-control').attr('disabled', 'disabled');
    });
</script>
<!--here is you css-->
@endpush
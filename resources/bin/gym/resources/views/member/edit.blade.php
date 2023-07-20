@extends('AdminDashboard.Main.app')
@section('page-title','Member')
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
                        <h4 class="card-title">Update Member</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('members.update',$member->id) }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Membership NO:</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="12324" name="member_no" value="{{$member->member_no}}" data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Full Name</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder="Shehwar Asif" name="member_name" value="{{$member->member_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Gender</label>
                                            <select class="form-select" id="basicSelect" name="member_gender">
                                                <option value="">--Select--</option>
                                                <option {{ $member->member_gender == 'Male' ? 'selected':'' }}>Male</option>
                                                <option {{ $member->member_gender == 'Female' ? 'selected':'' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="member_category">
                                                <option value="">--Select--</option>
                                                <option {{ $member->member_category == 'Daily' ? 'selected':'' }}>Daily</option>
                                                <option {{ $member->member_category == 'Monthly' ? 'selected':'' }}>Monthly</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column" class="form-label">Nic</label>
                                            <input type="text" id="city-column" class="form-control" maxlength="13" placeholder="37402-1453452-1" name="member_nic" value="{{$member->member_nic}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Mobile #</label>
                                            <input type="text" id="last-name-column" class="form-control" maxlength="13" placeholder="03131234567" name="member_mobile" value="{{$member->member_mobile}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Mobile Network</label>
                                            <select class="form-select" id="basicSelect" name="member_network">

                                                <option value="">--Select--</option>
                                                <option {{ $member->member_network == 'Telenor' ? 'selected':'' }} value="Telenor">Telenor</option>
                                                <option {{ $member->member_network == 'Ufone' ? 'selected':'' }} value="Ufone">Ufone</option>
                                                <option {{ $member->member_network == 'Zong' ? 'selected':'' }} value="Zong">Zong</option>
                                                <option {{ $member->member_network == 'Jazz' ? 'selected':'' }} value="Jazz">Jazz</option>
                                                <option {{ $member->member_network == 'Warid' ? 'selected':'' }} value="Warid">Warid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="country-floating" class="form-label">Email</label>
                                            <input type="text" id="country-floating" class="form-control" name="member_email" value="{{$member->member_email}}" data-parsley-type="email">
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12 d-none show">
                                        <div class="form-group">
                                            <label for="country-floating" class="form-label">Father/Husband Name</label>
                                            <input type="text" class="form-control" name="member_fathername" value="{{$member->member_fathername}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 d-none show">
                                        <div class="form-group">
                                            <label for="email-id-column" class="form-label">Emergency Contact #</label>
                                            <input type="text" class="form-control" name="member_emergencyno" placeholder="03138493545" maxlength="13" value="{{$member->member_emergencyno}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 d-none show">
                                        <!-- min="2018-01-01" max="2018-12-31" -->
                                        <div class="form-group">
                                            <label for="company-column" class="form-label">Date of Birth</label>
                                            <input type="date" id="company-column" class="form-control" name="member_dob" placeholder="11/11/2001" value="{{$member->member_dob}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 d-none show">
                                        <div class="form-group">
                                            <label for="company-column" class="form-label">Registration Date</label>
                                            <input type="date" id="company-column" class="form-control" name="member_registrationdate" placeholder="11/11/2001" value="{{$member->member_registrationdate}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 d-none show">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Resident of</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="member_residence">{{$member->member_residence}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 d-none show">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="member_address">{{$member->member_address}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12 d-none show">
                                        <div class='form-group'>
                                            <div>
                                                <label for="formFile" class="form-label">Image</label>
                                                <input class="form-control form-control-sm" type="file" id="formFile" accept="image/*" name="member_image" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12 d-none show">
                                        <div class='form-group'>
                                            <div class="avatar avatar-xl  mt-3">
                                                <img id="img" src="{{asset('images')}}/{{$member->member_image ?? "1.jpg"}}">
                                            </div>


                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6 col-12 d-none show">
                                        <h6>Diseases</h6>
                                        <div class="form-group">
                                            <select class="choices form-select multiple-remove" multiple="multiple" name="member_diseases[]">
                                                @foreach ($diseases as $value)
                                                <option {{ in_array($value,explode(',', $member->member_diseases))  ? 'selected':'' }}>{{$value}}</option>
                                                @endforeach
                                 

                                            </select>
                                        </div>
                                        <span>The Gym Managament will not be responsible for any unfotunate incident during or after your workout session.</span>


                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    </div>
                                </div>
                            </form>
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

<script>
    $(function() {
        showhide($('#category').val());
    });

    $('#category').change(function() {
        showhide($(this).val());
    });

    function showhide(value) {
        if (value == "Monthly") {
            $(".d-none").show();
            $('.d-none').removeClass('d-none');
        } else {
            $(".show").hide();
            $('.show').addClass('d-none');
        }
    };
</script>
<!--here is you css-->
@endpush
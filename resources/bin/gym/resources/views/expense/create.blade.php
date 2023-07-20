@extends('AdminDashboard.Main.app')
@section('page-title','Expenses')
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
                        <h4 class="card-title">New Expense</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('expenses.store') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column" class="form-label">Title:</label>
                                            <input type="text" id="first-name-column" class="form-control" name="expense_title" value="{{ old('member_no') }}" data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="expense_category" value="{{ old('member_category') }}">
                                                <option value="">--Select--</option>
                                                @foreach($category as $data)
                                                <option>{{$data}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Amount (Rs)</label>
                                            <input type="number" id="last-name-column" class="form-control" min="0" value="{{ old('member_name') }}" name="expense_amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Date</label>
                                            <input type="date" id="last-name-column" class="form-control" min="0" value="{{ old('member_name') }}" name="expense_date">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Payment Type</label>
                                            <select class="form-select" id="category" name="expense_payment_type" value="{{ old('member_category') }}" required>
                                                <option value="">--Select--</option>
                                                <option>Cash</option>
                                                <option>Credit Card</option>

                                            </select>
                                        </div>
                                    </div>
         
     
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Status</label>
                                            <select class="form-select" id="category" name="status" value="{{ old('member_category') }}">
                                                <option>Paid</option>
                                                <option>Unpaid</option>

                                            </select>
                                        </div>
                                    </div>

                                    
                                  
                                    


                                    <div class="col-md-4 col-12 ">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="expense_description"></textarea>
                                        </div>
                                    </div>
                                

                                    <div class="col-md-3 col-12 ">
                                        <div class='form-group'>
                                            <div>
                                                <label for="formFile" class="form-label">Attachment</label>
                                                <input class="form-control form-control-sm" type="file" id="formFile" accept="image/*" name="expense_attachment" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class='form-group'>
                                            <div class="avatar avatar-xl  mt-3">
                                                <img id="img" src="{{ asset('assets/images/faces/1.jpg')}}">
                                            </div>


                                        </div>
                                    </div>

                                   

                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end newnew hellooo -->
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
    @if(Session::has('success'))
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "{!! Session::get('success') !!}",
    });
    @endif
    @if(Session::has('error'))
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "{!! Session::get('error') !!}",
    });
    @endif

</script>
<!--here is you css-->
@endpush
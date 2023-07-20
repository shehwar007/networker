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
                        <h4 class="card-title">Update Expense</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('expenses.update',$expense->id) }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column" class="form-label">Title:</label>
                                            <input type="text" id="first-name-column" class="form-control" name="expense_title" value="{{ $expense->expense_title }}" data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="expense_category" value="{{ old('member_category') }}">
                                                <option value="">--Select--</option>
                                                @foreach($category as $data)
                                                <option {{ $expense->expense_category == $data ? 'selected':'' }}>{{$data}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Amount (Rs)</label>
                                            <input type="number" id="last-name-column" class="form-control" min="0" value="{{ $expense->expense_amount }}"  name="expense_amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Payment Type</label>
                                            <select class="form-select"  name="expense_payment_type" required>
                                                <option value="">--Select--</option>
                                                <option {{ $expense->expense_payment_type == 'Cash' ? 'selected':'' }}>Cash</option>
                                                <option {{ $expense->expense_payment_type == 'Credit Card' ? 'selected':'' }}>Card</option>

                                            </select>
                                        </div>
                                    </div>
         
     
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Status</label>
                                            <select class="form-select" id="category" name="status" value="{{ old('member_category') }}">
                                                <option {{ $expense->status == 'Paid' ? 'selected':'' }}>Paid</option>
                                                <option {{ $expense->status == 'Unpaid' ? 'selected':'' }}>Unpaid</option>

                                            </select>
                                        </div>
                                    </div>

                                    
                                  
                                    


                                    <div class="col-md-4 col-12 ">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="expense_description">{{$expense->expense_description}}</textarea>
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
                                            <img id="img" src="{{asset('images')}}/{{$expense->expense_attachment ?? "1.jpg"}}">
                                               
                                            </div>


                                        </div>
                                    </div>

                                   

                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
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
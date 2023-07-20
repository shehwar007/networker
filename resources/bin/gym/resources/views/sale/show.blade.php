@extends('AdminDashboard.Main.app')
@section('page-title', 'Sales')
@push('mycss')
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--here is you css-->
@endpush
@section('page_content')
    <div class="page-heading">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-11">
                                <div class="card-header">
                                    <h4>Sale Info</h4>
                                </div>
                            </div>
                            <div class="col-1 mt-1">
                                <div class="col-md-1">
                                    <a href="javascript:EditOrder({{ $sale->id }})" class="btn btn-sm btn-info  icon"><i
                                            class="bi bi-pencil-fill"></i></a>

                                </div>
                            </div>
                        </div>

                        <div class="card-content pb-4">

                            <div class="row">
                                <div class="col-2">
                                    <div class="name ms-5">
                                        <h5 class="mb-1">Rs: {{ $sale->subtotal }}</h5>
                                        <h6 class="text-muted mt-1">Sub Total</h6>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="name ms-5">
                                        <h5 class="mb-1">Rs: {{ $sale->discount ?? 0 }}</h5>
                                        <h6 class="text-muted mt-1">Discount</h6>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="name ms-5">
                                        <h5 class="mb-1">Rs: {{ $sale->grand_total }}</h5>
                                        <h6 class="text-muted mt-1">Grand Total</h6>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="name ms-5">
                                        <h5 class="mb-1">{{ $sale->payment_method }}</h5>
                                        <h6 class="text-muted mb-0">Payment Type</h6>
                                    </div>

                                </div>
                                <div class="col-2">
                                    <div class="name ms-5">
                                        @if ($sale->payment_status == 'Partial Pay')
                                            <a href="javascript:PaymentModal({{ $sale->id }})">
                                                <h5 class="mb-1 badge bg-light-warning">{{ $sale->payment_status }}</h5>
                                            </a>
                                        @else
                                            <h5 class="mb-1">{{ $sale->payment_status }}</h5>
                                        @endif
                                        <h6 class="text-muted mb-0">Status</h6>
                                    </div>

                                </div>
                                @if ($sale->payment_status == 'Partial Pay')
                                    <div class="col-2">
                                        <div class="name ms-5">
                                            <h5 class="mb-1">Rs:{{ $sale->balance }}</h5>
                                            <h6 class="text-muted mb-0">Balance</h6>
                                        </div>

                                    </div>
                                @endif
                                <div class="col-2">
                                    <div class="name ms-5">
                                        <h5 class="mb-1"> {{ Carbon::parse($sale->created_at)->format('d-m-Y') }}</h5>
                                        <h6 class="text-muted mb-0">Date</h6>
                                    </div>

                                </div>
                                <div class="col-2 mt-5">
                                    <div class="name ms-5">
                                        <h5 class="mb-1">{{ Carbon::parse($sale->created_at)->format('g:i a') }}</h5>
                                        <h6 class="text-muted mb-0">Time</h6>
                                    </div>

                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="table-head">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sale Item Info</h4>
                        </div>
                        <div class="card-content">


                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saleitem as $data)
                                            <tr>
                                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                                <td>{{ $data->service->service_title }}
                                                    {{ $freeze = $data->freezeinfo[0]->freeze_status ?? null }}



                                                    @if ($data->expired_date)
                                                        @if ($data->expired_date < date('Y-m-d'))
                                                            <br>Expire Date: <a
                                                                href="javascript:EditExpireDate({{ $data->id }})"><span
                                                                    class="badge bg-light-danger">{{ Carbon::parse($data->expired_date)->format('d-m-Y') }}
                                                                    Expired</span></a>
                                                        @else
                                                            <br>Expire Date: <a
                                                                href="javascript:EditExpireDate({{ $data->id }})"><span
                                                                    class="badge bg-light-success">{{ Carbon::parse($data->expired_date)->format('d-m-Y') }}</span></a>
                                                        @endif
                                                        @if ($freeze == 'Freeze')
                                                            <br> Freeze Status: <span
                                                                class="badge bg-light-danger">Freezed</span>
                                                        @endif
                                                        <input type="hidden" id="date-{{ $data->id }}"
                                                            value="{{ Carbon::parse($data->expired_date)->format('Y-m-d') }}">
                                                    @endif
                                                </td>
                                                <td class="text-bold-500">{{ $data->qty }}</td>
                                                <td>{{ $data->price }}</td>
                                                <td>{{ $data->subtotal }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Member Info</h4>
                        </div>
                        <div class="card-content">
                            @if ($sale->member_id == 0)
                                <div class="recent-message d-flex  px-4 py-3">

                                    <div class="name ms-4">
                                        <h5 class="mb-1">Walk-in-Customer</h5>

                                    </div>
                                </div>
                            @else
                                <div class="recent-message d-flex  px-4 py-3">

                                    <div class="name ms-4">
                                        <h6 class="text-muted">Member#</h6>
                                        <h5 class="mt-1">{{ $sale->member->member_no ?? '' }}</h5>

                                    </div>

                                </div>
                                <div class="recent-message d-flex  px-4 py-3">

                                    <div class="name ms-4">
                                        <h6 class="text-muted">Name</h6>
                                        <h5 class="mt-1">{{ $sale->member->member_name }}</h5>

                                    </div>

                                </div>

                                <div class="recent-message d-flex  px-4 py-3">

                                    <div class="name ms-4">
                                        <h6 class="text-muted">Mobile#</h6>
                                        <h5 class="mt-1">{{ $sale->member->member_mobile }}</h5>

                                    </div>

                                </div>
                            @endif


                        </div>
                    </div>
                    @if ($sale->payment_status == 'Partial Pay')

                        <div class="card">
                            <div class="card-header">
                                <h4>Partail Payment Info</h4>
                            </div>
                            <div class="card-conten">
                            @empty($sale->paymentinfo)
                                no payment
                            @else
                                @foreach ($sale->paymentinfo as $data)
                                    <div class="recent-message d-flex py-3">

                                        <div class="name ms-4">
                                            <h6 class="mb-1">Rs.{{ $data->amount }}</h6>
                                            <h6 class="text-muted mb-0">Payment Type:{{ $data->payment_type }}</h6>
                                            <h6 class="text-muted mb-0">
                                                {{ Carbon::parse($data->created_at)->format('d-m-Y g:i a') }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            @endempty

                        </div>
                    </div>


                @endif

            </div>
        </div>
    </section>
</div>
@include('sale.modal')
@endsection
@push('myscript')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/parsley.js') }}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{!! Session::get('success') !!}",
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "{!! Session::get('error') !!}",
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $(".select2").select2({
            dropdownParent: $('#EditOrder')
        });
    });

    //////////model setting//////
    $('#carddropdown').change(function() {
        var value = $(this).val();
        if (value == "Credit Card") {
            $(".displaycardcls").show();
            $('#displaycard').removeClass('d-none');
        } else {
            $(".displaycardcls").hide();
            $('#displaycard').addClass('d-none');
        }
    });

    function PaymentModal(id) {
        $("#order_id").val(id);
        $('#modalPayment').modal('toggle');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#Paymentform").submit(function(e) {
        e.preventDefault();
        let orderid = $("input[type=hidden][name=order_id]").val();
        let amount = $("input[type=number][name=amount]").val();
        let cardno = $("input[type=text][name=cardno]").val();
        var payment_type = $('#carddropdown').val();
        $.ajax({
            url: "{{ route('sale.add_payment') }}",
            type: "POST",
            data: {
                orderid: orderid,
                amount: amount,
                payment_type: payment_type,
                cardno: cardno,
            },
            success: function(response) {
                if (response) {

                    $('#modalPayment').modal('hide');
                    $("#Paymentform")[0].reset();
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Payement Added",
                    });
                    location.reload();

                }


            }
        });

    });


    function EditOrder(id) {
        var url = "{{ route('sales.edit', ':id') }}";
        var urlupdate = "{{ route('sales.update', ':id') }}";
        url = url.replace(':id', id);
        urlupdate = urlupdate.replace(':id', id);
        // UpdateOrder

        $.get(url, function(result) {
            let data = JSON.parse(result);
            $("#subtotal_e").val(data.subtotal);
            $("#discount_e").val(data.discount);
            $("#grand_total_e").val(data.grand_total);
            $("#payment_method_e").val(data.payment_method);
            $("#branch_user_e").val(data.branch_user);
            $("#date_e").val(data.date);
            $("#member_id_e").val(data.member_id);
            $('#member_id_e').trigger('change');

            $("#UpdateOrder").attr('action', urlupdate);
            $('#EditOrder').modal('toggle');
        })

    }

    function EditExpireDate(id) {

        let date = $('#date-' + id).val();
        $("#expired_date").val(date);
        $("#expiry_id").val(id);
        $('#EditExpireModal').modal('toggle');


    }


    function clearcharge() {

        var g = $('#subtotal_e').val();
        var discount = Number(document.getElementById('discount_e').value);
        var grandtotal = Number(g);
        if (discount == " ") {
            discount = 0;
        }
        var result = grandtotal - discount;
        document.getElementById('grand_total_e').value = result.toFixed(0);

    }

    function check() {
        var checkBox = document.getElementById("freeze_check");
        var text = document.getElementById("FreezeBlock");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>
@endpush

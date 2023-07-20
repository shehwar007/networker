@extends('AdminDashboard.Main.app')
@section('page-title', 'Member')
@push('mycss')
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/@icon/dripicons/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dripicons.css') }}">

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
                            <h4 class="card-title">View Member</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Membership NO:</label>
                                            <input type="text" id="first-name-column" class="form-control formread"
                                                placeholder="12324" name="member_no" value="{{ $member->member_no }}"
                                                data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Full Name</label>
                                            <input type="text" id="last-name-column" class="form-control formread"
                                                placeholder="Shehwar Asif" name="member_name"
                                                value="{{ $member->member_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Gender</label>
                                            <select class="form-select form-control formread" id="basicSelect"
                                                name="member_gender">
                                                <option value="">--Select--</option>
                                                <option {{ $member->member_gender == 'Male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option {{ $member->member_gender == 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Category</label>
                                            <select class="form-select form-control formread" id="category"
                                                name="member_category">
                                                <option value="">--Select--</option>
                                                <option {{ $member->member_category == 'Daily' ? 'selected' : '' }}>Daily
                                                </option>
                                                <option {{ $member->member_category == 'Monthly' ? 'selected' : '' }}>
                                                    Monthly
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column" class="form-label">Nic</label>
                                            <input type="text" id="city-column" class="form-control formread"
                                                maxlength="13" placeholder="37402-1453452-1" name="member_nic"
                                                value="{{ $member->member_nic }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Mobile #</label>
                                            <input type="text" id="last-name-column" class="form-control formread"
                                                maxlength="13" placeholder="03131234567" name="member_mobile"
                                                value="{{ $member->member_mobile }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Mobile Network</label>
                                            <select class="form-select form-control formread" id="basicSelect"
                                                name="member_network">

                                                <option value="">--Select--</option>
                                                <option {{ $member->member_network == 'Telenor' ? 'selected' : '' }}
                                                    value="Telenor">Telenor</option>
                                                <option {{ $member->member_network == 'Ufone' ? 'selected' : '' }}
                                                    value="Ufone">Ufone</option>
                                                <option {{ $member->member_network == 'Zong' ? 'selected' : '' }}
                                                    value="Zong">Zong</option>
                                                <option {{ $member->member_network == 'Jazz' ? 'selected' : '' }}
                                                    value="Jazz">Jazz</option>
                                                <option {{ $member->member_network == 'Warid' ? 'selected' : '' }}
                                                    value="Warid">Warid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="country-floating" class="form-label">Email</label>
                                            <input type="text" id="country-floating" class="form-control formread"
                                                name="member_email" value="{{ $member->member_email }}"
                                                data-parsley-type="email">
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12 d-none show">
                                        <div class="form-group">
                                            <label for="country-floating" class="form-label">Father/Husband Name</label>
                                            <input type="text" class="form-control formread" name="member_fathername"
                                                value="{{ $member->member_fathername }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 d-none show">
                                        <div class="form-group">
                                            <label for="email-id-column" class="form-label">Emergency Contact #</label>
                                            <input type="text" class="form-control formread" name="member_emergencyno"
                                                placeholder="03138493545" maxlength="13"
                                                value="{{ $member->member_emergencyno }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 d-none show">
                                        <!-- min="2018-01-01" max="2018-12-31" -->
                                        <div class="form-group">
                                            <label for="company-column" class="form-label">Date of Birth</label>
                                            <input type="date" id="company-column" class="form-control formread"
                                                name="member_dob" placeholder="11/11/2001"
                                                value="{{ $member->member_dob }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 d-none show">
                                        <div class="form-group">
                                            <label for="company-column" class="form-label">Registration Date</label>
                                            <input type="date" id="company-column" class="form-control formread"
                                                name="member_registrationdate" placeholder="11/11/2001"
                                                value="{{ $member->member_registrationdate }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 d-none show">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Resident
                                                of</label>
                                            <textarea class="form-control formread" id="exampleFormControlTextarea1" rows="2" name="member_residence">{{ $member->member_residence }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 d-none show">
                                        <div class="form-group mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                            <textarea class="form-control formread" id="exampleFormControlTextarea1" rows="2" name="member_address">{{ $member->member_address }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12 d-none show">
                                        <div class='form-group'>
                                            <div class="  mt-3">
                                                <img id="img"
                                                    src="{{ asset('images') }}/{{ $member->member_image ?? '1.jpg' }}"
                                                    width="200" height="200">
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 d-none show">
                                        <h6>Diseases</h6>
                                        <div class="form-group">
                                            <select class="choices form-select multiple-remove form-control formread"
                                                multiple="multiple" name="member_diseases[]">
                                                @foreach ($diseases as $value)
                                                    <option
                                                        {{ in_array($value, explode(',', $member->member_diseases)) ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                        <span>The Gym Management will not be responsible for any unfortunate incident during
                                            or after your workout session.</span>


                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="card">
                <div class="row">
                    <div class="col-10">
                        <div class="card-header">
                            <h4 class="card-title">Member Order Info</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Date/Time</th>
                                <th>Grand Total</th>
                                <th>Payment Status</th>
                                <th>Expiry</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @empty($member->order_info)
                                no Data
                            @else
                                @foreach ($member->order_info as $data)
                                    <tr>
                                        <td class="text-bold-500">{{ $loop->iteration }}</td>
                                        <td class="text-bold-500">
                                            {{ Carbon::parse($data->created_at)->format('d-m-Y g:i a') }}</td>
                                        <td class="text-bold-500">{{ $data->grand_total }}</td>
                                        <td class="text-bold-500">
                                            @if ($data->payment_status == 'Partial Pay')
                                                <a href="javascript:PaymentModal({{ $data->id }})"> <span
                                                        class="badge bg-light-warning">{{ $data->payment_status }}</span><br>
                                                    Balance (Rs)={{ $data->balance }}
                                                </a>
                                            @elseif($data->payment_status == 'Paid')
                                                <span class="badge bg-light-success">{{ $data->payment_status }}</span>
                                            @else
                                                <span class="badge badge-danger">no status</span>
                                            @endif
                                        </td>
                                        <td class="text-bold-500">
                                            @if (\Carbon\Carbon::parse($data->saleInfo[0]->expired_date)->isPast())
                                                <span
                                                    class="badge bg-light-danger">{{ Carbon::parse($data->saleInfo[0]->expired_date)->format('d-m-Y') }}
                                                    Expired
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-light-success">{{ Carbon::parse($data->saleInfo[0]->expired_date)->format('d-m-Y') }}
                                                    Valid
                                                </span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('sales.show', $data->id) }}" target="_blank"
                                                class="btn btn-info ">View</a>
                                            <a href="{{ route('print.invoice', $data->id) }}" target="_blank"
                                                class="btn btn-secondary"><span
                                                    class="fa-fw select-all fas">Invoice</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="card">
                <div class="row">
                    <div class="col-10">
                        <div class="card-header">
                            <h4 class="card-title">Member Order Info Old</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table mb-0 table_dT">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Packages</th>
                                <th>Total Amount (Rs)</th>
                                <th>Cashier</th>
                                <th>Fee Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @empty($reports)
                                no Data
                            @else
                                @foreach ($reports as $data)
                                    <tr>
                                        <td class="text-bold-500">{{ $loop->iteration }}</td>
                                        <td class="text-bold-500">{{ $data->packages }}</td>
                                        <td class="text-bold-500">{{ $data->total_amount }}</td>
                                        <td class="text-bold-500">{{ $data->cashier }}</td>
                                        <td class="text-bold-500">{{ $data->fee_date }}</td>
                                    </tr>
                                @endforeach
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
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
            load_data();

        });



        function load_data() {
            $('.table_dT').DataTable({
                retrieve: true,
                dom: 'lBfrtip',
                responsive: true,
                autoWidth: false,
                scrollY: false,
                buttons: [
                    'excel', 'pdf', 'print'
                ],

                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],


            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass(
                'btn btn-info text-white mt-2');
        }
    </script>

    <script>
        $(function() {
            showhide($('#category').val());
            $('input[type="text"], textarea').attr('readonly', 'readonly');
            $('.formread').attr('readonly', 'readonly');
            $('.formread').attr('disabled', 'disabled');
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
    </script>
    <!--here is you css-->
@endpush

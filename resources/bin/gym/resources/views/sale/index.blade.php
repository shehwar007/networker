@extends('AdminDashboard.Main.app')
@section('page-title', 'Sales')
@push('mycss')
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/@icon/dripicons/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #resp-table {
            width: 100%;
            display: table;
        }

        #resp-table-body {
            display: table-row-group;
        }

        .resp-table-row {
            display: table-row;
        }

        .table-body-cell {
            display: table-cell;
            border: 2px solid #dddddd;
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
        }

        @media print {
            table.table tfoot {
                display: table-row-group;
            }
        }
    </style>
@endpush
@section('page_content')
    <div class="page-heading">

        <input id="page" type="hidden" value="{{ $page }}">



        <!-- Basic Tables start -->
        <section class="section">
            <!-- <div class="alert alert-danger print-error-msg alert-dismissible" style="display:none">
                                                                    <ul>

                                                                    </ul>
                                                                </div> -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $page ? Str::headline($page) . ' List' : 'All Order List' }}


                        </div>
                        <div class="row m-b-5">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="last-name-column" class="form-label">From Date</label>
                                    <input type="date" id="from_date" class="form-control" placeholder="Form Date">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="last-name-column" class="form-label">To Date</label>
                                    <input type="date" id="to_date" class="form-control" placeholder="Form Date">
                                </div>
                            </div>


                            <div class="col-md-2">


                                <button type="button" id="filter"
                                    class="btn waves-effect waves-light btn-secondary mt-3">Filter</button>
                                <button type="button" id="refresh"
                                    class="btn waves-effect waves-light btn-outline-warning mt-3">Refresh</button>

                            </div>
                        </div>


                        <div class="card-body">
                            <table class="table  table-hover">
                                <thead>
                                    <tr>
                                        <th>Bill#</th>
                                        <th>Customer Name:</th>
                                        <th>Package Info:</th>
                                        <th>Date</th>
                                        <th>Payment Type</th>
                                        <th>Balance</th>
                                        <th>Total</th>
                                        <th>Cashier</th>
                                        <th>Status</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th colspan="2"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>


                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->

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
            $(".select2").select2({
                dropdownParent: $('#EditOrder')
            });
        });
        jQuery.fn.dataTable.Api.register('sum()', function() {
            return this.flatten().reduce(function(a, b) {
                if (typeof a === 'string') {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if (typeof b === 'string') {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0);
        });
        jQuery.fn.dataTable.Api.register('average()', function() {
            var data = this.flatten();
            var sum = data.reduce(function(a, b) {
                return (a * 1) + (b * 1); // cast values in-case they are strings
            }, 0);

            return sum / data.length;
        });
    </script>

    <script>
        $(document).ready(function() {
            let page = $('#page').val();

            load_data(page);

        });


        var showAdminColumns = $('#page').val() == 'partial_orders' ? true : false;

        function load_data(page = '', from_date = '', to_date = '') {
            $('.table').DataTable({
                retrieve: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sales.view') }}",
                    data: function(d) {
                        d.page = page;
                        d.from_date = from_date;
                        d.to_date = to_date;
                    },
                },
                dom: 'lBfrtip',
                responsive: true,
                autoWidth: false,
                scrollY: false,
                buttons: [{
                        extend: 'excel',
                        title: 'Safari GYM REPORT',
                        exportOptions: {
                            // columns: [0,1,2,3,5,6]
                            columns: [0, 1, 2, 3, 4, 6, 7, 8]
                        },

                    },
                    {
                        extend: 'print',
                        title: 'Safari GYM REPORT',
                        footer: true,
                        // autoPrint: true,
                        exportOptions: {
                            stripHtml: false,
                            // columns: [0, 1, 2, 3, 5, 6]
                            columns: [0, 1, 2, 3, 4, 6, 7, 8]
                        },
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }

                    },
                ],

                "lengthMenu": [
                    [100, 10, 25, 50, 100, 200, -1],
                    [100, 10, 25, 50, 100, 200, "All"]
                ],
                drawCallback: function() {
                    var api = this.api();
                    var cash = this.api().ajax.json().cash_callback;
                    var card = this.api().ajax.json().card_callback;
                    var cheque = this.api().ajax.json().cheque_callback;
                    var online = this.api().ajax.json().online_callback;
                    var grandtotal = cash + card + cheque + online;
                    // var sum = api.column(3).data().sum();
                    var ht = `<div style="border-style: double;width:250px">&nbsp;&nbsp;Cash :<b> ` + cash +
                        ` </b> <br>&nbsp;&nbsp;Credit Card :<b> ` + card + `</b><br>&nbsp;&nbsp;Cheque:<b> ` +
                        cheque + `</b><br>&nbsp;&nbsp;Online transfer:<b> ` + online +
                        `</b><br>&nbsp;&nbsp;Grand Total:<b> ` + grandtotal + `</b></div>`;
                    var os = `
                <div id="resp-table">
                    <div id="resp-table-body">
                        <div class="resp-table-row"> 
                            <div class="table-body-cell">
                                CASH 
                            </div>
                            <div class="table-body-cell">
                                600
                            </div>
                          
                        </div>
                        <div class="resp-table-row"> 
                            <div class="table-body-cell">
                                CARD 
                            </div>
                            <div class="table-body-cell">
                                2600
                            </div>
                          
                        </div>
                        
                    </div>
                </div>`;
                    // $(api.column(3).footer()).html('Total Amount: ' + sum);
                    // $(api.column(3).footer()).html(this.api().ajax.json().comment);
                    // $(api.column(6).footer()).html(this.api().ajax.json().posts);
                    $(api.column(1).footer()).html(ht);

                },
                columns: [{
                        data: 'bill_no',
                        name: 'bill_no'
                    },

                    {
                        data: 'member_id',
                        name: 'member_id'
                    },
                    {
                        data: 'sale_info',
                        name: 'sale_info'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {

                            return `<a href="javascript:EditOrder(` + row.id + `)">` + row.created_at +
                                `</a>`;


                        },
                    },

                    {
                        data: 'payment_method',
                        name: 'payment_method',
                        render: function(data, type, row) {
                            // EditOrderModal
                            return `<a href="javascript:EditOrderModal(` + row.id +
                                `)"> <span class="badge bg-light-primary">` + row.payment_method +
                                `</span></a>`;


                        },

                    },
                    {
                        data: 'balance',
                        name: 'balance',
                        visible: showAdminColumns,
                    },
                    {
                        data: 'grand_total',
                        name: 'grand_total',

                    },
                    {
                        data: 'branch_user',
                        name: 'branch_user',

                    },

                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        render: function(data, type, row) {
                            if (row.payment_status == "Partial Pay") {
                                return `<a href="javascript:PaymentModal(` + row.id +
                                    `)"> <span class="badge bg-light-warning">` + row.payment_status +
                                    `</span></a>`;

                            } else if (row.payment_status == "Paid") {
                                return ` <span class="badge bg-light-success">` + row.payment_status +
                                    `</span>`;
                            } else {
                                return `<td><span class="badge badge-danger">no status</span></td>`;
                            }
                        },
                    },


                    {
                        data: 'action',
                        name: 'action'
                    }


                ]

            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass(
                'btn btn-info text-white mt-2');
        }

        ////show hide
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
        }

        function EditOrderModal(id) {
            $("#order_id_update").val(id);
            $('#EditOrderModal').modal('toggle');
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
                        $('.table').DataTable().ajax.reload();
                        $("#Paymentform")[0].reset();
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Payement Added",
                        });
                    }


                }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }


        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            location.reload();
        });

        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var page_new = $('#page').val();

            if (from_date != '' && to_date != '') {


                $('.table').DataTable().destroy();
                load_data(page_new, from_date, to_date);

            } else {
                alert('Both Date is required');
            }
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
    </script>
@endpush

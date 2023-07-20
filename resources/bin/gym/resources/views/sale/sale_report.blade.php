@extends('AdminDashboard.Main.app')
@section('page-title','Report')
@push('mycss')
<link rel="stylesheet" href="{{asset('assets/extensions/sweetalert2/sweetalert2.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/datatables.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/@icon/dripicons/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">

@endpush
@section('page_content')
<div class="page-heading">


    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-10">
                            <div class="card-header">
                                Sale Summary
                            </div>
                        </div>

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


                            <button type="button" id="filter" class="btn waves-effect waves-light btn-secondary mt-4">Filter</button>
                            <button type="button" id="refresh" class="btn waves-effect waves-light btn-outline-warning mt-4">Refresh</button>

                        </div>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-10">
                                <table class="table  table-hover">
                                    <thead>
                                        <tr>

                                            <th>Service Category</th>
                                            <th>Amount(Rs)</th>



                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-1">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>
@endsection
@push('myscript')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/parsley.js')}}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{ asset('assets/js/pages/form-element-select.js')}}"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
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
    $(document).ready(function() {

        load_data();


    });



    function load_data(from_date = '', to_date = '') {
        $('.table').DataTable({
            retrieve: true,
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            info: false,
            ajax: {
                url: "{{ route('sales.summary.ajax') }}",
                data: function(d) {
                    d.from_date = from_date;
                    d.to_date = to_date;
                },
            },
            dom: 'lBfrtip',
            responsive: true,
            autoWidth: false,
            scrollY: false,
            ordering: false,
            buttons: [
                'excel', {
                    extend: 'print',
                    title: 'Safari GYM Sale REPORT',
                    footer: true,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1]
                    },

                },
            ],

            "lengthMenu": [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            drawCallback: function() {
                var api = this.api();
                var cash = this.api().ajax.json().cash_callback;
                var card = this.api().ajax.json().card_callback;
                var cheque = this.api().ajax.json().cheque_callback;
                var online = this.api().ajax.json().online_callback;
                var discount = this.api().ajax.json().discount_callback;
                var grandtotal = cash + card + cheque + online;
                // var sum = api.column(3).data().sum();
                var ht = `<div style="border-style: double;">&nbsp;&nbsp;Cash :<b> ` + cash + ` </b> <br>&nbsp;&nbsp;Credit Card :<b> ` + card + `</b><br>&nbsp;&nbsp;Cheque:<b> ` + cheque + `</b><br>&nbsp;&nbsp;Online transfer:<b> ` + online + `</b><br>&nbsp;&nbsp;Grand Total:<b> ` + grandtotal + `</b></div>`;

                $(api.column(0).footer()).html(ht);

            },
            columns: [

                {
                    data: 'service_category',
                    name: 'service_category'

                },
                {
                    data: 'total_sum',
                    name: 'total_sum',
                    render: function(data, type, row) {
                        return row.total_sum - row.total_discount;
                    }
                },



            ]

        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info text-white mt-2');
    }


    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {

            $('.table').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });

    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        location.reload();
    });
</script>



@endpush
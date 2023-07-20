@extends('AdminDashboard.Main.app')
@push('mycss')
<link rel="stylesheet" href="{{asset('assets/extensions/sweetalert2/sweetalert2.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/datatables.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/@icon/dripicons/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">
<link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')}}">


@endpush
@section('page_content')
<div class="page-heading">





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

                        Partial Payment Info
                    </div>
                    <div class="row m-b-5">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="last-name-column" class="form-label">From Date</label>
                                <input type="date" id="from_date" class="form-control" placeholder="Form Date">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="last-name-column" class="form-label">To Date</label>
                                <input type="date" id="to_date" class="form-control" placeholder="Form Date">
                            </div>
                        </div>


                        <div class="col-md-2">


                            <button type="button" id="filter" class="btn waves-effect waves-light btn-secondary mt-3">Filter</button>
                            <button type="button" id="refresh" class="btn waves-effect waves-light btn-outline-warning mt-3">Refresh</button>

                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount (Rs)</th>
                                    <th>Paymnet Type</th>
                                    <th>Date/Time</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
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



    function load_data(from_date='',to_date='') {
        $('.table').DataTable({
            retrieve: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax.sales.payment.info') }}",
                data: function(d) {
                    d.from_date = from_date;
                    d.to_date = to_date;
                },
            },
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
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'amount',
                    name: 'amount'
                },

                {
                    data: 'payment_type',
                    name: 'payment_type'
                },


                {
                    data: 'created_at',
                    name: 'created_at'
                },




                {
                    data: 'action',
                    name: 'action'
                }


            ]

        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info text-white mt-2');
    }

    ////show hide


    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        location.reload();
    });

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
       
      
        if (from_date != '' && to_date != '') {

          
            $('.table').DataTable().destroy();
            load_data(from_date,to_date);

        } else {
            alert('Both Date is required');
        }
    });
</script>



@endpush
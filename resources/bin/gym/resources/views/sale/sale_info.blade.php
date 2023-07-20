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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-10">
                            <div class="card-header">
                                All Freeze Info
                            </div>
                        </div>

                    </div>


                    <div class="card-body">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Member#</th>
                                    <th>Member_Name</th>
                                    <th>Service Name</th>
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



    function load_data(month = '') {
        $('.table').DataTable({
            retrieve: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sale_info_ajax.index') }}",
                data: function(d) {
                    d.month = month;
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
                    data: 'member_id',
                    name: 'member_id'
                },
                {
                    data: 'member_name',
                    name: 'member_name'
                },

                {
                    data: 'pkg_name',
                    name: 'pkg_name'
                },
                {
                    data: 'order_id',
                    name: 'order_id',
                    render: function(data, type, row) {

                        return `<td>
                    <a href="/sales/` + row.order_id + `" class="btn btn-info ">View</a>
                    <a href="/invoice/` + row.order_id + `" target="_blank" class="btn btn-secondary"><span class="fa-fw select-all fas"></span></a>
                    </td>`;

                    },
                },







            ]

        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info text-white mt-2');
    }
</script>



@endpush
@extends('AdminDashboard.Main.app')
@section('page-title', 'Member')
@push('mycss')
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('assets/extensions/@icon/dripicons/dripicons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/dripicons.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}"> -->

<!-- <style>
                                .fontawesome-icons {
                                    text-align: center;
                                }

                                article dl {
                                    background-color: rgba(0, 0, 0, .02);
                                    padding: 20px;
                                }

                                .fontawesome-icons .the-icon {
                                    font-size: 24px;
                                    line-height: 1.2;
                                }
                            </style> -->
<!--here is you css-->
@endpush
@section('page_content')
<div class="page-heading">
    <input id="page" type="hidden" value="{{ $page }}">

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-10">
                            <div class="card-header">
                                {{ $page ? Str::headline($page) . ' List' : 'All Members List' }}


                            </div>
                        </div>
                        <div class="col-2 mt-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#large" class="btn btn-outline-info">Add New Member</a>

                            <!-- <a href="{{ route('members.create') }}" class="btn btn-outline-info">Add New Member</a> -->
                        </div>
                    </div>



                    <div class="card-body">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Membership no:</th>
                                    <th>Name</th>
                                    <th>Expiry</th>
                                    <th>Gender</th>
                                    <th>Mobile</th>
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
@include('sale.posmodal')
@endsection
@push('myscript')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/parsley.js') }}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $("#nic").inputmask();
</script>
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
        let page = $('#page').val();

        load_data(page);

    });


    $.fn.dataTable.ext.errMode = 'throw';
    function load_data(page = '') {
        $('.table').DataTable({
            search: {
                return: true,
            },
            retrieve: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('members.index') }}",
                data: function(d) {
                    d.page = page;
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
                    data: 'member_no',
                    name: 'member_no'
                },
                {
                    data: 'member_name',
                    name: 'member_name'
                },
                {
                    data: 'expiry',
                    name: 'expiry'
                },
                {
                    data: 'member_gender',
                    name: 'member_gender'
                },
                {
                    data: 'member_mobile',
                    name: 'member_mobile'
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
    $('#category').change(function() {

        var value = $(this).val();

        if (value == "Monthly") {
            $(".d-none").show();
            $('.d-none').removeClass('d-none');
        } else {
            $(".show").hide();
            $('.show').addClass('d-none');
        }
    });
</script>
@endpush
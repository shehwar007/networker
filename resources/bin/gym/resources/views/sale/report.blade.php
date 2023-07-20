@extends('AdminDashboard.Main.app')
@section('page-title','Report')
@push('mycss')
<!--here is you css-->
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


<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Summary</h4>
                </div>
                <div class="card-content">
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


                        <div class="col-md-2 mt-4">


                            <button type="button" id="filter" class="btn waves-effect waves-light btn-secondary">Filter</button>
                            <button type="button" id="refresh" class="btn waves-effect waves-light btn-outline-warning">Refresh</button>

                        </div>
                    </div>

                    <!-- table bordered -->
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-10">
                            <div class="table-responsive">
                                <table id="summary_table" class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Desciption</th>
                                            <th>Amount(Rs)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">Cash Sale</td>
                                            <td id="cash_sale"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Credit Card Sale</td>
                                            <td id="card_sale"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Cheque</td>
                                            <td id="cheque"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Online Transfer</td>
                                            <td id="online"></td>

                                        </tr>
                                        <tr class="table-success">
                                            <td class="text-bold-500">Total Sale</td>
                                            <td id="total_sale"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Cash Expense</td>
                                            <td id="cash_expense"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Credit Card Expense</td>
                                            <td id="card_expense"></td>

                                        </tr>
                                        <tr class="table-danger">
                                            <td class="text-bold-500">Total Expense</td>
                                            <td id="total_expense"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Total Cash Revenue</td>
                                            <td id="cash_revenue"></td>

                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Total Credit Card Revenue</td>
                                            <td id="card_revenue"></td>

                                        </tr>
                                        <tr class="table-info">
                                            <td class="text-bold-500">Total Revenue</td>
                                            <td id="total_revenue"></td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-1">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

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
<!--here is you css-->

<script>
    $(document).ready(function() {
        all_summary();
        setTimeout(function() {

            summarytab();
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info text-white mt-2');


        }, 5000);




    });

    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#summary_table').DataTable().destroy();
        all_summary();
        setTimeout(function() {

            summarytab();
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info text-white mt-2');


        }, 5000);

    });
    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {

            $('#summary_table').DataTable().destroy();
            all_summary(from_date, to_date);
            setTimeout(function() {

                summarytab();
                $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info text-white mt-2');


            }, 5000);
        } else {
            alert('Both Date is required');
        }
    });

    function all_summary(from_date = '', to_date = '') {



        $.ajax({


            url: "{{route('summarypost')}}",

            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                from_date: from_date,
                to_date: to_date,

            },
            success: function(data) {
                response = $.parseJSON(data);
                displayData(response);

            },
            complete: function() {

            }
        });

    }

    function displayData(response) {

        //servies
        $('#cash_sale').hide();
        $('#cash_sale').html(response.cash_sale);
        $('#cash_sale').show(500);
        $('#card_sale').hide();
        $('#card_sale').html(response.card_sale);
        $('#card_sale').show(500);
        $('#total_sale').hide();
        $('#total_sale').html(response.total_sale);
        $('#total_sale').show(500);

        $('#cheque').hide();
        $('#cheque').html(response.cheque);
        $('#cheque').show(500);

        $('#online').hide();
        $('#online').html(response.online);
        $('#online').show(500);


        $('#cash_revenue').hide();
        $('#cash_revenue').html(response.cash_revenue);
        $('#cash_revenue').show(500);
        $('#card_revenue').hide();
        $('#card_revenue').html(response.card_revenue);
        $('#card_revenue').show(500);
        $('#total_revenue').hide();
        $('#total_revenue').html(response.total_revenue);
        $('#total_revenue').show(500);


        $('#cash_expense').hide();
        $('#cash_expense').html(response.cash_expense);
        $('#cash_expense').show(500);
        $('#card_expense').hide();
        $('#card_expense').html(response.card_expense);
        $('#card_expense').show(500);
        $('#total_expense').hide();
        $('#total_expense').html(response.total_expense);
        $('#total_expense').show(500);
    }

    function summarytab() {
        var table = $('#summary_table').DataTable({
            dom: 'B',
            buttons: [
                'excel', 'print'

                // {

                //     extend: 'print',

                //     customize: function(win) {

                //         $(win.document.body).find('table thead th:nth-child(1)').css('font-size', '22px').css('font-weight', 'bold');
                //         $(win.document.body).find('table thead th:nth-child(2)').css('font-size', '22px').css('font-weight', 'bold');
                //         $.each([3, 6, 13, 10, 19, 23, 27], function(index, value) {
                //             $(win.document.body).find('table tbody tr:nth-child(' + value + ')').css('font-size', '18px').css('font-weight', 'bold');
                //         });
                //         $(win.document.body).find('table tbody tr:nth-child(14)').css('line-height', '2').css('font-size', '23px').css('font-weight', 'bold').css('border-bottom', '10px solid #dee2e6');

                //         $(win.document.body).find('table tbody tr:nth-child(15)').css('font-size', '25px').css('font-weight', 'bold').css('color', 'black').css('border-bottom', '10px solid #dee2e6');
                //         $(win.document.body).find('table tbody tr:nth-child(16)').css('line-height', '2').css('text-align', 'center').css('font-size', '23px').css('font-weight', 'bold');
                //         $(win.document.body).find('table tbody tr:nth-child(20)').css('line-height', '2').css('text-align', 'center').css('font-size', '23px').css('font-weight', 'bold');
                //         $(win.document.body).find('table tbody tr:nth-child(24)').css('line-height', '2').css('text-align', 'center').css('font-size', '23px').css('font-weight', 'bold');

                //     },
                //     action: function(e, dt, button, config) {
                //         var branch = $('#branch_name').val();
                //         var user = $('#user_name').val();
                //         var time = $('#date_time').val();
                //         var client = $('#m_totalcustomer').text();

                //         config.title = '<div class="row"><div class="col-md-4">IGNITE</div><div class="col-md-5">Depilex</div><div class="col-md-3"><h3>' + time + ' </h3><h6>Printed By: ' + user + '</h6></div></div><h5>No of Clients: ' + client + '</h5><h3 style="padding-left: 30%;">Summary</h3>';

                //         $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                //     }

                // },
            ],
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,

        });
    }
</script>
@endpush
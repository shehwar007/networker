@extends('AdminDashboard.Main.app')
@section('page-title','POS')
@push('mycss')
<link rel="stylesheet" href="{{asset('assets/extensions/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">

<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/datatables.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/@icon/dripicons/dripicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">
<link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .disabled {
        pointer-events: none;
        cursor: default;
    }

    .vl {
        border-left: 6px solid green;
        height: 500px;
    }
</style>

<style>
    .cards tbody tr {
        float: left;
        width: 155px;
        border: 1px solid rgba(182, 182, 182, 0.201);
    }

    .cards tbody td {
        display: block;
    }

    .cards tr:hover {
        border: 1px solid #b6baea;
        cursor: pointer;
    }

    .disabled {
        pointer-events: none;
        opacity: 0.3;
    }

    .cards thead {
        display: none;
    }

    .cards .odd {
        height: 200px !important;
    }

    .cards .even {
        height: 200px !important;
    }

    .cards table th,
    .table td {
        padding: 2px !important;
        text-align: center !important;
        vertical-align: top;
        border-top: 0px !important;
    }

    tr.selected td:before {
        color: #CCC;
    }

    .table .avatar {
        width: 80px;
    }

    .cards .avatar {
        width: 80px;
        margin: 0px !important;
    }
</style>
<!--here is you css-->

@endpush
@section('page_content')



<!-- Basic Tables start -->

<!-- <button onclick="Test()">Testing Function 007</button> -->

<div class="row">
    <div class="col-md-5">
        <form action="{{ route('sales.store') }}" method="post" autocomplete="off" enctype="multipart/form-data" id="productform">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <h4 class="card-title">Cart</h4>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="select2 form-select" id="customerdropdown" name="member_id" style="width: 100%; height:36px;">
                                    @if(Session::has('success'))
                                    @foreach($member as $data)
                                    <option value="{{$data->id}}">({{$data->member_no}}) {{$data->member_name}} ({{$data->member_mobile}}) </option>
                                    @endforeach
                                    <option value="0">Walk in Customer</option>
                                    @else
                                    <option value="0">Walk in Customer</option>
                                    @foreach($member as $data)
                                    <option value="{{$data->id}}">({{$data->member_no}}) {{$data->member_name}} ({{$data->member_mobile}}) </option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>

                        </div>
                        <div class="col-md-1">
                            <a href="#" class="btn btn-sm btn-info  icon" data-bs-toggle="modal" data-bs-target="#large"><i class="bi bi-person"></i></a>

                        </div>
                        <div class="col-md-1">
                            <a href="javascript:ViewHistory()" class="btn btn-sm btn-info  icon"><i class="bi bi-eye-fill"></i></a>

                        </div>

                    </div>

                    <!-- <input type="text" class="d-none " id="barcode" onkeyup="BarCode(this.value)"> -->
                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-dark mb-0" id="carttable">

                            <thead>
                                <tr>
                                    <th colspan="2">Service / Product</th>
                                    <th>Price</th>
                                    <th></th>
                                    <th>Subtotal</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(Cart::instance('product')->count()!=0)
                                @foreach (Cart::instance('product')->content() as $key => $value)
                                @if($value->options->category=='Bar')
                                <tr>
                                    <td colspan="2" class="" style="text-align:left!important;"> {{ $value->name}}</td>
                                    <td class="text-bold-500" style="text-align:left!important;">Rs:{{ $value->price}}</td>
                                    <td class="text-bold-500" style="text-align:left!important;">

                                        <input style="width: 80px;" min="1" type="number" class="form-control" value="{{ $value->qty}}" onchange="UpdateCart('{{$value->rowId}}',this.value)">
                                    </td>
                                    <td class="text-bold-500" style="text-align:left!important;">{{ (int)$value->subtotal }}</td>
                                    <td class="text-bold-500"><a href="javascript:void(0)" onclick="DeleteCart('{{$value->rowId}}')">X</a></td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="2" class="" style="text-align:left!important;"> {{ $value->name}}</td>
                                    <td class="text-bold-500" style="text-align:left!important;">Rs:{{ $value->price}}</td>
                                    <td class="text-bold-500" style="text-align:left!important;">
                                        {{$value->options->type ?? "Not Set"}}
                                    </td>

                                    <td class="text-bold-500" style="text-align:left!important;">{{ (int)$value->subtotal }}</td>
                                    <td class="text-bold-500"><a href="javascript:void(0)" onclick="DeleteCart('{{$value->rowId}}')">X</a></td>
                                </tr>
                                @endif

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">...... Cart Empty ......</td>
                                </tr>
                                @endif



                            </tbody>
                            <!--  -->
                            <tfoot>
                                @php

                                $grand_total = Cart::instance('product')->subtotal();
                                $discount=0;
                                @endphp

                                <tr>
                                    <td colspan="2"></td>
                                    <td>Sub Total</td>
                                    <td id="subtotal_val">{{Cart::instance('product')->subtotal()}}</td>
                                    <td></td>
                                    <td></td>



                                </tr>
                                <tr class="d-none" id="discount_row">
                                    <td colspan="2"></td>
                                    <td>Discount</td>
                                    <td id="discount_value">0</td>
                                    <td></td>
                                    <td></td>


                                </tr>

                                <tr>
                                    <td colspan="2"></td>
                                    <td>Grand Total</td>
                                    <td id="grand_total_value">{{$grand_total}}</td>
                                    <td></td>
                                    <td></td>


                                </tr>
                                <tr class="d-none" id="balance_row">
                                    <td colspan="2"></td>
                                    <td>Balance:</td>
                                    <td id="balance_value">0</td>
                                    <td></td>
                                    <td></td>


                                </tr>


                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2 d-none show_note">
                        <div class="col-md-12">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="notes" placeholder="Here is Notes"></textarea>


                        </div>
                    </div>
                    <div class="row d-none show_discount">
                        <div class="col-md-8">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Dicount</span>
                                <input type="number" name="discount" id="discountid" onkeyup="clearcharge()" min="0" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-sm mb-3 d-none">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Charge Amount</span>
                                <input type="number" id="chargeid" min="0" onkeyup="cleardiscount()" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                    </div>
                    <div class="row d-none show_card">
                        <div class="col-md-8">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Card No:</span>
                                <input type="text" name="card_no" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>

                        </div>

                    </div>
                    <div class="row d-none show_partial">
                        <div class="col-md-8">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Partial Amount:</span>
                                <input type="number" name="partial_payment" onkeyup="partialcharge(this.value)" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>

                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" style="cursor: pointer;" name="dicount_check">
                                <label class="form-check-label" for="flexSwitchCheckDefault" style="cursor: pointer; user-select: none;"><b>Discount</b></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="note_check" style="cursor: pointer;" name="notes_check">
                                <label class="form-check-label" for="note_check" style="cursor: pointer; user-select: none;"><b>Notes</b></label>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <dt class="the-icon" style="color: red;"><span class="fa-fw select-all fas"></span> <label class="form-check-label" style="cursor: pointer; user-select: none;" onclick="ClearCart()"><b>Clear Cart</b></label>
                            </dt>

                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-4">

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Payment Type</label>
                                <select class="form-select" id="payment_method" name="payment_method" onchange="DisplayCard(this.value)">

                                    <option>Cash</option>
                                    <option>Credit Card</option>
                                    <option>Cheque</option>
                                    <option>Online Transfer</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Payment Status</label>
                                <select class="form-select" name="payment_status" onchange="DisplayPartialField(this.value)">

                                    <option>Paid</option>
                                    <!-- <option>Unpaid</option> -->
                                    <option>Partial Pay</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">

                            <div class="form-group has-success">
                                <label for="basicInput">Package Date</label>
                                <input type="date" name="created_at" class="form-control" value="{{now()->format('Y-m-d')}}" max="{{now()->format('Y-m-d')}}">
                            </div>

                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-3">
                            <div class="buttons">

                                <button onclick="return confirm('Confirm your Order?')" type="submit" class="btn icon icon-left btn-primary"><i data-feather="check-circle"></i>
                                    Proceed</button>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </form>

    </div>
    <div class="col-7">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home" onclick="NavbarData('')">All</a>
                            </li>
                            @foreach($navbar as $data)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" onclick="NavbarData('{{$data}}')">{{$data}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>


            </div>


            <div class="card-body">
                <table class="tableajax" cellspacing="0" width="100%">

                    <thead>
                        <tr>

                            <th></th>
                            <th></th>

                            <th></th>



                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--------->
<div class="modal fade text-left" id="small" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel19">Small Modal</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                Biscuit chocolate cake gummies. Lollipop I love macaroon bear claw
                caramels. I love
                marshmallow tiramisu I love fruitcake I love gummi bears.
                Carrot cake topping liquorice. Pudding caramels liquorice sweet I love.
                Donut powder cupcake
                ice cream tootsie roll jelly.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-sm-block d-none">Close</span>
                </button>
                <button type="button" class="btn btn-primary ml-1 btn-sm" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block d-none">Accept</span>
                </button>
            </div>
        </div>
    </div>
</div>
@include('sale.posmodal')
@endsection
@push('myscript')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/parsley.js')}}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{ asset('assets/js/pages/form-element-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js')}}"></script>>
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
    const truncate = (str, max, suffix) => str.length < max ? str : `${str.substr(0, str.substr(0, max - suffix.length).lastIndexOf(' '))}${suffix}`;
</script>
<script>
    $(document).ready(function() {

        setTimeout(function() {

            $('#sidebar').removeClass('active');
            $('.trigger1').trigger('click');

        }, 1);


        load_data();
        $(".select2").select2();

    });


    function NavbarData(id) {
        var category = id;

        $('.tableajax').DataTable().destroy();
        load_data(category);

    }



    function load_data(category = '') {

        var table = $('.tableajax').DataTable({
                'dom': "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'<'float-md-right ml-2'B>f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "ajax": {
                    "url": "{{ route('services.index') }}",
                    data: function(d) {
                        d.category = category;
                    },

                },
                'columnDefs': [{
                    "targets": [1, 2],
                    "visible": false,
                    "searchable": true,

                }, ],
                'buttons': [{
                    'text': '<i class="fa fa-id-badge fa-fw" aria-hidden="true"></i>',
                    'action': function(e, dt, node) {

                        $(dt.table().node()).toggleClass('cards');
                        $('.fa', node).toggleClass(['fa-table', 'fa-id-badge']);

                        dt.draw('page');
                    },
                    'className': 'btn-sm trigger1 d-none',
                    'attr': {
                        'title': 'Change views',
                    }
                }],
                'select': 'single',
                "lengthMenu": [
                    [20, 25, 50, 100, 200, -1],
                    [20, 25, 50, 100, 200, "All"]
                ],
                'columns': [

                    {
                        'orderable': false,
                        'data': null,
                        'className': 'text-center',
                        data: 'service_title',
                        name: 'service_title',
                        render: function(data, type, row) {

                            return `<a href="javascript:void(0)" onclick="AddToCart(` + row.id + `)">
                            
                           <img src="{{asset('assets/images/faces/1.jpg')}}" class="avatar border rounded-circle"/>
                           
                            <div class="panel mt-3" data-toggle="tooltip"
                            data-bs-placement="top" title="` + row.service_title + `">` + truncate(row.service_title, 23, '...') + `</div>
                            <div class="panel">Rs:` + row.service_price + `</div>
                            </a>`;

                        }
                    },
                    {
                        data: 'service_category',
                        name: 'service_category',
                    },

                    {
                        data: 'service_price',
                        name: 'service_price',
                    },

                ],
                'drawCallback': function(settings) {
                    var api = this.api();
                    var $table = $(api.table().node());

                    if ($table.hasClass('cards')) {

                        // Create an array of labels containing all table headers
                        var labels = [];
                        $('thead th', $table).each(function() {
                            labels.push($(this).text());
                        });

                        // Add data-label attribute to each cell
                        $('tbody tr', $table).each(function() {
                            $(this).find('td').each(function(column) {
                                $(this).attr('data-label', labels[column]);
                            });
                        });

                        var max = 0;
                        $('tbody tr', $table).each(function() {
                            max = Math.max($(this).height(), max);
                        }).height(max);

                    } else {
                        // Remove data-label attribute from each cell
                        $('tbody td', $table).each(function() {
                            $(this).removeAttr('data-label');
                        });

                        $('tbody tr', $table).each(function() {
                            $(this).height('auto');
                        });
                    }
                    $('.tableajax').on('draw.dt', function() {
                        $('[data-toggle="tooltip"]').tooltip();
                    })
                }
            })
            .on('select', function(e, dt, type, indexes) {
                var rowData = table.rows(indexes).data().toArray()
                $('#row-data').html(JSON.stringify(rowData));
            })
            .on('deselect', function() {
                $('#row-data').empty();
            })

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


    function test() {
        $("#small").modal('show');
    }

    function AddToCart(id) {
        $.get('addtocart/' + id, function(result) {
            response = $.parseJSON(result);
            $('#carttable').load(location.href + ' #carttable');

        })
    }

    function UpdateCart(id, value) {
        $.get('updatecart/' + id + '/' + value, function(result) {
            response = $.parseJSON(result);
            $('#carttable').load(location.href + ' #carttable');

        })
    }

    function DeleteCart(id) {
        $.get('removecart/' + id, function(result) {
            $('#carttable').load(location.href + ' #carttable');

        })
    }

    function ClearCart() {


        $.get('clearcart/', function(result) {
            $('#carttable').load(location.href + ' #carttable');

        })
    }

    function BarCode(id) {
        if (id.length >= 2) {
            AddToCart(id);
            $("#barcode").val('');
        }

    }

    $('input[name="notes_check"]').click(function() {

        if ($(this).is(":checked")) {
            $(".show_note").show();
            $('.show_note').removeClass('d-none');
        } else {
            $(".show_note").hide();
            $('.show_note').addClass('d-none');
        }
    });
    $('input[name="dicount_check"]').click(function() {

        if ($(this).is(":checked")) {
            $(".show_discount").show();
            $('.show_discount').removeClass('d-none');
            $('#discount_row').removeClass('d-none');

        } else {
            $(".show_discount").hide();
            $('.show_discount').addClass('d-none');
            $('#discount_row').addClass('d-none');
        }
    });

    function DisplayCard(value) {


        if (value == "Credit Card") {
            $(".show_card").show();
            $('.show_card').removeClass('d-none');
        } else {
            $(".show_card").hide();
            $('.show_card').addClass('d-none');
        }
    }

    function DisplayPartialField(value) {


        if (value == "Partial Pay") {
            $(".show_partial").show();
            $('.show_partial').removeClass('d-none');
            $("#balance_row").show();
            $('#balance_row').removeClass('d-none');

        } else {
            $(".show_partial").hide();
            $('.show_partial').addClass('d-none');
            $("#balance_row").show();
            $('#balance_row').addClass('d-none');
        }
    }



    function clearcharge() {
        // subtotal_val
        // document.getElementById('chargeid').value = " ";
        var g = $('#subtotal_val').text();
        var discount = Number(document.getElementById('discountid').value);
        // var grandtotal=Number(document.getElementById('total_id').value);
        var grandtotal = Number(g);
        if (discount == " ") {
            discount = 0;
        }
        var result = grandtotal - discount;
        document.getElementById('grand_total_value').innerHTML = result.toFixed(0);

        document.getElementById('discount_value').innerHTML = discount.toFixed(0);


    }

    function partialcharge(amount) {

        var g = $('#subtotal_val').text();
        var partial_amount = Number(amount);
        var grandtotal = Number(g);
        if (partial_amount == " ") {
            partial_amount = 0;
        }
        var result = grandtotal - partial_amount;
        var discount = Number(document.getElementById('discountid').value);
        if (discount) {
            var result = result - discount;
        }
        document.getElementById('grand_total_value').innerHTML = partial_amount.toFixed(0);

        document.getElementById('balance_value').innerHTML = result.toFixed(0);


    }
    //members
    $('#category_member').change(function() {

        var value = $(this).val();

        if (value == "Monthly") {
            $(".show_member").show();
            $('.show_member').removeClass('d-none');
        } else {
            $(".show_member").hide();
            $('.show_member').addClass('d-none');
        }
    });


    ////filhal k laye coment kiya jata hai
    function cleardiscount() {


        document.getElementById('discountid').value = " ";
    }

    function Test() {
        alert('ner test');
    }

    function TestpassDropDown() {
        var data = {
            id: 'Barn owl',
            text: 'Barn owl'
        };

        var newOption = new Option(data.text, data.id, false, false);
        $('#customerdropdown').append(newOption).trigger('change');
        $("#customerdropdown").val('Barn owl').change();

    }


    function ViewHistory() {

        var id = $('#customerdropdown').val();
        if (id != 0) {
            var data = "";
            $.get('recentservices/' + id, function(result) {
                response = $.parseJSON(result);
                console.log(response);


                $.each(response, function(index, value) {
                    data += `<div class="recent-message d-flex px-4 py-3" >                         
                          <div class="name ms-4">
                              <h5 class="mb-1">` + value.pkg_name + `</h5>
                              
                              <h6 class="text-muted mb-0">` + value.expire_date + `</h6>
                          </div>
                          <div style="justify-content: flex-end;margin-left: auto;margin-right: 0;">
                                <h6 class="text-muted mb-0">` + value.subtotal + `</h6>
                                <h6 class="text-muted mb-0">` + value.date + `</h6>
                                <span class="badge bg-light-danger">`+value.freeze+`</span>
                            </div>
                         
                      </div>`
                });
                $('#RecentServices').html(data);
                $('#ViewHistory').modal('toggle');
            })

            // $.get('recentservices/' + id, function(result) {
            //     response = $.parseJSON(result);

            // })
        } else {
            alert('Member not Found')
        }
        // $.each([ 52, 97 ], function(index, value) {
        //     data += `<div class="recent-message d-flex px-4 py-3" >                         
        //                   <div class="name ms-4">
        //                       <h5 class="mb-1">Personal Traning</h5>
        //                       <h6 class="text-muted mb-0">Rs:2000</h6>
        //                       <h6 class="text-muted mb-0">Expire Date :20/11/2019</h6>
        //                   </div>
        //                   <div class="name ms-4">
        //                       <a href="" class="btn btn-info ">View</a>
        //                       <a href="" target="_blank" class="btn btn-secondary"><span class="fa-fw select-all fas"></span></a>
        //                   </div>
        //               </div>`
        // });
        // $('#RecentServices').html(data);
        // $('#ViewHistory').modal('toggle');
        // var id = $('#customerdropdown').val();
        //  if(id){

        //  }
    }

    function JsTest() {
        // document.getElementById('customerdropdown').value = "Rombo"
        // $("#customerdropdown option[value='Rombo']").attr("selected", "selected");
        // document.getElementById('customerdropdown').choices.setValue([{value:"Rombo", label: "Rombo"}])
        // var selector = new Choices(document.getElementById('customerdropdown')); selector.setValueByChoice('Rombo');
        // customerdropdown
        // var onholdtitle = $("#customerdropdown :selected").text();
        // var id = $('#customerdropdown').val();
        // var value = 'Rombo';
        // var value = $('#customerdropdown').val();
        // $("#customerdropdown").val('Rombo').change();
        // $("#customerdropdown").val('Rombo');
        // $("#customerdropdown").change();
        // alert(onholdtitle);
    }
</script>



@endpush
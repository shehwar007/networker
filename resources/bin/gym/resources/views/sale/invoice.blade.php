<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin-panel/assets/images/favicon.png') }}">

    <title>Safari Gym</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }

        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px dotted #ddd;
        }

        td,
        th {
            padding: 7px 0;
            width: 50%;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: left;
        }


        .centered {
            text-align: center;
            align-content: center;
        }

        small {
            font-size: 11px;
        }

        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 1.5cm 0.5cm 0.5cm;
            }

            @page: first {
                margin-top: 0.5cm;
            }

            tbody::after {
                content: '';
                display: block;
                page-break-after: always;
                page-break-inside: avoid;
                page-break-before: avoid;
            }
        }
    </style>
</head>

<body>

    <div style="max-width:400px;margin:0 auto">

        <div class="hidden-print">
            <table>
                <tr>


                    <td><a href="{{ url()->previous()}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>Back</a> </td>


                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> Print</button></td>
                </tr>
            </table>
            <br>
        </div>


        <div id="receipt-data">

            <div class="centered">
                <img src="{{asset('d_img')}}/{{$logo}}" height="80px" alt="homepage" />

                {!!$header!!}
               
            </div>

            <p> Invoice#: {{str_pad($saleinfo->id,5,'0',STR_PAD_LEFT)}}<br>
                Date:{{ Carbon::parse($saleinfo->created_at)->format('d-m-Y g:i a')}}  <br>

                Cashier: {{$saleinfo->branch_user ?? ""}}<br>
                Customer: {{$saleinfo->member->member_name ?? "Walk-in Customer"}}<br>
                Membership#: {{$saleinfo->member->member_no ?? ""}}<br>
                @if($saleinfo->notes)

                Note:{{$saleinfo->notes}}
                    
                @endif


            </p>
            <table class="table-data">
                <tbody>


                    @foreach($productinfo as $key => $value)
                    <tr style="border-bottom: 1pt solid grey;">
                        <td colspan="2">

                            {{$value->service->service_title ?? ""}}
                            @if($value->service->service_category=='Bar')
                            <br>{{$value->qty}} x {{$value->price}}
                            @endif
                            @if($value->expired_date)
                            <br>Expire Date:{{ Carbon::parse($value->expired_date)->format('d-m-Y')}}
                            @else
                            @if($value->service->service_category!=='Bar')
                            <br>Daily
                            @endif

                            @endif


                        </td>
                        <td style="text-align:right;vertical-align:bottom">{{$value->subtotal}}</td>
                    </tr>
                    @endforeach

                   

                    <tr>
                        <th colspan="2" style="text-align:left">Sub Total</th>
                        <th style="text-align:right">{{$saleinfo->subtotal}}</th>
                    </tr>






                    @if($saleinfo->discount)
                    <tr>
                        <th colspan="2" style="text-align:left">Discount</th>
                        <th style="text-align:right"> -{{$saleinfo->discount}}</th>
                    </tr>
                    @endif




                    <tr>
                        <th colspan="2" style="text-align:left">Grand total</th>
                        <th style="text-align:right">{{$saleinfo->grand_total}}</th>
                    </tr>
                    @if($saleinfo->balance)
                    <tr>
                        <th colspan="2" style="text-align:left">Balance</th>
                        <th style="text-align:right">{{$saleinfo->balance}}</th>
                    </tr>
                    @endif
                    <tr>

                    </tr>
                </tbody>
                <!-- </tfoot> -->
            </table>
            <table>
                <tbody>

                    <tr style="background-color:#ddd;">
                        <td style="padding: 5px;width:30%">Paid By: {{$saleinfo->payment_method}}@if($saleinfo->payment_method=="Card")/{{$saleinfo->card_no}}@endif</td>

                        <td style="padding: 5px;width:40%">Amount: Rs.{{$saleinfo->grand_total }}</td>
                    </tr>

                    @if($saleinfo->notes)
                    <tr style="display: none;">
                        <td class="centered" colspan="3"><strong>Note:</strong>{{$saleinfo->notes}}</td>
                    </tr>
                    @endif


                    <tr>
                        <td class="centered" colspan="3"> {!!$footer!!}</td>


                    </tr>

                </tbody>
            </table>
          


        </div>
    </div>

    <script type="text/javascript">
        localStorage.clear();

        function auto_print() {
            window.print()
        }
        @if(session('success'))
        setTimeout(auto_print, 1000);
        @endif
    </script>

</body>

</html>
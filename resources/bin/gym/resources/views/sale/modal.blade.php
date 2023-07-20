<!----PArtial Payment MODEL---->
<div class="modal fade text-left" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg alert-dismissible" style="display:none">
                <ul>

                </ul>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Payment</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="Paymentform" method="POST" autocomplete="off" class="form">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input type="hidden" class="form-control" id="order_id" name="order_id">
                @csrf
                <div class="modal-body">
                    <label>Amount: </label>
                    <div class="form-group mandatory mt-1">
                        <input type="number" name="amount" class="form-control" min="0" required>
                    </div>
                    <label>Payment Type: </label>
                    <div class="form-group mt-1">
                        <select class="form-select" name="payment_type" id="carddropdown" required>
                            <option>Cash</option>
                            <option>Credit Card</option>

                        </select>
                    </div>
                    <div class="form-group has-success displaycardcls d-none" id="displaycard">
                        <label class="control-label">Card Invoice no:</label>
                        <input type="text" name="cardno" class="form-control" placeholder="">


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="sumbit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-------Edit Payment Type Cash and Card Order Modal------>
<div class="modal fade text-left" id="EditOrderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg alert-dismissible" style="display:none">
                <ul>

                </ul>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Payment Type</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('update.order') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                @csrf

                <input type="hidden" class="form-control" id="order_id_update" name="order_id">

                <div class="modal-body">

                    <label>Payment Type: </label>
                    <div class="form-group mt-1">
                        <select class="form-select" name="payment_type" id="carddropdown" required>
                            <option>---Select---</option>
                            <option>Cash</option>
                            <option>Credit Card</option>
                            <option>Cheque</option>
                            <option>Online Transfer</option>

                        </select>
                    </div>
                    <div class="form-group has-success displaycardcls d-none" id="displaycard">
                        <label class="control-label">Card Invoice no:</label>
                        <input type="text" name="cardno" class="form-control" placeholder="">


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="sumbit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-------Edit Expire Modal------>
<div class="modal fade text-left" id="EditExpireModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg alert-dismissible" style="display:none">
                <ul>

                </ul>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Expire Date</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('update.expire_date') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                @csrf

                <input type="hidden" class="form-control" id="expiry_id" name="id">

                <div class="modal-body">


                    <div class="form-group has-success">
                        <label class="control-label">Expire Date:</label>
                        <input type="date" name="expired_date" id="expired_date" class="form-control" placeholder="" required>


                    </div>
                    <div class="form-check form-check-sm">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input form-check-primary form-check-glow" name="freeze_check" id="freeze_check" onclick="check();">
                            <label class="form-check-label" for="customColorCheck6">freeze</label>
                        </div>
                    </div>
                    <div id="FreezeBlock" style="display:none">
                        <div class="form-group">
                            <label for="last-name-column" class="form-label">Freeze Status</label>
                            <select class="form-select" name="freeze_status">
                                <option value="">--Select--</option>
                                <option>Freeze</option>
                                <option>Unfreeze</option>

                            </select>
                        </div>
                        <div class="form-group has-success">
                            <label class="control-label">Freeze Date:</label>
                            <input  class="form-control" type="date" name="freeze_date" value="{{now()->format('Y-m-d')}}" max="{{now()->format('Y-m-d')}}" >


                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="sumbit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-------Edit Order------>
<div class="modal fade text-left" id="EditOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg alert-dismissible" style="display:none">
                <ul>

                </ul>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Order</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="UpdateOrder" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            @php
                            $member = DB::table('members')->select('id', 'member_name', 'member_mobile', 'member_no')->latest()->get();
                            @endphp
                            <div class="form-group">
                                <label class="control-label">Member Info:</label>
                                <select class="select2 form-select" id="member_id_e" name="member_id" style="width: 100%; height:40px;">

                                    @foreach($member as $data)
                                    <option value="{{$data->id}}">({{$data->member_no}}) {{$data->member_name}} ({{$data->member_mobile}}) </option>
                                    @endforeach
                                    <option value="0">Walk in Customer</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group has-success">
                                <label class="control-label">Subtotal:</label>
                                <input type="text" name="subtotal" id="subtotal_e" class="form-control" placeholder="" readonly>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group has-success">
                                <label class="control-label">Discount:</label>
                                <input type="text" name="discount" id="discount_e" onkeyup="clearcharge()" class="form-control" placeholder="">
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group has-success">
                                <label class="control-label">Grand Total:</label>
                                <input type="text" name="grand_total" id="grand_total_e" class="form-control" placeholder="" readonly>
                            </div>

                        </div>
                        <div class="col-4">
                            <label>Payment Type: </label>
                            <div class="form-group mt-1">
                                <select class="form-select" name="payment_method" id="payment_method_e" required>
                                    <option>---Select---</option>
                                    <option>Cash</option>
                                    <option>Credit Card</option>
                                    <option>Cheque</option>
                                    <option>Online Transfer</option>

                                </select>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group has-success">
                                <label class="control-label">Date: </label>
                                <input type="date" name="date" id="date_e" class="form-control" max="{{now()->format('Y-m-d')}}">
                            </div>

                        </div>
                        @php
                        $users = DB::table('users')->select('name')->where('name', '<>', 'Shehwar Asif')->get();
                            @endphp
                            <div class="col-4">
                                <label>Cashier: </label>
                                <div class="form-group mt-1">
                                    <select class="form-select" name="branch_user" id="branch_user_e" required>

                                        @foreach($users as $data)
                                        <option>{{$data->name}}</option>
                                        @endforeach


                                    </select>
                                </div>

                            </div>


                    </div>

                </div>
                <div class="modal-footer">

                    <button type="sumbit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
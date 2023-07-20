<!-- @if($data->expired_date)<span class="badge bg-light-success">{{$data->expired_date}}</span>@endif -->
->format('Y-m-d H:i:s')

################CARBON#######
dd(Carbon::parse($expense->created_at)->format('Y-m-d'));
       dd(Carbon::createFromFormat('Y-m-d',$expense->created_at));
        $expense->created_at=2017-06-01;

$date1 = Carbon::createFromFormat('d/m/Y',$emp->employee_dateofhire);
            $condition = Carbon::now()->subMonth(6)->format('d/m/Y');
            $date2 = Carbon::createFromFormat('d/m/Y',$condition);
            $result = $date1->lt($date2);

php artisan make:model Member -mcr 
$("p").css({"background-color": "yellow", "font-size": "200%"});
php artisan make:model --migration --controller Service --resource 
php artisan make:model --migration --controller Expense --resource   
php artisan make:model --migration --controller Setting --resource 

// php artisan migrate:refresh --path=database/migrations/2022_08_15_071107_create_settings_table.php
 //php artisan db:seed --class=SettingSeeder

php artisan make:migration add_soft_delete_to_service --table=services
php artisan make:migration add_new_to_users --table=users


php artisan make:migration add_soft_delete_to_member --table=members

2022_08_11_040535_add_soft_delete_to_service
$flights = Service::onlyTrashed()->get();
Service::withTrashed()->where('service_title','Dr. Madaline Kerluke')->restore();


<!-- <button onclick="return confirm('Confirm your Order?')" type="submit"  class="btn icon icon-left btn-primary"><i data-feather="check-circle"></i>
                                    Proceed</button> -->
                                    php artisan migrate:rollback --step=1

                                    // if (response) {
                //     $('#modalPayment').modal('hide');
                //     $('.table').DataTable().ajax.reload();
                //     $("#Paymentform")[0].reset();
                //     Swal.fire({
                //         icon: "success",
                //         title: "Success",
                //         text: "Payement Added",
                //     });
                // }


                if ($.isEmptyObject(data.error)) {
                    printErrorMsg(data.error);
                    // $('#modalPayment').modal('hide');
                    // $('.table').DataTable().ajax.reload();
                    // $("#Paymentform")[0].reset();
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "Success",
                    //     text: data.success,
                    // });
                } else {

                    printErrorMsg(data.error);
                }

                /////////////

                $validator =  Validator::make($request->all(), [
            'orderid' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
            'cardno' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        style="width: 10rem !important;"


        $foo = $bar ?? 'something';
$foo = isset($bar) ? $bar : 'something';


->with('card_callback', function () use ($sum) {
            return $sum->where('payment_method', 'Credit Card')->sum(
                function($transaction){
                    return $transaction->grand_total - $transaction->discount; 
                }
            );
        })



        php artisan make:model FreezeItem -m

        // php artisan migrate:refresh --path=database/migrations/2022_10_10_154404_create_freeze_items_table.php

        php artisan migrate --path=database/migrations/2022_10_10_154404_create_freeze_items_table.php

        dd(FreezeItem::latest('id')->first()->id);
        dd($saleitem[0]->freezeinfo[0]->freeze_status);
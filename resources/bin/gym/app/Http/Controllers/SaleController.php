<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Service;
use App\Models\SaleItem;
use App\Models\Setting;
use App\Models\SalePayment;
use App\Models\Member;
use App\Models\Expense;
use App\Models\FreezeItem;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DataTables;
use Cart;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $navbar = $this->Category();
        $diseases = $this->Diseases();
        $member = $this->Members();
        return view('sale.pos', compact('navbar', 'diseases', 'member'));
    }
    public function View($page = null, Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('page') == "partial_orders") {
                if ($request->get('from_date') && $request->get('to_date')) {
                    $from = Carbon::parse($request->get('from_date'))->format('Y-m-d');
                    $to = Carbon::parse($request->get('to_date'))->format('Y-m-d');
                    $query = Sale::latest('id')->where('payment_status', 'Partial Pay')->whereBetween('created_at', [$from . "%", $to . "%"])->get();
                } else {
                    $query = Sale::latest('id')->where('payment_status', 'Partial Pay')->get();
                }
            } else {
                if ($request->get('from_date') && $request->get('to_date')) {
                    $from = Carbon::parse($request->get('from_date'))->format('Y-m-d');
                    $to = Carbon::parse($request->get('to_date'))->format('Y-m-d');
                    $startDate = Carbon::createFromFormat('Y-m-d', $request->get('from_date'))->startOfDay();
                    $endDate = Carbon::createFromFormat('Y-m-d', $request->get('to_date'))->endOfDay();
                    $query = Sale::whereBetween('created_at', [$startDate, $endDate])->get();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                } else {
                    $query = Sale::latest('id')->whereDate('created_at', Carbon::today())->get();
                }
            }

            $result = DataTables::of($query)->editColumn('member_id', function ($row) {
                $cat = empty($row->member->member_name) ? 'Walk-in Customer' : $row->member->member_name;
                return $cat;
            })->addColumn('bill_no', function ($row) {
                $bill_no =  str_pad($row->id, 5, '0', STR_PAD_LEFT);
                return $bill_no;
            })->editColumn('created_at', function ($row) {
                return $row->created_at ? with(new Carbon($row->created_at))->format('d-m-Y') : '';
            })->addColumn('action', function ($row) {
                return view('sale.action', compact('row'))->render();
            })->addColumn('sale_info', function ($row) {
                return view('sale.action_sale_info', compact('row'))->render();
            })->addColumn('action2', function ($row) {
                return view('sale.action', compact('row'))->render();
            })->with('cash_callback', function () use ($query) {
                return $query->where('payment_method', 'Cash')->sum('grand_total');
            })->with('card_callback', function () use ($query) {
                return $query->where('payment_method', 'Credit Card')->sum('grand_total');
            })->with('cheque_callback', function () use ($query) {
                return $query->where('payment_method', 'Cheque')->sum('grand_total');
            })->with('online_callback', function () use ($query) {
                return $query->where('payment_method', 'Online Transfer')->sum('grand_total');
            })->with('comment', 10)->addIndexColumn()->escapeColumns([])->make(true);

            return $result;
        } else {
            return view('sale.index', compact('page'));
        }
    }

    public function ViewSaleInfo()
    { 
      
        //  $events=[];
        // $query = SaleItem::latest()->get();
        // foreach ($query as $data)
        //  {
        
        //     if ($data->freezeinfo()->exists()) {
        //         if ($data->freezeinfo) {
        //             if ($data->freezeinfo[0]->freeze_status == "Freeze") {
        //                 $sale = Sale::where('id', $data->sale_id)->first();
                        
        //                 $events[] = [
        //                     'member_id' => $sale->member_id ?? "Walk In Customer",
        //                     'member_name' => $sale->member->member_name ?? "Walk In Customer",
        //                     'pkg_name' => $data->pkg_name,
        //                     'order_id' => $sale->id,
        //                 ];
        //             } else {
                    
        //             }
                    
        //         }
        //     }
        // }
        // $query = collect($events);
        // dd($query);
        return view('sale.sale_info');
    }

    public function ViewSaleInfoAjax(Request $request)
    {
        if ($request->ajax()) {

            // $query = SaleItem::latest()->get();
            // $result = DataTables::of($query)->AddColumn('member_name', function ($row) {
            //     $sub = empty($row->orderinfo->member_id) ?
            //         'Walk in Customer' :
            //         Member::find($row->orderinfo->member_id)->value('member_name');
            //     return $sub;
            // })->AddColumn('pkg_name', function ($row) {
            //     $sub = empty($row->service->service_title) ? 'Not Set' : $row->service->service_title;
            //     return $sub;
            // })->AddColumn('pkg_type', function ($row) {
            //     $sub = empty($row->service->service_type) ? 'Not Set' : $row->service->service_type;
            //     return $sub;
            // })->AddColumn('payment_type', function ($row) {
            //     $sub = empty($row->orderinfo->payment_method) ? 'Not Set' : $row->orderinfo->payment_method;
            //     return $sub;
            // })->addIndexColumn()->make(true);

            // return $result;
            $events=[];
            $query = SaleItem::latest()->get();
            foreach ($query as $data)
             {
                if ($data->freezeinfo()->exists()) {
                    if ($data->freezeinfo) {
                        if ($data->freezeinfo[0]->freeze_status == "Freeze") {
                            $sale = Sale::where('id', $data->sale_id)->first();
                            
                            $events[] = [
                                'member_id' => $sale->member_id ?? "Walk In Customer",
                                'member_name' => $sale->member->member_name ?? "Walk In Customer",
                                'pkg_name' => $data->pkg_name,
                                'order_id' => $sale->id,
                            ];
                        } else {
                        
                        }
                        
                    }
                }
            }
            $query = collect($events);
            $result = DataTables::of($query)->addIndexColumn()->make(true);
             return $result;
        }
    }
    public function Report()
    {

        return view('sale.report');
    }
    public function OldReport()
    {
        return view('sale.old_report');
    }
    public function OldReportAjax(Request $request)
    {

        if ($request->ajax()) {

            $query = DB::table('reports')->select('*')->get();

            $result = DataTables::of($query)->addIndexColumn()->make(true);

            return $result;
        }
    }

    public function SalesSummary()
    {
        return view('sale.sale_report');
        $query = SaleItem::select('services.service_category', DB::raw('sum(subtotal) AS total_sum'))
            ->join('services', 'sale_items.service_id', '=', 'services.id')
            ->groupBy('services.service_category')
            ->orderBy('total_sum', 'desc')
            ->whereDate('sale_items.created_at', Carbon::today())
            ->get();
    }

    public function SalesSummaryAjax(Request $request)
    {
        if ($request->get('from_date') && $request->get('to_date')) {
            $from = Carbon::parse($request->get('from_date'))->format('Y-m-d');
            $to = Carbon::parse($request->get('to_date'))->addDay()->format('Y-m-d');
            $query = SaleItem::select('services.service_category', DB::raw('sum(sale_items.subtotal) AS total_sum,sum(sales.discount) AS total_discount'))
                ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
                ->join('services', 'sale_items.service_id', '=', 'services.id')
                ->groupBy('services.service_category')
                ->orderBy('total_sum', 'desc')
                ->whereBetween('sale_items.created_at', [$from . "%", $to . "%"])
                ->get();
            $sum = Sale::oldest('id')->whereBetween('created_at', [$from . "%", $to . "%"])->get();
        } else {
            $query = SaleItem::select('services.service_category', DB::raw('sum(sale_items.subtotal) AS total_sum,sum(sales.discount) AS total_discount'))
                ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
                ->join('services', 'sale_items.service_id', '=', 'services.id')
                ->groupBy('services.service_category')
                ->orderBy('total_sum', 'desc')
                ->whereDate('sale_items.created_at', Carbon::today())
                ->get();
            $sum = Sale::oldest('id')->whereDate('created_at', Carbon::today())->get();
        }

        $result = DataTables::of($query)->with('cash_callback', function () use ($sum) {
            return $sum->where('payment_method', 'Cash')->sum('grand_total');
        })->with('card_callback', function () use ($sum) {
            return $sum->where('payment_method', 'Credit Card')->sum('grand_total');
        })->with('cheque_callback', function () use ($sum) {
            return $sum->where('payment_method', 'Cheque')->sum('grand_total');
        })->with('online_callback', function () use ($sum) {
            return $sum->where('payment_method', 'Online Transfer')->sum('grand_total');
        })->with('discount_callback', function () use ($sum) {
            return $sum->sum('discount');
        })->escapeColumns([])->make(true);

        return $result;
    }

    public function PaymentInfoView()
    {

        return view('sale.payment_view');
    }
    public function AjaxPaymentInfoView(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('from_date') && $request->get('to_date')) {
                $from = Carbon::parse($request->get('from_date'))->format('Y-m-d');
                $to = Carbon::parse($request->get('to_date'))->addDay()->format('Y-m-d');
                $query = SalePayment::latest('id')->whereBetween('created_at', [$from . "%", $to . "%"])->get();
            } else {
                $query = SalePayment::latest('id')->get();
            }

            $result = DataTables::of($query)->editColumn('created_at', function ($row) {
                return $row->created_at ? with(new Carbon($row->created_at))->format('d-m-Y g:i a') : '';
            })->addColumn('action', function ($row) {
                return view('sale.actionpayment', compact('row'))->render();
            })->addIndexColumn()->make(true);

            return $result;
        }
    }
    public function ReportAjax(Request $request)
    {
        if ($request->get('from_date') && $request->get('to_date')) {
            $from = Carbon::parse($request->get('from_date'))->format('Y-m-d');
            $to = Carbon::parse($request->get('to_date'))->addDay()->format('Y-m-d');
        } else {
            $from = now()->format('Y-m-d');
            $to = now()->addDay()->format('Y-m-d');
        }

        $cash_sale = (int)Sale::where('payment_status', 'Paid')->where('payment_method', 'Cash')->whereBetween('created_at', [$from . "%", $to . "%"])->sum('grand_total');
        $card_sale = (int)Sale::where('payment_status', 'Paid')->where('payment_method', 'Credit Card')->whereBetween('created_at', [$from . "%", $to . "%"])->sum('grand_total');
        $cheque = (int)Sale::where('payment_status', 'Paid')->where('payment_method', 'Cheque')->whereBetween('created_at', [$from . "%", $to . "%"])->sum('grand_total');
        $online = (int)Sale::where('payment_status', 'Paid')->where('payment_method', 'Online Transfer')->whereBetween('created_at', [$from . "%", $to . "%"])->sum('grand_total');


        $cash_expense = (int)Expense::where('status', 'Paid')->where('expense_payment_type', 'Cash')->whereBetween('expense_date', [$from . "%", $to . "%"])->sum('expense_amount');
        $card_expense = (int)Expense::where('status', 'Paid')->where('expense_payment_type', 'Credit Card')->whereBetween('expense_date', [$from . "%", $to . "%"])->sum('expense_amount');
        $cash_sale_partial = (int)SalePayment::where('status', 'Active')->where('payment_type', 'Cash')->whereBetween('created_at', [$from . "%", $to . "%"])->sum('amount');
        $card_sale_partial = (int)SalePayment::where('status', 'Active')->where('payment_type', 'Credit Card')->whereBetween('created_at', [$from . "%", $to . "%"])->sum('amount');

        $data['cash_sale'] = $cash_sale + $cash_sale_partial;
        $data['card_sale'] = $card_sale + $card_sale_partial;
        $data['cheque'] = $cheque;
        $data['online'] = $online;
        $data['total_sale'] =  $data['cash_sale'] + $data['card_sale'] + $data['cheque'] + $data['online'];
        $data['cash_expense'] = $cash_expense;
        $data['card_expense'] = $card_expense;
        $data['total_expense'] =  $data['cash_expense'] + $data['card_expense'];

        $data['cash_revenue'] = $data['cash_sale'] - $data['cash_expense'];
        $data['card_revenue'] = $data['card_sale'] - $data['card_expense'];

        $data['total_revenue'] = $data['cash_revenue'] + $data['card_revenue'] + $data['cheque'] + $data['online'];
        return response(json_encode($data), 200);
    }


    public function AddToCart($id)
    {
        $query = DB::table('services')->select('service_title', 'service_price', 'id', 'service_category', 'service_type')->where('id', $id)->latest()->get()->toArray();
        if ($query[0]->service_category != 'Bar') {
            $data = ['category' => $query[0]->service_category, 'type' => $query[0]->service_type];
        } else {
            $data = ['category' => $query[0]->service_category];
        }
        $a = Cart::instance('product')->content()->toArray();
        $myArray = collect($a);
        $exitid = $myArray->contains('id', $id);
        if (!$exitid) {
            Cart::instance('product')->add($query[0]->id, $query[0]->service_title, 1, $query[0]->service_price, $data);
        }

        return response(json_encode("success"), 200);
    }
    public function RemoveCartItem($id)
    {
        Cart::instance('product')->remove($id);
        return response(json_encode("success"), 200);
    }
    public function UpdateCartItem($id, $value)
    {

        $p_id = Cart::instance('product')->get($id);
        $id_prodcut = $p_id->id;
        $isExist = Service::where('id', $id_prodcut)->where('service_category', 'Bar')->first();
        if ($isExist) {
            Cart::instance('product')->update($id, $value);
        }

        return response(json_encode("success"), 200);
    }

    public function ClearCart()
    {
        Cart::instance('product')->destroy();
        return response(json_encode("success"), 200);
    }

    public function StorePartialAmount(Request $request)
    {
        $this->validate($request, [
            'orderid' => 'required',
            'amount' => 'required',
        ]);
        $b = new SalePayment;
        $b->sale_id = $request->orderid;
        $b->amount = $request->amount;
        $b->payment_type = $request->payment_type;
        $b->cardno = $request->cardno;
        $b->status = 'Active';
        $b->save();
        Sale::find($request->orderid)->decrement('balance', $request->amount);
        return response()->json(['success' => 'Record is successfully added']);


        // return response(json_encode("Done"), 200);
    }
    ///Payment Type Change
    public function UpdateOrder(Request $request)
    {
        $sale = Sale::findorFail($request->order_id);
        $sale->payment_method = $request->payment_type;
        $sale->save();
        session()->flash("success", "Update Successfully");
        return back();
    }

    public function UpdateExpireDate(Request $request)
    {


        $sale = Saleitem::findorFail($request->id);
        $sale->expired_date = $request->expired_date;
        $sale->save();


        if ($request->freeze_check) {
            $this->validate($request, [
                'freeze_status' => 'required',
                'freeze_date' => 'required',
            ]);
            $last_status = FreezeItem::where('sale_item_id', $request->id)->latest('id')->first()->freeze_status ?? "";

            if ($request->freeze_status  !== $last_status) {

                if ($request->freeze_status == "Freeze") {
                    $checkUnfreeze = FreezeItem::where('sale_item_id', $request->id)->where('freeze_status', 'UnFreeze')->latest('id')->first();
                    if ($checkUnfreeze) {
                        $no_of_day_used_service = $checkUnfreeze->created_at->diffInDays($request->freeze_date);
                        $dayleft = FreezeItem::where('sale_item_id', $request->id)->where('freeze_status', 'Freeze')->latest('id')->first();
                        $day = $no_of_day_used_service + 1;
                        $freezeitem = new FreezeItem;
                        $freezeitem->sale_item_id = $request->id;
                        $freezeitem->freeze_status = $request->freeze_status;
                        $freezeitem->days_used = $day;
                        $freezeitem->days_left = $dayleft->days_left - $day;
                        $freezeitem->created_at = Carbon::createFromFormat('Y-m-d', $request->freeze_date)->toDateTimeString();
                        $freezeitem->save();
                    } else {

                        $no_of_day_used_service = $sale->created_at->diffInDays($request->freeze_date);
                        $day = (int)$sale->service->service_duration - $no_of_day_used_service;
                        $left_day = $day - 1;
                        $freezeitem = new FreezeItem;
                        $freezeitem->sale_item_id = $request->id;
                        $freezeitem->freeze_status = $request->freeze_status;
                        $freezeitem->days_used = $no_of_day_used_service + 1;
                        $freezeitem->days_left = $left_day;
                        $freezeitem->created_at = Carbon::createFromFormat('Y-m-d', $request->freeze_date)->toDateTimeString();
                        $freezeitem->save();
                    }
                }

                if ($request->freeze_status == "Unfreeze") {

                    $checkUnfreeze = FreezeItem::where('sale_item_id', $request->id)->where('freeze_status', 'Freeze')->latest('id')->first();
                    if ($checkUnfreeze->days_left <= 0) {
                        session()->flash("error", "Your Package is Complete.Can't Unfreeze");
                        return back();
                    }
                    if ($checkUnfreeze) {

                        $expire_date = Carbon::parse($request->freeze_date)->addDays($checkUnfreeze->days_left)->format('Y-m-d');
                        $sale->expired_date = $expire_date;
                        $sale->save();
                        $freezeitem = new FreezeItem;
                        $freezeitem->sale_item_id = $request->id;
                        $freezeitem->freeze_status = $request->freeze_status;
                        $freezeitem->created_at = Carbon::createFromFormat('Y-m-d', $request->freeze_date)->toDateTimeString();
                        $freezeitem->save();
                    } else {
                        $dayleft = FreezeItem::where('sale_item_id', $request->id)->where('freeze_status', 'Freeze')->latest('id')->first()->days_left;

                        $expire_date = Carbon::parse($request->expired_date)->addDays($dayleft)->format('Y-m-d');
                        $sale->expired_date = $expire_date;
                        $sale->save();
                        $freezeitem = new FreezeItem;
                        $freezeitem->sale_item_id = $request->id;
                        $freezeitem->freeze_status = $request->freeze_status;
                        $freezeitem->created_at = Carbon::createFromFormat('Y-m-d', $request->freeze_date)->toDateTimeString();
                        $freezeitem->save();
                    }
                }
            } else {
                session()->flash("error", "Already Saved");
                return back();
            }
        }
        session()->flash("success", "Update Successfully");
        return back();
    }

    public function RecentService($id)
    {
        try {

            $service_sale = Sale::where('member_id', $id)->where('status', 'Active')->pluck('id')->toArray();

            $query = SaleItem::whereIn('sale_id', $service_sale)->latest()->get();
            foreach ($query as $key => $data) {
                $flag[$key]['pkg_name'] = $data->pkg_name;
                $flag[$key]['subtotal'] = "Price : " . $data->subtotal;
                $flag[$key]['date'] = "Date : " . Carbon::parse($data->created_at)->format('Y-m-d');
                if ($data->expired_date) {
                    $flag[$key]['expire_date'] = "Expire Date : " . $data->expired_date;
                } else {
                    $flag[$key]['expire_date'] = "";
                }

                if ($data->freezeinfo) {
                    $freeze = $data->freezeinfo[0]->freeze_status ?? "";
                    // $flag[$key]['freeze'] = $data->freezeinfo->freeze_status;

                    $flag[$key]['freeze'] = ($freeze == "Freeze") ? "Freeze" : "";
                } else {
                    $flag[$key]['freeze'] = "";
                }
            }

            return response(json_encode($flag), 200);
        } catch (\Exception $ex) {
            return response(json_encode("error"), 200);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // $created_at=Carbon::parse($request->created_at)->addHour(now()->format('h'))->toDateTimeString();


        if (Cart::instance('product')->count() == 0) {
            session()->flash("error", "Cart is Empty");
            return back();
        }
        try {
            DB::beginTransaction();

            $sale = new Sale();
            $sale->member_id = $request->member_id;
            $sale->branch_user = admin_name();
            $sale->subtotal = Cart::instance('product')->subtotal();
            $sale->tax = 0;
            if ($request->payment_status == "Partial Pay" && $request->discount) {
                $sale->discount = $request->discount;
                $sale->partial_payment = $request->partial_payment;
                $sale->grand_total = Cart::instance('product')->subtotal() - $request->discount;
                $sale->balance = Cart::instance('product')->subtotal() - $request->partial_payment - $request->discount;
            } else if ($request->discount && $request->partial_payment == null) {
                $sale->discount = $request->discount;
                $sale->grand_total = Cart::instance('product')->subtotal() - $request->discount;
            } else if ($request->payment_status == "Partial Pay" && $request->discount == null) {
                $sale->partial_payment = $request->partial_payment;
                // $sale->grand_total = $request->partial_payment;
                $sale->grand_total = Cart::instance('product')->subtotal();
                $sale->balance = Cart::instance('product')->subtotal() - $request->partial_payment;
            } else {
                $sale->grand_total = Cart::instance('product')->subtotal();
            }

            $sale->payment_method = $request->payment_method;
            $sale->payment_status = $request->payment_status;
            $sale->card_no = $request->card_no;

            $sale->notes = $request->notes;
            $sale->status = "Active";
            $sale->created_at = $request->created_at;
           // $sale->created_at = Carbon::createFromFormat('Y-m-d', $request->created_at)->toDateTimeString();
            $sale->save();

            $sale_id = $sale->id;
            if ($request->payment_status == "Partial Pay") {
                $b = new SalePayment;
                $b->sale_id = $sale_id;
                $b->amount = $request->partial_payment;
                $b->payment_type = $request->payment_method;;
                $b->cardno = $request->card_no;
                $b->status = 'Active';
                // $b->created_at = Carbon::createFromFormat('Y-m-d', $request->created_at)->toDateTimeString();
                $b->save();
            }
            foreach (Cart::instance('product')->content() as $item) {
                if ($data = Service::where('id', $item->id)->where('service_type', 'Monthly')->where('service_category', '<>', 'Bar')->first()) {
                    $date = Carbon::createFromFormat('Y-m-d', $request->created_at);
                    $expire_date = $date->addDays($data->service_duration)->format('Y-m-d H:i:s');
                    // $expire_date = now()->addDays($data->service_duration)->format('Y-m-d H:i:s');
                } else {
                    $expire_date = null;
                    // object not found
                }
                $create = SaleItem::create([
                    'sale_id' => $sale_id,
                    'service_id' => $item->id,
                    'pkg_name' => $this->Service_name($item->id),
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'expired_date' => $expire_date,
                    'subtotal' => $item->subtotal,
                    'status' => 'Active',
                    // 'created_at' => Carbon::createFromFormat('Y-m-d', $request->created_at)->toDateTimeString(),

                ]);
            }
            DB::commit();
            Cart::instance('product')->destroy();

            session()->flash("success", "Order Added Successfully");
            return redirect()->route('print.invoice', ['id' => $sale_id]);
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash("error", "try again some thing went Wrong");
            return back();
        }
    }

    public function PrintInvoice($id)
    {
        $saleinfo = Sale::where('id', $id)->firstOrFail();
        $productinfo = SaleItem::where('sale_id', $id)->get();
        $logo = DB::table('settings')->where('id', 5)->value('description');
        $header = $this->Header();
        $footer = $this->Footer();


        return view('sale.invoice', compact('saleinfo', 'productinfo', 'logo', 'header', 'footer'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $saleitem = SaleItem::where('sale_id', $sale->id)->get();
        return view('sale.show', compact('sale', 'saleitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $sale->date = Carbon::parse($sale->created_at)->format('Y-m-d');
        return response(json_encode($sale), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $validatedata = $this->validate($request, [
            'member_id' => 'required',
            'subtotal' => 'required',
            'discount' => 'nullable',
            'grand_total' => 'required',
            'payment_method' => 'required',
            'branch_user' => 'required',
        ]);
        $created_at = Carbon::parse($request->date)->addHour(now()->format('h'))->toDateTimeString();
        $validatedata['created_at'] = $created_at;
        $status = $sale->update($validatedata);
        SaleItem::where('sale_id', $sale->id)->update(['created_at' => $created_at]);
        if ($status) {
            session()->flash("success", "Order Update Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function InvoiceSetting()
    {
        $data =  Setting::where('id', 4)->value('description');
        return explode('$', $data);
    }
    public function Header()
    {
        $data =  Setting::where('id', 4)->value('description');
        return $data;
    }
    public function Footer()
    {
        $data =  Setting::where('id', 4)->value('description2');
        return $data;
    }
    public function Diseases()
    {
        $data =  Setting::where('id', 1)->value('description2');
        return explode(',', $data);
    }
    public function Members()
    {
        return  Member::select('id', 'member_name', 'member_mobile', 'member_no')->latest()->get();
    }

    public function FackerData()
    {
        // if ($request->ajax()) {
        //     $query = Sale::latest('id')->get();
        //     $result = DataTables::of($query)->editColumn('member_id', function ($row) {
        //         $cat = empty($row->member->member_name) ? 'Walk-in Customer' : $row->member->member_name;
        //         return $cat;
        //     })->editColumn('created_at', function ($row) {
        //         return $row->created_at ? with(new Carbon($row->created_at))->format('d-m-Y g:i a') : '';

        //     })->addColumn('action', function ($row) {
        //         return view('sale.action', compact('row'))->render();
        //     })->addIndexColumn()->make(true);

        //     return $result;
        // } else {
        //     return view('sale.postest');
        // }

        //
        // $faker = Faker::create();
        // foreach (range(1, 50) as $index) {
        //     DB::table('services')->insert([
        //         'service_title' => $faker->name,
        //         'service_price' => $faker->numberBetween($min = 1000, $max = 9000),
        //         'service_category' => $faker->randomElement($array = array ('Daily','Monthly')),
        //         'service_type' => $faker->randomElement($array = array ('Daily','Monthly')),
        //         'service_duration' => $faker->randomElement($array = array ('20','30','40')),
        //         'service_icon' => null,
        //         'service_description' => $faker->sentence(5),
        //         'status' => 'Active',


        //     ]);
        // }
        // dd("done");
        // $data = Service::latest()->get();
        // switch (true) {
        //     case $request->partial_payment && $request->discount:
        //         // do something 
        //         dd("Both REsqust");
        //         break;
        //     case $request->discount:
        //         dd("discount request");
        //         // do something
        //         break;
        //     case $request->partial_payment:
        //         dd("partissal request");
        //         // do something else
        //         break;

        //     default:
        //         dd("here is the default");
        // }
    }
    public function Category()
    {
        $data =  Setting::where('id', 2)->where('title', 'service')->value('description');
        return explode(',', $data);
    }

    public function Service_name($id)
    {
        return Service::where('id', $id)->value('service_title');
    }

    public function DbupdateData()
    {
        $service_ids = SaleItem::select('service_id')->distinct()->pluck('service_id')->all();
        foreach ($service_ids as $data) {
            SaleItem::where('service_id', $data)
                ->update(['pkg_name' => $this->Service_name($data)]);
        }
    }

    public function QueryRun(){
        $blogs = DB::table("old_members")->whereNotNull('member_no')->get();
        $i=0;
        foreach($blogs as $data){
            
            $check = DB::table("members")->where('member_no',$data->member_no)->exists();
           
            if(!$check){
                DB::table('members')->insert([
                    'member_no' => $data->member_no,
                    'member_name' => $data->member_name,
                    'member_mobile' => $data->member_telephone,
                    'member_fathername' => $data->member_father_name,
                    'member_dob' => $data->member_dob,
                    'member_nic' => $data->member_nic,
                    'member_gender' => $data->member_gender,
                    'member_category' =>'Monthly',
                    'member_email' => $data->member_email,
                    'member_residence' => $data->member_resident,
                    'member_address' => $data->member_address,
                    'member_emergencyno' => $data->member_emergency_no,
                    'status' => 'Active',
                ]);
            }
     
            $i++;
        }
            
        dd("done".$i);
    }
}

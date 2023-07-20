<?php

namespace App\Http\Controllers;
use App\Models\{Sale,Member,Service};

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
     
       $monthly_bar=$this->MonthlyBar();
       $member_query = Member::query();
       $member = $member_query->clone()->count();
       $male = $member_query->clone()->where('member_gender','Male')->count();
       $female = $member_query->clone()->where('member_gender','Female')->count();
       $daily = $member_query->clone()->where('member_category','Daily')->count();
       $monthly = $member_query->clone()->where('member_category','Monthly')->count();
       $query = Service::query();
       $service=$query->clone()->where('service_category','<>','Bar')->count();
       $bar=$query->clone()->where('service_category','Bar')->count();          
        return view('AdminDashboard.dashboad',compact('monthly_bar','member','male','female','daily','service','monthly','bar'));
    }

    public function MonthlyBar()
    {
        $months = Sale::select(DB::raw("Month(created_at) as month"))
            ->where('status', 'Active')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $user = Sale::select(DB::raw("SUM(grand_total) as count"))
            ->where('status', 'Active')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $monthly_sale = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($months as $index => $months) {
            $monthly_sale[$months - 1] = $user[$index];
        }
        return $monthly_sale;
    }
}

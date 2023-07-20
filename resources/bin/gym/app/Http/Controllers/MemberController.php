<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Report;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MemberController extends Controller
{
   
    public function index($page=null,Request $request)
    {
       // $query = Member::where('status', 'Active')->with('order_info.saleinfo')->where('member_no',2426)->latest()->get();
        //dd($query[0]->order_info[0]->saleinfo[0]->expired_date);
        if ($request->ajax()) {
            if($request->get('page')=="daily_members"){
             $category=['Daily'];
            }else if($request->get('page')=="monthly_members"){
                $category=['Monthly'];
            }else{
                $category=['Daily','Monthly'];
            }
            $query = Member::where('status', 'Active')->with('order_info.saleinfo')->whereIn('member_category',$category)->get();
            $result = DataTables::of($query)->addColumn('action', function ($row) {
                return view('member.action', compact('row'))->render();
            })
            ->addColumn('expiry', function ($row) {
                    $date = $row->order_info[0]->saleinfo[0]->expired_date ?? '';
                    if($date)
                    {
                        $date =  Carbon::parse($date)->format('d-m-Y');
                    }
                    return $date;                               
            })
            ->addIndexColumn()
            ->make(true);
            return $result;
        } else {
            $diseases = $this->Diseases();
            return view('member.index',compact('page','diseases'));
        }
    }

  
    public function create()
    {
        $diseases=$this->Diseases();   
        return view('member.create',compact('diseases'));
    }

    public function store(Request $request)
    {
        $validatedata = $this->validate($request, Member::VALIDATION_RULES);
        if ($request->member_image) {
            $file = $request->file('member_image');
            $imageName = time() . "member." . $file->extension();
            $file->move(public_path('images'), $imageName);
            $validatedata['member_image'] = $imageName;
        }
        if ($request->member_diseases) {
            $validatedata['member_diseases'] = implode(",", $request->member_diseases);
        }

        $validatedata['member_registerby'] = null;
        $validatedata['status'] = "Active";
        $status = Member::create($validatedata);
        if ($status) {
            session()->flash("success", "Member Added Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
        //
    }

    public function show(Member $member)
    {   
        $member = Member::with('order_info.saleinfo')->where('id',$member->id)->firstOrFail();
        $diseases=$this->Diseases();
        $reports= ($member->member_no) ? $this->OldReport($member->member_no) :  null;
        return view('member.show', compact('member','diseases','reports'));
        //
    }


    public function edit(Member $member)
    {
        $data =  Setting::where('id',1)->value('description2');
        $diseases=explode(',',$data);
        return view('member.edit', compact('member','diseases'));
    }


    public function update(Request $request, Member $member)
    {
        $validatedata = $this->validate($request, Member::VALIDATION_RULES);
        if ($request->member_image) {
            $file = $request->file('member_image');
            $imageName = time() . "member." . $file->extension();
            $file->move(public_path('images'), $imageName);
            $validatedata['member_image'] = $imageName;
        }

        if ($request->member_diseases) {
            $validatedata['member_diseases'] = implode(",", $request->member_diseases);
        } else {
            $validatedata['member_diseases'] = null;
        }

        $validatedata['member_registerby'] = null;
        $validatedata['status'] = "Active";

        $status = $member->update($validatedata);
        //
        if ($status) {
            session()->flash("success", "Member Added Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
    }

    public function destroy(Member $member)
    {

        if ($member->member_image) {
            $image_path = public_path('images') . '/' . $member->member_image;
            if ($member->member_image && File::exists($image_path)) {

                unlink($image_path);
            }
        }
        if ($member->delete()) {
            session()->flash("success", "Member Deleted Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();


        //
    }

    public function Diseases(){
        $data =  Setting::where('id',1)->value('description2');
        return explode(',',$data);
    }

    public function OldReport($membership_no){
      
         return Report::Where('membership_no',$membership_no)->orderBy('fee_date','desc')->get();
    }
    
}

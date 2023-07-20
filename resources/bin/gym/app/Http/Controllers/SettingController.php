<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Setting::select('*')->get();
        $member =  Setting::where('id', 1)->value('description');
        $member_diseases =  Setting::where('id', 1)->value('description2');
        $service =  Setting::where('id', 2)->value('description');
        $expense =  Setting::where('id', 3)->value('description');
        $invoice =  Setting::where('id', 4)->value('description');
        $logo =  Setting::where('id', 5)->value('description');
        $cover =  Setting::where('id', 5)->value('description2');
        $header =  Setting::where('id', 4)->value('description');
        $footer =  Setting::where('id', 4)->value('description2');
        $user =  User::select('*')->get();



        //
        return view('setting.index', compact('data', 'member', 'service', 'expense', 'member_diseases', 'invoice', 'logo', 'cover', 'header', 'footer', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->member && $request->btn_member) {
            if ($request->member_diseases) {
                Setting::where('id', 1)->where('status', 'Active')->where('title', 'member')->update(['description2' => $request->member_diseases]);
            }
            Setting::where('id', 1)->where('status', 'Active')->where('title', 'member')->update(['description' => $request->member]);
        }
        if ($request->service && $request->btn_service) {
            Setting::where('id', 2)->where('status', 'Active')->where('title', 'service')->update(['description' => $request->service]);
        }
        if ($request->expense && $request->btn_expense) {
            Setting::where('id', 3)->where('status', 'Active')->where('title', 'expense')->update(['description' => $request->expense]);
        }
        if ($request->btn_logo) {
            Setting::where('id', 4)->where('status', 'Active')->where('title', 'invoice')->update(['description' => $request->header, 'description2' => $request->footer]);
        }
        if ($request->btn_logo_img) {
            if ($request->logo && $request->file('logo')) {
                $file = $request->file('logo');
                $imageName = time() . "logo." . $file->extension();
                $file->move(public_path('d_img'), $imageName);
                Setting::where('id', 5)->where('status', 'Active')->where('title', 'logo')->update(['description' => $imageName]);
            }
            if ($request->cover && $request->file('cover')) {
                $file = $request->file('cover');
                $imageName = time() . "cover." . $file->extension();
                $file->move(public_path('d_img'), $imageName);
                Setting::where('id', 5)->where('status', 'Active')->where('title', 'logo')->update(['description2' => $imageName]);
            }
        }
        return back();
        //
    }

    public function StoreUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'role' => 'required',
        ]);
    
        $emp = new User();
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->role = $request->role;
        $emp->password = Hash::make($request->phone);
        $emp->save();
        session()->flash("success", "User Added Successfully");
        return back();
    }
    public function UpdateProfile(Request $request)
    {
        $isExist =  User::findOrFail($request->id);


        if (Hash::check($request->current_pass, $isExist->password)) {
            if ($request->new_pass && $request->cnfrm_pass) {
                $isExist->password = Hash::make($request->new_pass);
                $isExist->save();
                session()->flush();
                session()->flash("success", "Password Update Successfully.log_in with  new password");

                return redirect('/');
            }
        } else {
            session()->flash("error", "User Current Password Not matched");
            return back();
        }
    }
    public function DestroyUser($id)
    {
        User::findOrFail($id)->delete();
        session()->flash("success", "User Deleted Successfully");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}

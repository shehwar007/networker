<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            if($request->get('category')){
                $query = Service::latest('id')->where('service_category',$request->get('category'))->get();
            }else{
                $query = Service::latest('id')->get();
            }
            
          
            $result = DataTables::of($query)->addColumn('action', function ($row) {
                return view('service.action', compact('row'))->render();
            })->addIndexColumn()->make(true);

            return $result;
        } else {
            return view('service.index');
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
       $category= $this->Category();
        return view('service.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedata = $this->validate($request, Service::VALIDATION_RULES);
        if ($request->service_icon) {
            $file = $request->file('service_icon');
            $imageName = time() . "member." . $file->extension();
            $file->move(public_path('images'), $imageName);
            $validatedata['service_icon'] = $imageName;
        }

        $status = Service::create($validatedata);
        if ($status) {
            session()->flash("success", "Service Added Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
        $category= $this->Category();
        return view('service.show', compact('service','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
        $category= $this->Category();
        return view('service.edit', compact('service','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        $validatedata = $this->validate($request, Service::VALIDATION_RULES);
        if ($request->service_icon) {
            $file = $request->file('service_icon');
            $imageName = time() . "member." . $file->extension();
            $file->move(public_path('images'), $imageName);
            $validatedata['service_icon'] = $imageName;
        }
        $status = $service->update($validatedata);
        if ($status) {
            session()->flash("success", "Service Update Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        if ($service->service_icon) {
            $image_path = public_path('images') . '/' . $service->service_icon;
            if ($service->service_icon && File::exists($image_path)) {

                unlink($image_path);
            }
        }
        if ($service->delete()) {
            session()->flash("success", "Service Deleted Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
    }

    public function Category(){
        $data =  Setting::where('id',2)->where('title','service')->value('description');
        return explode(',',$data);
    }
}

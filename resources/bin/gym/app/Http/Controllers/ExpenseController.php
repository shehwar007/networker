<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;
use Illuminate\Support\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $query = Expense::latest()->get();
            $result = DataTables::of($query)->addColumn('action', function ($row) {
                return view('expense.action', compact('row'))->render();
            })->addIndexColumn()->make(true);

            return $result;
        } else {
            return view('expense.index');
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
        $category=$this->Category();
       
        return view('expense.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedata = $this->validate($request, Expense::VALIDATION_RULES);

        if ($request->expense_attachment) {
            $file = $request->file('expense_attachment');
            $imageName = time() . "expense." . $file->extension();
            $file->move(public_path('images'), $imageName);
            $validatedata['expense_attachment'] = $imageName;
        }
        $status = Expense::create($validatedata);
        if ($status) {
            session()->flash("success", "Expense Added Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
        $category=$this->Category();
        return view('expense.show', compact('expense','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $category=$this->Category();
        return view('expense.edit', compact('expense','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $validatedata = $this->validate($request, Expense::VALIDATION_RULES);

        if ($request->expense_attachment) {
            $file = $request->file('expense_attachment');
            $imageName = time() . "expense." . $file->extension();
            $file->move(public_path('images'), $imageName);
            $validatedata['expense_attachment'] = $imageName;
        }
        $status = $expense->update($validatedata);
        if ($status) {
            session()->flash("success", "Expense Update Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        if ($expense->expense_attachment) {
            $image_path = public_path('images') . '/' . $expense->expense_attachment;
            if ($expense->expense_attachment && File::exists($image_path)) {

                unlink($image_path);
            }
        }
        if ($expense->delete()) {
            session()->flash("success", "Expense Deleted Successfully");
        } else {
            session()->flash("error", "Some thing went Wrong");
        }
        return back();
    }

    public function Category()
    {
        $data =  Setting::where('id', 3)->where('title', 'expense')->value('description');
       
        return explode(',', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
    
        $this->middleware('AdminCheck');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::select('*')->get();
        $role = DB::table('user_roles')->select('id', 'role')->get();

        return view('user', compact('user', 'role'));
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
      

        try {
            $data = $request->only('name', 'email', 'password', 'user_role_id', 'status');
            $data['password'] = Hash::make($request->password);

            User::create($data);
          
            session()->flash("alert-message", "Great! User Added Successfully");
            session()->flash("alert", "success");
        } catch (\Exception $ex) {

            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        try {
            $data = $request->only('name', 'email', 'password', 'user_role_id', 'status');
            if($request->password){
                $data['password'] = Hash::make($request->password);
            }
           
            $user->update($data);
            session()->flash("alert-message", "Great! User Update Successfully");
            session()->flash("alert", "success");
        } catch (\Exception $ex) {

            session()->flash("alert-message", "Oh snap! Some thing went Wrong");
            session()->flash("alert", "danger");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

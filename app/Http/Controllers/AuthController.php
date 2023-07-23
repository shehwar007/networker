<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(session()->has('adminData')){
        return redirect('dashboard');
        }
        return view('login');
    }

    public function validateCredentials(Request $request)
    {
       
        $this->validate($request,[
            'email'=>'email|required',
            'password'=>'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $isExist = User::where('email',$email)
                            ->where('status','=',1)
                            ->first();
                       
        if($isExist)
        {
            if (Hash::check($password, $isExist->password)) {
                $session_data['name'] = $isExist->name;            
                $session_data['role'] = $isExist->user_role_id;
                $session_data['id'] = $isExist->id; 
                $session_data['email'] = $isExist->email; 
                session()->put('adminData',$session_data);
                return redirect('dashboard');
            }else{
                session()->flash('message', '<strong>Oh Snap!</strong> Wrong Password!');
                session()->flash('message_class', 'danger');
                return redirect('/');
            }
        }else
        {
            session()->flash('message', 'Wrong <strong>Email Address</strong> or your account is not <strong>Active</strong>!');
            session()->flash('message_class', 'danger');
            return redirect('/');
        } 
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
    }

 
}

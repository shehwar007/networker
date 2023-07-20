<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('AdminDashboard.Auth.login');
    }
    public function validateCredentials(Request $request)
    {

        $this->validate($request, [
            'admin_username' => 'required',
            'admin_password' => 'required',
        ]);
        // return redirect()->route('home');
        $email = $request->admin_username;
        $password = $request->admin_password;
        $isExist = User::where('email', $email)->first();

        if ($isExist) {
            if (Hash::check($password, $isExist->password)) {

                $session_data['admin_name'] = $isExist->name;
                $session_data['admin_email'] = $isExist->email;             
                $session_data['admin_role'] = $isExist->role;
                $session_data['admin_id'] = $isExist->id;
                $session_data['admin_phone'] = $isExist->phone;  
                session()->put('AdminData', $session_data);
                return redirect()->route('home');
            } else {
                session()->flash('message', '<strong>Oh Snap!</strong> Wrong Password!');
                session()->flash('message_class', 'danger');
                return redirect('/');
            }
        } else {
            session()->flash('message', 'Wrong <strong>Email Address</strong> or your account is not <strong>Active</strong>!');
            session()->flash('message_class', 'danger');
            return redirect('/');
        }
    }
}

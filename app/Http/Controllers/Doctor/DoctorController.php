<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:doctors,email',
            'password' => 'required|min:6'
        ],[
            'email.exists' => 'This email is not exists on doctors table'
        ]);

        $creds = $request->only('email','password');
        if(Auth::guard('doctor')->attempt($creds)){
            return redirect()->route('doctor.home');
        }else{
            return redirect()->back()->with('error','Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function signup()
    {
        return view('signup');
    }

    public function storeUser(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'username' => 'required|min:3|max:50|string',
            'email' => 'email',
            'password' => 'required|confirmed|min:6'
        ]);        
        $requestData = $request->except(['_token']);
        $requestData['password'] = Hash::make($request->password);
        $user = User :: create($requestData);
        return redirect()->route('home')->with('success', 'User Created Successfully.');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('username', 'password');
        // dd($credentials);
        // exit;
        if (Auth::attempt($credentials)) {
            // $user = auth()->user();
            // dd($user);
            return redirect('dashboard')->with('success', 'Login Successfully.');
        } else {
            return redirect('/')->with('fail', 'Invalid Credentials. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}

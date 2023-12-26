<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    function showLoginForm(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('auth.login');
    }

    function showRegistrationForm(){
        if (Auth::check()){
            return redirect(route('auth.register'));
        }
        return view('auth.register');
    }

    function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = auth()->user();

            if ($user->role === "admin") {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('user.dashboard');
            }

        } else {
            return redirect(route('login'))->with("error", "Invalid email/password");
        }
    }

    function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nim' => 'required|unique:users',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['nim'] = $request->nim;
        $data['role'] = $request->role;
        $user = User::create($data);

        if(!$user){
            return redirect(route('registration'))->with("error", "Registration failed, try again.");
        }
        return redirect(route("login"))->with("success", "Registration completed.");

    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}

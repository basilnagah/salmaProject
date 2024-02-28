<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function registerForm()
    {
        return view('Auth.register');
    }

    function register(Request $request)
    {
        //validate

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email|max:100',
            'password' => 'required|confirmed|min:6',
        ]);

        //password

        $data['password'] = bcrypt($data['password']);

        //create

        $user = User::create($data);
        Auth::login($user);
        //redirect
        $request->session()->put('user',$user);
        $products = product::all();
        return view('user.allProducts', compact('products'));
    }

    function loginForm()
    {
        return view('Auth.login');
    }

    function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:100',
        ]);

        $is_auth = Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        $user = User::where(['email'=>$request->email])->first();

        if (!$is_auth) {
            return redirect(url('login'))->withErrors('email or password may be incorrect');
        } else {
            $request->session()->put('user',$user);
            if (Auth::user()->email == 'habibamhmd49@gmail.com') {
                $products = product::all();
                return redirect('adminProfile')->with('products',$products);
            } else {
                $products = product::all();
                $request->session()->forget('message');
                return redirect('userProducts')->with('products',$products);
            }
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user');
        return redirect(url('login'));
    }

    function allUsers()
    {
        dd(User::all());
    }
}

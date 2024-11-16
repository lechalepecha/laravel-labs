<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        session()->flash('success', 'Вы успещно зарегестрировались');
        Auth::login($user);

        return redirect()->home();
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            session()->flash('success', 'Вы успещно авторизовались');
            if(Auth::user()->is_admin)
            {
                return redirect()->route('admin.index');
            }
            else
            {
                return redirect()->home();
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Неправильный логин или пароль');
        }
        dd($request->all());
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }


}

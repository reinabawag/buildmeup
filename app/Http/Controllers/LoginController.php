<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login2');
    }

    public function authenticate(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::where('email', $request->email)->first();

            switch ($user->status) {
                case 'pending':
                    return redirect()->back()->withErrors(['email' => "Your account status is pending for approval"])->withInput();
                    break;
                case 'denied':
                    return redirect()->back()->withErrors(['email' => "Your account was denied"])->withInput();
                    break;
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'approved'])) {
                return redirect()->intended('home');
            }

            return redirect()->back()->withErrors(['email' => "Invalid email or password!"])->withInput();
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password_confirmation);

        if ($user->save()) {
            $user->roles()->attach(Role::where('type', 'creator')->first());            
            Mail::to('re.abawag_mis@amwire.com.ph')->send(new AccountCreated(User::find($user->id)));
            Auth::logout();
            return redirect('/login')->withMessage('User account is now waiting for approval');
        }
    }
}

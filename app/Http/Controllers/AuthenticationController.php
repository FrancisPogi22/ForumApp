<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function login(Request $request)
    {
        if (auth()->attempt($request->only('email', 'password'))) return $this->checkUserAccount();

        return back()->withInput()->with('warning', 'Incorrect User Credentials.');
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'Cpassword' => 'required|same:password'
        ]);

        if ($validation->fails()) return back()->withInput()->with(['status' => 'warning', 'message' => implode('<br>', $validation->errors()->all())]);

        if ($request->password == $request->Cpassword) {
            $this->user->create([
                'username' => trim($request->username),
                'email' => trim($request->email),
                'name' => trim($request->name),
                'password' => Hash::make(trim($request->password))
            ]);


            return back()->with('success', 'Successfully registered.');
        } else
            return back()->with('warning', "Confirm password doesn't match.");
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect('/')->with('success', 'Successfully Logged out.');
    }

    private function checkUserAccount()
    {
        if (!auth()->check()) return back();

        $userAuthenticated = auth()->user();

        return redirect("/dashboard")->with('success', "Welcome $userAuthenticated->username.");
    }
}

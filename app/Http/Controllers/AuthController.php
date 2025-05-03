<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate input
        $request = request();
        if(User::where('email',$request->email)->exists()){
           return back()->with('fail','Email already registered');
        }

        if($request->password != $request->cpassword){
            return back()->with('fail','Passwords do not match');
        }

      

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

 

        // Redireclogin
        return redirect()->route('login');
    }

    public function login(Request $request)
    {   
   
        // Validate input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectToDashboard(Auth::user());
        }

        return back()->with('fail', 'Invalid credentials');
    }

    protected function redirectToDashboard(User $user)
    {
        if ($user->role === 'employer') {
           return redirect()->route('employer.dashboard');
        }

       // return redirect()->route('jobseeker.dashboard');
    }
}

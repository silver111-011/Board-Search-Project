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
            'is_blocked'     => 0,
            'password' => Hash::make($request->password),
        ]);

 

        // Redireclogin
        return redirect()->route('login');
    }

    public function login($jobid = null)
    {   
          $request = request();
        // Validate input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
       
        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectToDashboard(Auth::user(),$jobid);
        }

        return back()->with('fail', 'Invalid credentials');
    }

    protected function redirectToDashboard(User $user, $id = null)
    {
        if ($user->role === 'employer') {
           return redirect()->route('employer.dashboard');
        }
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
         }
         
         if($id == null){
            return redirect()->route('jobseeker.dashboard');
         }else{
            return redirect()->route('jobseeker.applicationForm',$id);
         }
       
    }
}

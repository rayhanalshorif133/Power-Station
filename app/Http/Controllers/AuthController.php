<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function userLoginView()
    {
        return view('auth.login');
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where('email', $request->email)->first();


        if ($user) {

            if($user->status == 'deactive'){
                return $this->respondWithErrorWeb('Your account is deactive. Please contact to admin.',null,'red');
            }
            if($user->status == 'pending'){
                return $this->respondWithErrorWeb('Your account is pending, please contact to admin', null, 'sky');
            }
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $role = Auth::user()->roles[0]->name;
                if ($role == 'user') {
                    return $this->respondWithSuccessWeb('Login Successfully', redirect()->route('user.home'),'green');
                } else {
                    return $this->respondWithSuccessWeb('Login Successfully', redirect()->route('user.dashboard'));
                }
            } else {
                return $this->respondWithErrorWeb('Invalid credentials',null, 'red');
            }
        } else {
            return $this->respondWithErrorWeb('User not found',null, 'red');
        }
    }

    function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors());
        }
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('admin');
            $token = $user->createToken('MyApp')->accessToken;
            return redirect('/home')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }


    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Exception;

class AuthController extends Controller
{
    public function userLogin(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:13',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->respondWithError("Phone or Password is not valid", [], 203);
        }

        $user = User::where('phone', $request->phone)->first();

        // Validator errors
        if (!$user) {
            return $this->respondWithError('User not found');
        }
        if ($user->status == 'inactive') {
            return $this->respondWithError('User is not active');
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken("app-token");
            Auth::login($user);
            $data = [
                'token' => $token->plainTextToken,
                'user' => $user
            ];
            return $this->respondWithSuccess('Login successfully', $data);
        } else {
            return $this->respondWithError('Password is incorrect');
        }
    }

    public function fetchRoles()
    {
        $roles = Role::select('id', 'name')
        ->orderBy('id', 'asc')
        ->get();
        return $this->respondWithSuccess('Roles fetched successfully', $roles);
    }

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:10|unique:users',
            'role' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->respondWithError("Email or phone is not valid or already taken and role is required");
        }
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'designation' => $request->designation,
            ]);
            $user->assignRole($request->role);
            return $this->respondWithSuccess('User has been successfully registered', $user);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function userInfo($id = null){

        if($id == null){
            $users = User::select()->with('roles')->get();
        }else{
            $users = User::select()->where('id', $id)->with('roles')->get();
        }
        foreach ($users as $user) {
            $user->role = $user->roles[0]->name;
            $user->department = departmentByUserID($user->id);
            $user->profile_picture_url = $user->image ? $user->image : asset('images/default_profile.png');
            $user->approvedIssue = $user->getApprovedOrRejectedIssue($user->id,'accepted');
            $user->deniedIssue = $user->getApprovedOrRejectedIssue($user->id,'rejected');
            $user->notcheckedIssue = $user->getNotcheckedIssue($user->id);
            unset($user["roles"]);
            unset($user["created_at"]);
            unset($user["updated_at"]);
            unset($user["image"]);
        }
        return $this->respondWithSuccess('Users info fetched successfully', $users);
    }
    public function authUserInfo(){
        $user = Auth::user();
        $user->department = departmentByUserID($user->id);
        $user->profile_picture_url = $user->image ? $user->image : asset('images/default_profile.png');
        $user->approvedIssue = $user->getApprovedOrRejectedIssue($user->id,'accepted');
        $user->deniedIssue = $user->getApprovedOrRejectedIssue($user->id,'rejected');
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['image']);
        return $this->respondWithSuccess('User info fetched successfully', $user);
    }
}

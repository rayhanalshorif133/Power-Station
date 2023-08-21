<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Exception;


class UserController extends Controller
{
    public function fetchUsers()
    {
        $users = User::all();
        foreach ($users as $user){
            $user->departments = departmentByUserID($user->id);
        }
        return $this->respondWithSuccess('Users fetched successfully', $users);
    }
    public function fetchUser($id)
    {
        $user = User::findOrFail($id);
        $user->departments = departmentByUserID($user->id);
        return $this->respondWithSuccess('User fetched successfully', $user);
    }

    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:10|unique:users,phone,'.$request->id,
            'role' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->respondWithError("Id,Email or phone is not valid or already taken and others are required");
        }
        $user = User::find($request->id);
        if(!$user){
            return $this->respondWithError("User not found");
        }
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->save();
            $user->syncRoles($request->role);
            $user->role = $user->roles[0]->name;
            unset($user->roles);
            unset($user->created_at);
            unset($user->updated_at);
            return $this->respondWithSuccess('User updated successfully', $user);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($id == 1){
            return $this->respondWithError("You can't delete admin user");
        }
        if($user){
            $user->delete();
            return $this->respondWithSuccess('User is successfully deleted');
        }else{
            return $this->respondWithError('User is not found');
        }
    }
}

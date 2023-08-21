<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select()->with('roles')->get();
        return view('user.index', compact('users'));
    }
    public function pendingUserIndex()
    {
        $users = User::select()->where('status','pending')->with('roles')->get();
        return view('user._partials.pending_user_index', compact('users'));
    }
    public function deactiveUserIndex()
    {
        $users = User::select()->where('status','deactive')->with('roles')->get();
        return view('user._partials.deactive_user_index', compact('users'));
    }

    public function actionUpdate(Request $request)
    {
        $users = User::select()->whereIn('id', $request->ids)->get();
        // $user->status = $request->status;
        $action = $request->action;

        if ($action == 'delete') {
            foreach ($users as $user) {
                $user->delete();
            }
        } else {
            foreach ($users as $user) {
                $user->status = $action;
                $user->save();
            }
        }

        return $this->respondWithSuccess("data", $users);
    }

    public function fetchUsers()
    {
        $users = User::select()->with('roles')->get();
        return $this->respondWithSuccess("data", $users);
    }

    public function view($id){
        $user = User::select()->with('roles')->where('id', $id)->first();
        if($user){
            if(!$user->cover_image){
                $user->cover_image = 'assets/img/generic/4.jpg';
            }
            $user->department = departmentByUserID($user->id);
            $user->profile_picture_url = $user->image ? $user->image : asset('images/default_profile.png');
            $user->approvedIssue = $user->getApprovedOrRejectedIssue($user->id,'accepted');
            $user->deniedIssue = $user->getApprovedOrRejectedIssue($user->id,'rejected');
            return view('user.view', compact('user'));
        }else{
            return redirect()->route('user.index');
        }
    }
    public function edit($id){
        $user = User::select()->with('roles')->where('id', $id)->first();
        $roles = Role::all();
        if($user){
            if(!$user->cover_image){
                $user->cover_image = 'assets/img/generic/4.jpg';
            }
            $user->profile_picture_url = $user->image ? $user->image : asset('images/default_profile.png');
            return view('user.edit', compact('user','roles'));
        }else{
            return redirect()->route('user.index');
        }
    }
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|digits:11',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->designation = $request->designation;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = "user_image" . Date('d_m_y_h_m_s')  . $image->getClientOriginalName();
                $image->storeAs('userImage/', $imageName, 'public');
                $user->image = "storage" . "/" . "userImage" . "/" . $imageName;
            }
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $imageName = "user_image" . Date('d_m_y_h_m_s')  . $image->getClientOriginalName();
                $image->storeAs('userImage/', $imageName, 'public');
                $user->cover_image = "storage" . "/" . "userImage" . "/" . $imageName;
            }
            $user->save();
            $user->assignRole($request->role_id);

            Session::flash('message', 'User created successfully');
            Session::flash('class', 'success');
            return redirect()->route('user.index');
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'phone' => 'required|digits:11',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if($request->password){
                $user->password = Hash::make($request->password);
            }
            if ($request->hasFile('image')) {
                $image = str_replace("storage", "public", $user->image);
                Storage::delete($image);
                $image = $request->file('image');
                $imageName = "user_image" . Date('d_m_y_h_m_s')  . $image->getClientOriginalName();
                $image->storeAs('userImage/', $imageName, 'public');
                $user->image = "storage" . "/" . "userImage" . "/" . $imageName;
            }
            if ($request->hasFile('cover_image')) {
                $image = str_replace("storage", "public", $user->cover_image);
                Storage::delete($image);
                $image = $request->file('cover_image');
                $imageName = "user_image" . Date('d_m_y_h_m_s')  . $image->getClientOriginalName();
                $image->storeAs('userImage/', $imageName, 'public');
                $user->cover_image = "storage" . "/" . "userImage" . "/" . $imageName;
            }
            $user->designation = $request->designation;
            $user->save();
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            $user->assignRole($request->role_id);

            Session::flash('message', 'User uploaded successfully');
            Session::flash('class', 'success');
            return redirect()->route('user.index');
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }

    public function userStatusUpdate(Request $request)
    {
        $user = User::find($request->id);
        if($request->status == 'active')
        {
            $user->status = 'deactive';
        }
        else
        {
            $user->status = 'active';
        }
        $user->save();
        return $this->respondWithSuccess("data", $user);
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::select()->with('addedBy')->get();
        $users = User::select('id', 'name')->get();

        foreach ($departments as $department) {
            $department->users = $department->getAssignUsers($department->id);
        }
        return view('department.index', compact('departments', 'users'));
    }


    public function fetchAssignUser($id)
    {
        $department = Department::find($id);
        $userIds = explode(',', $department->has_users);
        $users = User::whereIn('id', $userIds)->get();
        return $this->respondWithSuccess("Successfully fetched assign users", $users);
    }
    public function assignUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userIds' => 'required|array',
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrorWeb("Department assign user is required.");
        }
        $department = Department::find($request->department_id);
        $userIds = implode(',', $request->userIds);
        $department->has_users = $userIds;
        $department->added_by = auth()->user()->id;
        $department->save();
        return $this->respondWithSuccessWeb("Users assign have been successfully done");
    }

     public function fetchAllDepartment()
    {
        $departments = Department::select('id', 'name')->get();
        return $this->respondWithSuccess("All department fetched successfully", $departments);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments',
            'userIds' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->respondWithErrorWeb("Department name field and assign user are required and name is duplicate.");
        }
        try {
            $userIds = implode(',', $request->userIds);
            $department = new Department();
            $department->name = $request->name;
            $department->added_by = auth()->user()->id;
            $department->has_users = $userIds;
            $department->save();
            return $this->respondWithSuccessWeb("Department has been created successfully");
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }

    public function delete($id)
    {
        $department = Department::find($id);
        $department->delete();
        return $this->respondWithSuccess("Department has been deleted successfully");
    }


    // Frontend 
    public function publicIndex()
    {
        $departments = Department::select()->with('addedBy')->get();
        foreach ($departments as $department) {
            $department->users = $department->getAssignUsers($department->id);
        }
        return view('public.department.index', compact('departments'));
        // return view('public.department.index_back', compact('departments'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{
    public function fetchDepartments()
    {
        $departments = Department::select()->with('addedBy')->get();
        foreach($departments as $department){
            $department->hasUsers = $department->getAssignUsers($department->id);
        }
        return $this->respondWithSuccess('Departments fetched successfully', $departments);
    }

    public function fetchDepartment($id)
    {
        $departments = Department::select()->where('id', $id)->with('addedBy')->get();
        if($departments->count() > 0){
            foreach($departments as $department){
                $department->hasUsers = userByDepartmentId($department->id);
            }
            return $this->respondWithSuccess('Department fetched successfully', $departments);
        }else{
            return $this->respondWithError('Department is not found');
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments',
            'userIds' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError('Name field and assign user are required or name is not unique.');
        }
        $userIds = implode(',', $request->userIds);
        $department = Department::create([
            'name' => $request->name,
            'added_by' => auth()->user()->id,
            'has_users' => $userIds
        ]);
        return $this->respondWithSuccess('Department created successfully', $department);
    }
    public function update(Request $request)
    {

        $department = Department::find($request->id);

        if (!$department) {
            return $this->respondWithError('Department is not found');
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:departments,name,'. $request->id,
                'userIds' => 'array',
            ]);
        }
        
        if ($validator->fails()) {
            return $this->respondWithError('Name field is required or duplicate entry.');
        }

        try {
            $department = Department::find($request->id);
            $department->name = $request->name;
            if($request->userIds){
                $userIds = implode(',', $request->userIds);
                $department->has_users = $userIds;
            }
            $department->added_by = auth()->user()->id;
            $department->save();
            return $this->respondWithSuccess('Department created successfully', $department);
        } catch (Exception $e) {
            return $this->respondWithError('Department not found');
        }

    }

    public function assignUser(Request $request){
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|string|max:255',
            'userIds' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError('Name field and assign user are required or name is not unique.');
        }
        return $this->respondWithSuccess('Successfully assign user for this department', $request->all());
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->delete();
            return $this->respondWithSuccess('Department deleted successfully', $department);
        } else {
            return $this->respondWithError('Department is not found');
        }
    }
}

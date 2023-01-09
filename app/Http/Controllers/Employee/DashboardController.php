<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('employee.dashboard.index');
    }

    public function profile()
    {
        $employee = auth()->user()->employee;
        return view('employee.dashboard.profile', compact('employee'));
    }

    public function editProfile($id)
    {
        $departments = Department::all();
        $designations = Designation::all();
        $employee = auth()->user()->employee;
        return view('employee.dashboard.edit-profile', compact('employee', 'departments', 'designations'));
    }

    public function updateProfile(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        // dd($request->all());
        $employee = Employee::find($id);
        $employee->phone = $request->phone;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->address = $request->address;
        $employee->date_of_birth = $request->date_of_birth;
        if ($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = 'uploads/images/employess/';
            $image = time() . '.' . $file_ext;

            if ($request->file('image')->move($destination_path, $image)) {
                $employee->image = 'uploads/images/employess/' . $image;
            }
        }
        if ($employee->save()) {
            if ($request->has('new_password') && $request->has('old_password') && $request->old_paaaword != null && $request->new_password != null) {
                $user = User::find($employee->user_id);
                //if old password is correct
                if (\Hash::check($request->old_password, $user->password)) {
                    $user->password = \Hash::make($request->new_password);
                    $user->save();
                    //auth logout
                    \Auth::logout();
                } else {
                    return redirect()->back()->with('error', 'Old password is incorrect');
                }
            }
        }
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}

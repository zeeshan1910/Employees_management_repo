<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EducationalQualification;
use App\Models\Employee;
use App\Models\FamilyMembers;
use App\Models\PreviousExperience;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Html\Builder;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $employees = Employee::all();
            return datatables()->of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($employee) {
                    return '<a href="' . route('employees.edit', $employee->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <a href="' . route('employee.delete', $employee->id) . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })
                ->editColumn('name', function ($employee) {
                    return $employee->first_name . ' ' . $employee->last_name;
                })
                ->editColumn('designation', function ($employee) {
                    return $employee->getDesignation->name;
                })
                ->editColumn('department', function ($employee) {
                    return $employee->getDepartment->name;
                })
                ->editColumn('status', function ($employee) {
                    if ($employee->status == 1) {
                        return '<span class="badge bg-label-success">Active</span>';
                    } else {
                        return '<span class="badge bg-label-danger">Inactive</span>';
                    }
                })
                ->rawColumns(['action', 'name', 'designation', 'department', 'status'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'employee_id', 'name' => 'employee_id', 'title' => 'Employee ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'department', 'name' => 'department', 'title' => 'Department'],
            ['data' => 'designation', 'name' => 'designation', 'title' => 'Designation'],
            ['data' => 'salary', 'name' => 'salary', 'title' => 'Salary'],
            ['data' => 'joining_date', 'name' => 'joining_date', 'title' => 'Joining Date'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
        ]);

        return view('admin.employee.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.employee.create', compact('departments', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'employee';
        if ($user->save()) {
            $employee = new Employee();
            $employee->user_id = $user->id;
            $employee->employee_id = $request->employee_id;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $user->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->date_of_birth = $request->date_of_birth;
            $employee->designation = $request->designation;
            $employee->department = $request->department;
            $employee->joining_date = $request->joining_date;
            $employee->salary = $request->salary;
            $employee->status = true;
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
            $employee->save();

            //previous experience
            $previous_experience = new PreviousExperience();
            $previous_experience->employee_id = $employee->id;
            $previous_experience->company_name = $request->company_name;
            $previous_experience->designation = $request->pre_designation;
            $previous_experience->from_date = $request->from_date;
            $previous_experience->to_date = $request->to_date;
            $previous_experience->save();

            //Educational Qualification
            $educational_qualification = new EducationalQualification();
            $educational_qualification->employee_id = $employee->id;
            $educational_qualification->degree = $request->degree;
            $educational_qualification->university = $request->university;
            $educational_qualification->year_of_passing = $request->year_of_passing;
            $educational_qualification->grade = $request->grade;
            $educational_qualification->save();

            //Family Member
            $family_member = new FamilyMembers();
            $family_member->employee_id = $employee->id;
            $family_member->name = $request->family_name;
            $family_member->relation = $request->relation;
            $family_member->save();
        }
        return redirect()->route('employees.index')->with('success', 'Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.employee.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.employee.edit', compact('employee', 'departments', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->employee_id = $request->employee_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->designation = $request->designation;
        $employee->department = $request->department;
        $employee->joining_date = $request->joining_date;
        $employee->salary = $request->salary;
        $employee->status = true;
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
            $previous_experience = PreviousExperience::where('employee_id', $employee->id)->first();
            $previous_experience->company_name = $request->company_name;
            $previous_experience->designation = $request->pre_designation;
            $previous_experience->from_date = $request->from_date;
            $previous_experience->to_date = $request->to_date;
            $previous_experience->save();

            $educational_qualification = EducationalQualification::where('employee_id', $employee->id)->first();
            $educational_qualification->degree = $request->degree;
            $educational_qualification->university = $request->university;
            $educational_qualification->year_of_passing = $request->year_of_passing;
            $educational_qualification->grade = $request->grade;
            $educational_qualification->save();

            $family_member = FamilyMembers::where('employee_id', $employee->id)->first();
            $family_member->name = $request->family_name;
            $family_member->relation = $request->relation;
            $family_member->save();

            if ($request->has('password') && $request->password != '') {
                $user = User::where('email', $employee->email)->first();
                $user->password = Hash::make($request->password);
                $user->save();
            }
        }
        return redirect()->route('employees.index')->with('success', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee->delete()) {
            $user = User::where('email', $employee->email)->first();
            $user->delete();
            $family_member = FamilyMembers::where('employee_id', $employee->id)->first();
            $family_member->delete();
            $educational_qualification = EducationalQualification::where('employee_id', $employee->id)->first();
            $educational_qualification->delete();
            $previous_experience = PreviousExperience::where('employee_id', $employee->id)->first();
            $previous_experience->delete();
        }
        return redirect()->route('employees.index')->with('success', 'Employee Deleted Successfully');
    }

    public function ExportEmployee()
    {
        return Excel::download(new EmployeeExport, 'employees-' . Carbon::now() . '.xlsx');
    }

    public function ImportEmployee(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new EmployeeImport, $request->file('file'));
        return redirect()->route('employees.index')->with('success', 'Employee Imported Successfully');
    }
}

<?php

namespace App\Imports;

use App\Models\EducationalQualification;
use App\Models\Employee;
use App\Models\FamilyMembers;
use App\Models\PreviousExperience;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $employee_id = $row['employee_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $password = $row['password'];
            $phone = $row['phone'];
            $address = $row['address'];
            $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d');
            $department = $row['department'];
            $designation = $row['designation'];
            $joining_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['joining_date'])->format('Y-m-d');
            $salary = $row['salary'];
            $degree = $row['degree'];
            $institute = $row['institute'];
            $year_of_passing = $row['year_of_passing'];
            $grade = $row['grade'];
            $company_name = $row['company_name'];
            $position = $row['pre_designation'];
            $from_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['from_date'])->format('Y-m-d');
            $to_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['to_date'])->format('Y-m-d');
            $family_person_name = $row['family_person_name'];
            $relation = $row['relation'];


            //inser data
            $user = new User();
            $user->name = $first_name . ' ' . $last_name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = 'employee';
            if ($user->save()) {
                $employee = new Employee();
                $employee->user_id = $user->id;
                $employee->employee_id = $employee_id;
                $employee->first_name = $first_name;
                $employee->last_name = $last_name;
                $employee->email = $email;
                $employee->phone = $phone;
                $employee->address = $address;
                $employee->date_of_birth = $date_of_birth;
                $employee->designation = $designation;
                $employee->department = $department;
                $employee->joining_date = $joining_date;
                $employee->salary = $salary;
                $employee->status = true;
                $employee->save();

                //insert data into education table
                $previous_experience = new PreviousExperience();
                $previous_experience->employee_id = $employee->id;
                $previous_experience->company_name = $company_name;
                $previous_experience->designation = $position;
                $previous_experience->from_date = $from_date;
                $previous_experience->to_date = $to_date;
                $previous_experience->save();

                //insert data into education table
                $educational_qualification = new EducationalQualification();
                $educational_qualification->employee_id = $employee->id;
                $educational_qualification->degree = $degree;
                $educational_qualification->university = $institute;
                $educational_qualification->year_of_passing = $year_of_passing;
                $educational_qualification->grade = $grade;
                $educational_qualification->save();

                //Family Member
                $family_member = new FamilyMembers();
                $family_member->employee_id = $employee->id;
                $family_member->name = $family_person_name;
                $family_member->relation = $relation;
                $family_member->save();
            }
        }
        return redirect()->route('employees.index')->with('success', 'Employee imported successfully');
    }
}

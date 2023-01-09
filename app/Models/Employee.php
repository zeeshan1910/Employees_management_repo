<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function getDesignation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }

    public function getDepartment()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experience()
    {
        return $this->belongsTo(PreviousExperience::class, 'id', 'employee_id');
    }

    public function education()
    {
        return $this->belongsTo(EducationalQualification::class, 'id', 'employee_id');
    }

    public function family()
    {
        return $this->belongsTo(FamilyMembers::class, 'id', 'employee_id');
    }
}

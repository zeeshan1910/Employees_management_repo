@extends('layouts.master')
@section('title', 'Edit Employee Details | Admin Panel')
@section('css')
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
@endsection

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Add New Employee</h5>
        <form class="card-body needs-validation" action="{{ route('employee.update-profile', $employee->id) }}" method="POST"
            enctype="multipart/form-data" autocomplete="off" novalidate>
            @method('PUT')
            @csrf
            <h6 class="fw-normal">1. Account Details</h6>
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label" for="employee-id">Employee ID</label>
                    <input type="text" class="form-control" placeholder="EMP-1234" name="employee_id"
                        value="{{ $employee->employee_id }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter Employee ID.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-email">Email Address</label>
                    <input type="email" class="form-control" placeholder="employee@company.com" name="email"
                        value="{{ $employee->email }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter valid email address.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-phone">Phone Number</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" placeholder="+91123456789" name="phone"
                            value="{{ $employee->phone }}" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter phone number.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password"> CURRENT Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" name="old_password"
                                value="{{ old('old_password') }}" autocomplete="off">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter password.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password">NEW Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" name="new_password"
                                value="{{ old('new_password') }}" autocomplete="off">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter password.</div>
                        </div>
                    </div>
                </div>

            </div>
            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">2. Personal Info</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-first-name">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name"
                        value="{{ $employee->first_name }}" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter first name.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-last-name">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                        value="{{ $employee->last_name }}" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter last name.</div>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="multicol-last-name">Address</label>
                    <textarea class="form-control" rows="2" placeholder="Address" name="address" value="{{ old('address') }}"
                        required>{{ $employee->address }}</textarea>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter address.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-birthdate">Date of Birth</span></label>
                    <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD"
                        name="date_of_birth" value="{{ $employee->date_of_birth }}" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter date of birth.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-phone">Department</label>
                    <select class="form-select select2" name="department" data-allow-clear="true" required disabled>
                        <option value=""></option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}"
                                {{ $item->id = $employee->department ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please select department.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-phone">Designation</label>
                    <select class="form-select select2" name="designation" data-allow-clear="true" required disabled>
                        <option value=""></option>
                        @foreach ($designations as $item)
                            <option value="{{ $item->id }}"
                                {{ $item->id = $employee->designation ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please select designation.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-birthdate">Joining Date</label>
                    <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="joining_date"
                        readonly="readonly" value="{{ $employee->joining_date }}">
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter joining date.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="salary">Salary</label>
                    <input type="text" class="form-control" placeholder="Salary" name="salary"
                        value="{{ $employee->salary }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter salary.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="salary">Photo</label>
                    <input type="file" class="form-control" name="image">
                </div>
            </div>

            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">3. Previous Experice</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Company Name</label>
                    <input type="text" class="form-control" placeholder="Company Name" name="company_name"
                        value="{{ $employee->experience->company_name }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter company name.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Designation</label>
                    <input type="text" class="form-control" placeholder="Designation" name="pre_designation"
                        value="{{ $employee->experience->designation }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter designation.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">From Date</label>
                    <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="from_date"
                        readonly="readonly" value="{{ $employee->experience->from_date }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter from date.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">To Date</label>
                    <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="to_date"
                        readonly="readonly" value="{{ $employee->experience->to_date }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter to date.</div>
                </div>
            </div>
            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">4. Educational Qualification</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Degree</label>
                    <input type="text" class="form-control" placeholder="Degree" name="degree"
                        value="{{ $employee->education->degree }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter degree.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Institute</label>
                    <input type="text" class="form-control" placeholder="Institute" name="university"
                        value="{{ $employee->education->university }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter institute.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Year of Passing</label>
                    <input type="text" class="form-control" placeholder="Year of Passing" name="year_of_passing"
                        value="{{ $employee->education->year_of_passing }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter year of passing.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Grade / Percentage</label>
                    <input type="text" class="form-control" placeholder="Grade" name="grade"
                        value="{{ $employee->education->grade }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter grade.</div>
                </div>
            </div>
            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">5. Family Member</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="family_name"
                        value="{{ $employee->family->name }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter name.</div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Relation</label>
                    <input type="text" class="form-control" placeholder="Relation" name="relation"
                        value="{{ $employee->family->relation }}" required readonly>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Please enter relation.</div>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="/assets/js/form-validation.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a value"
            });
        });

        //flatpickr
        $('.flatpickr-input').flatpickr({
            dateFormat: "Y-m-d",
            maxDate: "today",
            allowInput: true,
        });
    </script>
@endsection

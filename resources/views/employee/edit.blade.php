@extends('layouts.app')
@section('title', 'Edit Employee')
@section('content')
    <div class="container-fluid px-0 workspace-heading-panel">
        <div class="row align-items-center">
            <div class="col-12 col-md-7 mb-3 mb-md-0">
                <h1 class="main-title-text-context">Edit Employee</h1>
                <div class="breadcrumb-navigation-map">
                    <a href="{{ route('admin.dashboard') }}" class="root-home-link-item">Home</a>
                    <span class="navigation-separator-token">></span>
                    <a href="{{ route('admin.employee.index') }}" class="root-home-link-item">Employee</a>
                    <span class="navigation-separator-token">></span>
                    <span class="active-node-label">Edit Employee</span>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.employee.update', $employee->id) }}" class="form">
        <div class="container-fluid px-0">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="row my-3">
                    <div class="col-md-12">
                        <div class="card border-left-danger shadow-sm">
                            <div class="card-header bg-danger-soft py-3">
                                <h5 class="m-0 text-danger font-weight-bold">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>{{ __('Error Details') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="mb-0 pl-3">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-danger mb-1">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-md-6 col-12 mb-md-0 mb-3">
                    <div class="card border-0 rounded-lg shadow-sm p-3"
                        style="background-color: var(--bg-card); color: var(--text-main);">

                        <h4 class="font-weight-bold mb-4 card-title"><i
                                class="fas fa-building mr-2"></i>{{ __('Official Details') }}</h4>

                        <div class="py-4 px-3 rounded-lg"
                            style="background: var(--input-bg); border: 1px dashed var(--input-border);">
                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="emp_id">Employee ID <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control " disabled
                                    value="{{ $employee->employee_id }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="emp_name">Employee Name
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="employee_name" id="emp_name" required
                                    placeholder="Enter full name" value="{{ $employee->employee_name }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="emp_other_name">Name in Native
                                    Language</label>
                                <input type="text" class="form-control" name="employee_name_other" id="emp_other_name"
                                    placeholder="যেমন: বাংলা নাম" value="{{ $employee->employee_name_other }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="offi_mail">Official Email</label>
                                <input type="email" class="form-control" name="official_mail" id="offi_mail"
                                    placeholder="example@company.com" value="{{ $employee->official_mail }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="desig">Designation <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="designation" id="desig" required>
                                    <option value="" selected disabled>Select Designation</option>
                                    @foreach ($designations as $key => $designation)
                                        <option value="{{ $key }}" {{ $employee->designation == $key ? 'selected' : '' }}>
                                            {{ $designation }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="branch">Office Branch <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="office" id="branch" required>
                                    <option value="" selected disabled>Select Office</option>
                                    @foreach ($branches as $key => $branch)
                                        <option value="{{ $key }}" {{ $employee->office == $key ? 'selected' : '' }}>
                                            {{ $branch }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="shift">Shift <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="shift" id="shift" required>
                                    <option value="" selected disabled>Select Shift</option>
                                    @foreach ($shifts as $key => $shift)
                                        <option value="{{ $key }}" {{ $employee->shift == $key ? 'selected' : '' }}>
                                            {{ $shift }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="unit">Unit <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="unit" id="unit" required>
                                    <option value="" selected disabled>Select Unit</option>
                                    @foreach ($units as $key => $unit)
                                        <option value="{{ $key }}" {{ $employee->unit == $key ? 'selected' : '' }}>
                                            {{ $unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="department">Department <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="department" id="department" required>
                                    <option value="" selected disabled>Select Dept</option>
                                    @foreach ($departments as $key => $department)
                                        <option value="{{ $key }}" {{ $employee->department == $key ? 'selected' : '' }}>
                                            {{ $department }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="section_line">Section / Line
                                    <span class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="section_line" id="section_line" required>
                                    <option value="" selected disabled>Select Section/Line</option>
                                    @foreach ($section_lines as $key => $section_line)
                                        <option value="{{ $key }}" {{ $employee->section_line == $key ? 'selected' : '' }}>
                                            {{ $section_line }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="card_no">Card / Account No
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="card_no" id="card_no" required
                                    placeholder="Enter Card or AC Number" value="{{ $employee->card_no }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Work Group</label>
                                <div class="d-flex pt-2">
                                    <div class="custom-control custom-radio mr-4">
                                        <input type="radio" id="wg_worker" name="work_group" value="Worker"
                                            class="custom-control-input" {{ $employee->work_group == 'Worker' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="wg_worker">Worker</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="wg_staff" name="work_group" value="Staff"
                                            class="custom-control-input" {{ $employee->work_group == 'Staff' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="wg_staff">Staff</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Salary Type</label>
                                <div class="d-flex pt-2">
                                    <div class="custom-control custom-radio mr-4">
                                        <input type="radio" id="st_regular" name="salary_type" value="Regular"
                                            class="custom-control-input" {{ $employee->salary_type == 'Regular' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="st_regular">Regular</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="st_production" name="salary_type" value="Production"
                                            class="custom-control-input" {{ $employee->salary_type == 'Production' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="st_production">Production</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="joining_date">Joining Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="joining_date" id="joining_date" required value="{{ $employee->joining_date }}">
                                <div id="joining_date_error" class="text-danger small mt-1" style="display: none;"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="grade">Grade <span class="text-danger">*</span></label>
                                <select class="custom-select form-control" name="grade" id="grade" required>
                                    <option value="" selected>Select Grade</option>
                                    @foreach ($grades as $key => $grade)
                                        <option value="{{ $key }}" {{ $employee->grade == $key ? 'selected' : '' }}>
                                            {{ $grade }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="gross">Gross Salary <span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="gross" id="gross"
                                    onkeyup="passSecondGross()" required placeholder="0.00" value="{{ $employee->gross }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="second_gross">Second Gross
                                    <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="second_gross" id="second_gross"
                                    required placeholder="0.00" value="{{ $employee->second_gross }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="manager">Line Manager /
                                    Supervisor <span class="text-danger">*</span></label>
                                <select name="manager" id="manager" class="custom-select form-control">
                                    <option value="" selected disabled>Select Manager</option>
                                    @foreach ($managers as $key => $manager)
                                        <option value="{{ $key }}" {{ $employee->manager == $key ? 'selected' : '' }}>
                                            {{ $manager }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="job_location">Job Location</label>
                                <input type="text" class="form-control" name="job_location" id="job_location"
                                    placeholder="e.g. Factory Floor 1" value="{{ $employee->job_location }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="probation_period">Probation Period
                                    Until</label>
                                <input type="date" class="form-control" name="probation_period" id="probation_period" value="{{ $employee->probation_period }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="confirmation_date">Confirmation Date</label>
                                <input type="date" class="form-control" name="confirmation_date" id="confirmation_date" value="{{ $employee->confirmation_date }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Is OT Payable?</label>
                                <div class="d-flex pt-1">
                                    <div class="form-check form-check-inline mr-3">
                                        <input class="form-check-input" type="radio" name="is_ot_payable" id="ot_yes"
                                            value="Yes" {{ $employee->is_ot_payable == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ot_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-3">
                                        <input class="form-check-input" type="radio" name="is_ot_payable" id="ot_no"
                                            value="No" {{ $employee->is_ot_payable == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ot_no">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_ot_payable" id="ot_buyer"
                                            value="Buyer" {{ $employee->is_ot_payable == 'Buyer' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ot_buyer">Buyer</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Is Masked?</label>
                                <div class="d-flex pt-1">
                                    <div class="form-check form-check-inline mr-3">
                                        <input class="form-check-input" type="radio" name="is_masked" id="masked_yes"
                                            value="Yes" {{ $employee->is_masked == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="masked_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_masked" id="masked_no"
                                            value="No" {{ $employee->is_masked == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="masked_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold" for="employee_status">Employee
                                    Status</label>
                                <select name="employee_status" id="employee_status" class="custom-select form-control"
                                    onchange="empStatus()">
                                    <option value="Active" {{ $employee->employee_status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $employee->employee_status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="Left" {{ $employee->employee_status == 'Left' ? 'selected' : '' }}>Left</option>
                                    <option value="Hold" {{ $employee->employee_status == 'Hold' ? 'selected' : '' }}>Hold</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="discontinuation_date">Discontinuation
                                    Date</label>
                                <input type="date" class="form-control" name="discontinuation_date"
                                    id="discontinuation_date" disabled value="{{ $employee->discontinuation_date }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="discontinuation_reason">Discontinuation
                                    Reason</label>
                                <input type="text" class="form-control" name="discontinuation_reason"
                                    id="discontinuation_reason" disabled value="{{ $employee->discontinuation_reason }}" placeholder="Reason">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 mb-md-0 mb-3">
                    <div class="card border-0 rounded-lg shadow-sm p-3"
                        style="background-color: var(--bg-card); color: var(--text-main);">

                        <h4 class="font-weight-bold mb-4 card-title">{{ __('Personal Details') }}</h4>

                        <div class="py-4 px-3 rounded-lg"
                            style="background: var(--input-bg); border: 1px dashed var(--input-border);">
                            <div class="form-group mb-3">
                                <label class="form-label" for="father_name">Father's Name</label>
                                <input type="text" class="form-control" name="father_name" id="father_name"
                                    value="{{ $employee->emppersonalinfos->father_name }}" placeholder="Father's name">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="mother_name">Mother's Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name"
                                    value="{{ $employee->emppersonalinfos->mother_name }}" placeholder="Mother's name">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="birth_date">Birth Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" required value="{{ $employee->emppersonalinfos->birth_date }}">
                                <div id="birth_date_error" class="text-danger small mt-1" style="display: none;"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="height">Height</label>
                                <input type="text" class="form-control" name="height" id="height" value="{{ $employee->emppersonalinfos->height }}" placeholder="e.g. 5'6''">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="blood_group">Blood Group</label>
                                <select class="custom-select form-control" name="blood_group" id="blood_group">
                                    <option value="" selected>Select Group</option>
                                    <option value="o (+ve)" {{ $employee->emppersonalinfos->blood_group == 'o (+ve)' ? 'selected' : '' }}>O (+ve)</option>
                                    <option value="o (-ve)" {{ $employee->emppersonalinfos->blood_group == 'o (-ve)' ? 'selected' : '' }}>O (-ve)</option>
                                    <option value="a (+ve)" {{ $employee->emppersonalinfos->blood_group == 'a (+ve)' ? 'selected' : '' }}>A (+ve)</option>
                                    <option value="a (-ve)" {{ $employee->emppersonalinfos->blood_group == 'a (-ve)' ? 'selected' : '' }}>A (-ve)</option>
                                    <option value="b (+ve)" {{ $employee->emppersonalinfos->blood_group == 'b (+ve)' ? 'selected' : '' }}>B (+ve)</option>
                                    <option value="b (-ve)" {{ $employee->emppersonalinfos->blood_group == 'b (-ve)' ? 'selected' : '' }}>B (-ve)</option>
                                    <option value="ab (+ve)" {{ $employee->emppersonalinfos->blood_group == 'ab (+ve)' ? 'selected' : '' }}>AB (+ve)</option>
                                    <option value="ab (-ve)" {{ $employee->emppersonalinfos->blood_group == 'ab (-ve)' ? 'selected' : '' }}>AB (-ve)</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="contact_number">Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" id="contact_number"
                                    value="{{ $employee->emppersonalinfos->contact_number }}" placeholder="01xxxxxxxxx">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label font-weight-bold">Gender</label>
                                <div class="d-flex pt-2">
                                    <div class="form-check form-check-inline mr-3">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                            value="Male" {{ $employee->emppersonalinfos->gender == 'Male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-3">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                            value="Female" {{ $employee->emppersonalinfos->gender == 'Female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_other"
                                            value="Other" {{ $employee->emppersonalinfos->gender == 'Other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_other">Other</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="religion">Religion</label>
                                <select class="custom-select form-control" name="religion" id="religion">
                                    <option value="" selected>Select Religion</option>
                                    @foreach ($religions as $key => $religion)
                                        <option value="{{ $key }}" {{ $employee->emppersonalinfos->religion == $key ? 'selected' : '' }}>{{ $religion }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="nationality">Nationality</label>
                                <input type="text" class="form-control" name="nationality" id="nationality"
                                    value="{{ $employee->emppersonalinfos->nationality ?: 'Bangladeshi' }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="marital_status">Marital Status</label>
                                <select class="custom-select form-control" name="marital_status" id="marital_status">
                                    <option value="" selected>Select Status</option>
                                    <option value="Married" {{ $employee->emppersonalinfos->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Unmarried" {{ $employee->emppersonalinfos->marital_status == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                                    <option value="Divorced" {{ $employee->emppersonalinfos->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="national_id">National ID (NID)</label>
                                <input type="text" class="form-control" name="national_id" id="national_id"
                                    value="{{ $employee->emppersonalinfos->national_id }}" placeholder="NID Number">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="birth_certificate">Birth Certificate
                                    No</label>
                                <input type="text" class="form-control" name="birth_certificate" id="birth_certificate"
                                    value="{{ $employee->emppersonalinfos->birth_certificate }}" placeholder="Certificate Number">
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 rounded-lg shadow-sm p-3 mt-5"
                        style="background-color: var(--bg-card); color: var(--text-main);">

                        <h4 class="font-weight-bold mb-4 card-title">{{ __('Emergency Contact Details') }}</h4>

                        <div class="py-4 px-3 rounded-lg"
                            style="background: var(--input-bg); border: 1px dashed var(--input-border);">

                            <div class="form-group mb-3">
                                <label class="form-label" for="emergency_contact_name">Contact Name</label>
                                <input type="text" class="form-control" name="emergency_contact_name"
                                    id="emergency_contact_name" value="{{ $employee->emppersonalinfos->emergency_contact_name }}" placeholder="Name">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="emergency_contact_number">Contact
                                    Number</label>
                                <input type="text" class="form-control" name="emergency_contact_number"
                                    id="emergency_contact_number" value="{{ $employee->emppersonalinfos->emergency_contact_number }}" placeholder="Number">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="emergency_contact_relationship">Relationship</label>
                                <input type="text" class="form-control" name="emergency_contact_relationship"
                                    id="emergency_contact_relationship" value="{{ $employee->emppersonalinfos->emergency_contact_relationship }}"  placeholder="e.g. Brother, Spouse">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="emergency_contact_address">Address</label>
                                <input type="text" class="form-control" name="emergency_contact_address"
                                    id="emergency_contact_address" value="{{ $employee->emergency_contact_address }}" placeholder="Full Address">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-12 d-flex justify-content-end">
                    <a class="btn btn-secondary px-4 mr-2" href="{{ route('admin.employee.index') }}">{{ __('Cancel') }}</a>
                    <button class="btn btn-primary px-4" type="submit" id="submit">
                        <i class="fas fa-plus-circle mr-1"></i>{{ __('Update Employee') }}
                    </button>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('custom-js-page')
    <script type="text/javascript">
        function passSecondGross() {
            var gross = document.getElementById('gross').value;
            document.getElementById('second_gross').value = gross;
        }
        function empStatus() {
            var empStatus = document.getElementById('employee_status').value;
            if (empStatus == 'Active') {
                document.getElementById('discontinuation_date').removeAttribute("required");
                document.getElementById('discontinuation_date').setAttribute("disabled", "disabled");
                document.getElementById('discontinuation_reason').removeAttribute("required");
                document.getElementById('discontinuation_reason').setAttribute("disabled", "disabled");
            } else {
                document.getElementById('discontinuation_date').removeAttribute("disabled");
                document.getElementById('discontinuation_reason').removeAttribute("disabled");
                document.getElementById('discontinuation_date').setAttribute("required", "required");
                document.getElementById('discontinuation_reason').setAttribute("required", "required");
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const joiningDateInput = document.getElementById('joining_date');
            const birthDateInput = document.getElementById('birth_date');
            const joiningError = document.getElementById('joining_date_error');
            const birthError = document.getElementById('birth_date_error');

            function validateDates() {
                const joiningDateValue = joiningDateInput.value;
                const birthDateValue = birthDateInput.value;

                // যদি দুটি ফিল্ডেই তারিখ সিলেক্ট করা থাকে, তবেই কম্পেয়ার করবে
                if (joiningDateValue && birthDateValue) {
                    const joiningDate = new Date(joiningDateValue);
                    const birthDate = new Date(birthDateValue);

                    // যদি জন্মতারিখ যোগদানের তারিখের সমান বা পরে হয়
                    if (birthDate >= joiningDate) {
                        // ইনপুট বক্সের বর্ডার লাল করার জন্য ক্লাস যোগ (Bootstrap)
                        birthDateInput.classList.add('is-invalid');
                        joiningDateInput.classList.add('is-invalid');

                        // ফিল্ডের নিচে কাস্টম টেক্সট মেসেজ শো করা
                        birthError.textContent = "Birth date must be earlier than the joining date.";
                        birthError.style.display = "block";

                        joiningError.textContent = "Joining date must be after the birth date.";
                        joiningError.style.display = "block";
                    } else {
                        // সব ঠিক থাকলে এরর মেসেজ এবং লাল বর্ডার রিমুভ হবে
                        clearErrors();
                    }
                } else {
                    clearErrors();
                }
            }

            function clearErrors() {
                birthDateInput.classList.remove('is-invalid');
                joiningDateInput.classList.remove('is-invalid');
                birthError.style.display = "none";
                joiningError.style.display = "none";
            }

            // ইউজার যখনই কোনো একটি ডেট চেঞ্জ করবে, তখনই রিয়েল-টাইমে চেক হবে
            joiningDateInput.addEventListener('change', validateDates);
            birthDateInput.addEventListener('change', validateDates);
        });
    </script>
@endsection
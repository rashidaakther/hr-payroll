@extends('layouts.app')
@section('title', 'Employee')
@section('content')
    <div class="container-fluid px-0 workspace-heading-panel">
        <div class="row align-items-center">
            <div class="col-12 col-md-7 mb-3 mb-md-0">
                <h1 class="main-title-text-context">Manage Employee</h1>
                <div class="breadcrumb-navigation-map">
                    <a href="{{ route('admin.dashboard') }}" class="root-homr-link-item">Home</a>
                    <span class="navigation-separator-token">></span>
                    <a href="{{ route('admin.employee.index') }}" class="root-homr-link-item">Employee</a>
                    <span class="navigation-separator-token">></span>
                    <span class="active-node-label">{{ $employee->employee_name }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="card mb-4 border-0 shadow-sm" style=" border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mb-3 mb-sm-0 mr-sm-4 shadow-sm"
                        style="width: 90px; height: 90px; font-size: 2.2rem; font-weight: bold; min-width: 90px;">
                        {{ strtoupper(substr($employee->employee_name, 0, 1)) }}
                    </div>

                    <div class="flex-grow-1">
                        <h4 class="mb-1 font-weight-bold" style="color: var(--text-color) !important;">
                            {{ $employee->employee_name }}
                        </h4>
                        <p class="text-muted mb-2" style="font-size: 0.95rem;">
                            <i class="fas fa-briefcase mr-2 text-success"></i>{{ $employee->getdesignation->name }} — <span
                                class="badge {{ $employee->employee_status == 'Active' ? 'bg-success text-white' : 'bg-danger text-white' }}">{{ $employee->employee_status }}</span>
                        </p>
                        <div class="d-flex flex-wrap justify-content-center justify-content-sm-start small text-muted"
                            style="gap: 1.5rem;">
                            <span class="mr-3"><i class="fas fa-id-card mr-1 text-info"></i> <strong>ID:</strong>
                                {{ $employee->employee_id }}</span>
                            <span class="mr-3"><i class="fas fa-envelope mr-1 text-warning"></i>
                                {{ $employee->official_mail ?? 'N/A' }}</span>
                            <span><i class="fas fa-calendar-alt mr-1 text-primary"></i> <strong>Joined:</strong>
                                {{ \Carbon\Carbon::parse($employee->joining_date)->format('d M, Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-3 mt-sm-0">
                        <a href="{{ route('admin.employee.edit', $employee->id) }}"
                            class="btn btn-sm btn-outline-success px-3">
                            <i class="fas fa-edit mr-1"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .nav-tabs .nav-link.active {
                background-color: var(--bg-card);
                color: var(--text-color);
            }
        </style>

        <ul class="nav nav-tabs border-bottom-0" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active font-weight-bold px-4 py-2 mr-2 border-0 shadow-sm" id="office-tab"
                    data-toggle="tab" href="#office" role="tab" style="border-radius: 8px 8px 0 0;">
                    <i class="fas fa-building mr-2 text-success"></i>Office Info
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link font-weight-bold px-4 py-2 border-0 shadow-sm" id="personal-tab" data-toggle="tab"
                    href="#personal" role="tab" style="border-radius: 8px 8px 0 0;">
                    <i class="fas fa-user mr-2 text-primary"></i>Personal Info
                </a>
            </li>
        </ul>

        <div class="tab-content" id="profileTabContent">

            <div class="tab-pane fade show active" id="office" role="tabpanel" aria-labelledby="office-tab">
                <div class="card border-0 shadow-sm p-4"
                    style="background-color: var(--bg-card, #fff); border-radius: 0 12px 12px 12px;">
                    <h5 class="text-success text-uppercase small font-weight-bold mb-4 border-bottom pb-2">Employment
                        Details</h5>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Office/Branch</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->getoffice->name }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Department</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->getdepartment->name }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Unit</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->getunit->name }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Shift</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->getshift->name }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Section / Line</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->getsectionline->name }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Work Group</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->work_group }}</span>
                        </div>
                    </div>

                    <h5 class="text-success text-uppercase small font-weight-bold mt-4 mb-4 border-bottom pb-2">Salary &
                        Structure</h5>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Salary Type</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->salary_type }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Grade</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->getgrade->name }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Card No</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->card_no }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Gross Salary</label>
                            <span
                                class="text-white font-weight-bold text-success">{{ number_format($employee->gross, 2) }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Second Gross</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->second_gross ? number_format($employee->second_gross, 2) : 'N/A' }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">OT Payable?</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->is_ot_payable }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ২. পার্সোনাল ইনফরমেশন ট্যাব -->
            <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <div class="card border-0 shadow-sm p-4"
                    style="background-color: var(--bg-card, #fff); border-radius: 0 12px 12px 12px;">
                    <h5 class="text-primary text-uppercase small font-weight-bold mb-4 border-bottom pb-2">Personal
                        Background</h5>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Father's Name</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->emppersonalinfos?->father_name ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Mother's Name</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->emppersonalinfos?->mother_name ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Birth Date</label>
                            <span class="text-white" style="color: var(--text-color) !important;">
                                {{ $employee->emppersonalinfos?->birth_date ? \Carbon\Carbon::parse($employee->emppersonalinfos->birth_date)->format('d M, Y') : 'N/A' }}
                            </span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Gender</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->emppersonalinfos?->gender ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Blood Group</label>
                            <span
                                class="text-white font-weight-bold text-danger">{{ strtoupper($employee->emppersonalinfos?->blood_group ?? 'N/A') }}</span>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-3">
                            <label class="text-muted small d-block">Religion</label>
                            <span class="text-white"
                                style="color: var(--text-color) !important;">{{ $employee->emppersonalinfos?->religion ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
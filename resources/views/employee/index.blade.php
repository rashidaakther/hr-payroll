@extends('layouts.app')
@section('title', 'Employee')
@section('content')
    <div class="container-fluid px-0 workspace-heading-panel">
        <div class="row align-items-center">
            <div class="col-12 col-md-7 mb-3 mb-md-0">
                <h1 class="main-title-text-context">Manage Employee</h1>
                <div class="breadcrumb-navigation-map">
                    <a href="#" class="root-home-link-item">Home</a>
                    <span class="navigation-separator-token">></span>
                    <span class="active-node-label">Employee</span>
                </div>
            </div>
            <div class="col-12 col-md-5 text-md-right">
                <div class="utility-action-button-group d-inline-flex">
                    <button class="action-btn-icon tertiary-bg"><i class="fa-regular fa-file-lines"></i></button>
                    <button class="action-btn-icon tertiary-bg"><i class="fa-solid fa-download"></i></button>
                    <a href="{{ route('admin.employee.create') }}" class=" action-btn-icon primary-accent-neon-bg"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="data-table-card-container container-fluid" data-fetch-url="{{ route('admin.employee.getEmployeeData') }}">
        <div class="row data-filter-controller-row align-items-center pb-3">
            <div class="col-12 col-sm-6 mb-3 mb-sm-0 d-flex align-items-center">
                <select class="dark-themed-select-box">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="all">All</option>
                </select>
                <span class="entries-counter-helper-text">entries per page</span>
            </div>
            <div class="col-12 col-sm-6 text-sm-right">
                <input type="text" class="dark-themed-search-input w-100-mobile" placeholder="Search...">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="responsive-table-overflow-wrapper">
                    <table class="core-structured-dark-table">
                        <thead>
                            <tr>
                                <th data-sort="employee_id" style="cursor: pointer;">{{ __('Employee ID') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="employee_name" style="cursor: pointer;">{{ __('Name') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="designation_id" style="cursor: pointer;">{{ __('Designation') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="department_id" style="cursor: pointer;">{{ __('Department') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="section_line_id" style="cursor: pointer;">{{ __('Section/Line') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="joining_date" style="cursor: pointer;">{{ __('Date Of Joining') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th class="aligned-right-column">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-12 table-entries-summary-counter-label"></div>
        </div>
    </div>
    @include('layouts.fatchCusScript')
@endsection
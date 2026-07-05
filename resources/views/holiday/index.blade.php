@extends('layouts.app')
@section('title', 'Holidays')
@section('content')
    <div class="container-fluid p-4">
        <div class="mb-4">
            <h4 class="font-weight-bold mb-1" style="color: var(--text-main); font-size: 1.5rem;">Manage Holidays</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 small" style="margin-bottom: 0;">
                    <li class="breadcrumb-item"><a href="#" class="text-success font-weight-bold text-decoration-none"
                            style="color: #22c55e !important;">Home</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">Holiday</li>
                </ol>
            </nav>
        </div>

        @include('hrSysSetup.hr_setup')

        <div class="d-flex justify-content-end mb-3">
            <a href="javascript:void(0);" data-url="{{ route('admin.holiday.create') }}" data-ajax-popup="true"
                data-title="Create New Holiday"
                class="btn btn-success d-flex align-items-center justify-content-center shadow-sm trigger-ajax-popup"
                style="background-color: #22c55e; border: none; width: 36px; height: 36px; border-radius: 6px;"
                title="Create">
                <i class="fa-solid fa-plus text-dark font-weight-bold"></i>
            </a>
        </div>

    </div>

    @include('hrSysSetup.hr_setup_footer')

    <div class="data-table-card-container container-fluid" data-fetch-url="{{ route('admin.holiday.getHolidayData') }}">
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
                                <th data-sort="name" style="cursor: pointer;">{{ __('Holiday') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="branch_id" style="cursor: pointer;">{{ __('Branch') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="shift_id" style="cursor: pointer;">{{ __('Shift') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th data-sort="holidayType" style="cursor: pointer;">{{ __('Type') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th>{{ __('Duration') }}</th>
                                <th data-sort="total_day" style="cursor: pointer;">{{ __('Total') }} <i
                                        class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th class="aligned-right-column">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loaded dynamically via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-12 table-entries-summary-counter-label"></div>
        </div>
    </div>
@endsection
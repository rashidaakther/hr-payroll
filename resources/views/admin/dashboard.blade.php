@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid p-4">
        <div class="row mb-4">
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card dashboard-stat-card border-0 rounded-lg p-3 shadow-sm"
                    style="background-color: var(--bg-card); color: var(--text-main);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small text-uppercase font-weight-bold mb-1 tracking-wider">Total Employees
                            </p>
                            <h3 class="font-weight-bold mb-0">1,248</h3>
                        </div>
                        <div class="rounded-circle p-3 bg-soft-cyan text-cyan"
                            style="background: rgba(6, 182, 212, 0.15); color: #06b6d4;">
                            <i class="fa-solid fa-users fa-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 small text-success">
                        <i class="fa-solid fa-arrow-trend-up mr-1"></i> <span>+12% vs last month</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card dashboard-stat-card border-0 rounded-lg p-3 shadow-sm"
                    style="background-color: var(--bg-card); color: var(--text-main);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small text-uppercase font-weight-bold mb-1 tracking-wider">Net Payroll</p>
                            <h3 class="font-weight-bold mb-0">$45,210</h3>
                        </div>
                        <div class="rounded-circle p-3 bg-soft-green text-success"
                            style="background: rgba(34, 197, 94, 0.15); color: #22c55e;">
                            <i class="fa-solid fa-wallet fa-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 small text-success">
                        <i class="fa-solid fa-arrow-trend-up mr-1"></i> <span>+4.3% higher velocity</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card dashboard-stat-card border-0 rounded-lg p-3 shadow-sm"
                    style="background-color: var(--bg-card); color: var(--text-main);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small text-uppercase font-weight-bold mb-1 tracking-wider">Performance
                                Index</p>
                            <h3 class="font-weight-bold mb-0">94.2%</h3>
                        </div>
                        <div class="rounded-circle p-3 text-warning"
                            style="background: rgba(234, 179, 8, 0.15); color: #eab308;">
                            <i class="fa-solid fa-chart-line fa-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 small text-muted">
                        <i class="fa-solid fa-circle-check mr-1 text-success"></i> <span>Optimal performance</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="card dashboard-stat-card border-0 rounded-lg p-3 shadow-sm"
                    style="background-color: var(--bg-card); color: var(--text-main);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small text-uppercase font-weight-bold mb-1 tracking-wider">System Alerts
                            </p>
                            <h3 class="font-weight-bold mb-0">0 Active</h3>
                        </div>
                        <div class="rounded-circle p-3 text-danger"
                            style="background: rgba(239, 68, 68, 0.15); color: #ef4444;">
                            <i class="fa-solid fa-shield-halved fa-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 small text-muted">
                        <i class="fa-solid fa-lock mr-1 text-cyan"></i> <span>All endpoints secure</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded-lg shadow-sm p-4"
                    style="background-color: var(--bg-card); color: var(--text-main);">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="font-weight-bold mb-1">System Workspace Activity</h4>
                            <p class="text-muted small mb-0">Live diagnostic data tracking for authenticated portal roles.
                            </p>
                        </div>
                        <button class="btn btn-sm btn-outline-info px-3"
                            style="border-color: var(--input-border); color: var(--text-main);">
                            <i class="fa-solid fa-arrows-rotate mr-1"></i> Refresh Logs
                        </button>
                    </div>

                    <div class="text-center py-5 rounded-lg"
                        style="background: var(--input-bg); border: 1px dashed var(--input-border);">
                        <i class="fa-solid fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.4;"></i>
                        <h5 class="font-weight-bold mb-1">Operational Module Ready</h5>
                        <p class="text-muted small max-w-md mx-auto px-4">Your administrative system pipeline is fully
                            functional. Active metrics tables or transaction logs will appear dynamic here based on user
                            operations.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="data-table-card-container container-fluid">
        <div class="row data-filter-controller-row align-items-center pb-3">
            <div class="col-12 col-sm-6 mb-3 mb-sm-0 d-flex align-items-center">
                <select class="dark-themed-select-box">
                    <option value="10">10</option>
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
                                <th>Employee ID <i class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th>Name <i class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th>Designation <i class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th>Department <i class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th>Section/Line <i class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th>Date of Joining <i class="fa-solid fa-sort sort-indicator-caret-icon"></i></th>
                                <th class="aligned-right-column">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="employee-id-neon-badge">#GMT0000001</span></td>
                                <td class="primary-text-highlight-bold">Rashida Akther</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>sewing - ASMO - A</td>
                                <td>12/2/2023</td>
                                <td class="aligned-right-column">
                                    <button class="row-action-btn edit-action-teal-btn"><i
                                            class="fa-solid fa-pencil"></i></button>
                                    <button class="row-action-btn delete-action-pink-btn"><i
                                            class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="employee-id-neon-badge">#GMT0000002</span></td>
                                <td class="primary-text-highlight-bold">Dipjoy Sarker</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>sewing - operator - B</td>
                                <td>12/2/2023</td>
                                <td class="aligned-right-column">
                                    <button class="row-action-btn lock-action-muted-btn"><i
                                            class="fa-solid fa-lock"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-12 table-entries-summary-counter-label">
                Showing 1 to 2 of 2 entries
            </div>
        </div>
    </div>
@endsection
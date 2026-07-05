@extends('layouts.app')
@section('title', 'Dashboard')
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
                        <button class="action-btn-icon primary-accent-neon-bg"><i class="fa-solid fa-plus"></i></button>
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
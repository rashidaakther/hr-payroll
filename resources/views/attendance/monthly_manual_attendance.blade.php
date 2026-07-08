@extends('layouts.app')
@section('title', 'Monthly Manual Attendance')
@section('content')
    <div class="container-fluid px-0 workspace-heading-panel">
        <div class="row align-items-center">
            <div class="col-12 col-md-7 mb-3 mb-md-0">
                <h1 class="main-title-text-context">Monthly Manual Attendance</h1>
                <div class="breadcrumb-navigation-map">
                    <a href="{{ route('admin.dashboard') }}" class="root-home-link-item">Home</a>
                    <span class="navigation-separator-token">></span>
                    <span class="active-node-label">Attendance</span>
                    <span class="navigation-separator-token">></span>
                    <span class="active-node-label">Monthly Manual Attendance</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .table td,
        .table th {
            vertical-align: middle;
        }
        .table td {
            padding: 0 !important;
        }
            
    </style>

    <form action="{{ route('admin.attendance.monthlyManual_saveAttendance') }}" method="POST">
        @csrf
        <div class="container-fluid px-0">
            <div class="row">
                @if ($errors->any())
                    <div class="col-md-12">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Error Details') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label class="form-label">Employee *</label>
                                    <select class="form-control form-control-sm" id="employeeSelect" name="employee_id">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                data-set="{{ $employee->getdesignation->name ?? 'N/A' }}">
                                                {{ $employee->id }} ({{ $employee->employee_name ?? 'N/A' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">Year *</label>
                                    <select class="form-control form-control-sm" id="yearSelect" name="year_id">
                                        <option value="">Select Year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->name }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">Month *</label>
                                    <select class="form-control form-control-sm" id="monthSelect" name="month_id">
                                        <option value="">Select Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">In Time (HH:mm)</label>
                                    <input type="text" class="form-control form-control-sm" id="inTimeBase" value="09:00">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">Out Time (HH:mm)</label>
                                    <input type="text" class="form-control form-control-sm" id="outTimeBase" value="17:00">
                                </div>
                                <div class="form-group col-md-1 d-flex align-items-end text-end">
                                    <button type="button" class="btn btn-success btn-sm btn-block px-0" id="loadBtn">Load
                                        Data</button>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="checkbox" name="genShiftWise" id="genShiftWise">
                                    <label for="genShiftWise">&nbsp; Generate in/out times Shift-wise</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow-sm">
                                        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--bg-input)">
                                            <span>Attendances List</span>
                                            <small>Total Days: <span id="dayCount">0</span></small>
                                        </div>

                                        <div class="responsive-table-overflow-wrapper" style="max-height: 50vh; overflow-y: auto;">
                                            <table class="core-structured-dark-table">
                                                <thead class="sticky-top" style="background-color: var(--bg-input)">
                                                    <tr>
                                                        <th width="30"><input type="checkbox" id="selectAll">
                                                        </th>
                                                        <th>Emp ID</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Date</th>
                                                        <th>In Time</th>
                                                        <th>Out Time</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="attendanceBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button class="btn btn-primary btn-submit mr-1" type="submit" id="submit">{{ __('Save') }}</button>
                    <button class="btn btn-secondary btn-submit" type="reset">{{ __('Cancel') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('custom-js-page')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#loadBtn').on('click', function () {
                const empId = $('#employeeSelect').val();
                const empName = $("#employeeSelect option:selected").text().split('(')[1]?.replace(')', '') || "Unknown";
                const empDesignation = $("#employeeSelect option:selected").data('set') || "Unknown";
                const year = $('#yearSelect').val();
                const month = $('#monthSelect').val();

                const isShiftWise = $('#genShiftWise').is(':checked');

                let baseIn = $('#inTimeBase').val();
                let baseOut = $('#outTimeBase').val();

                if (!empId) { alert("Please select an employee"); return; }
                if (!year) { alert("Please select a year"); return; }
                if (!month) { alert("Please select a month"); return; }

                $.ajax({
                    url: "{{ route('admin.attendance.monthlyManual_getExistingAttendance') }}",
                    method: "GET",
                    data: {
                        employee_id: empId,
                        year_id: year,
                        month_id: month
                    },
                    success: function (response) {
                        const existingData = response.attendances;
                        const shiftInfo = response.shift_info;

                        if (isShiftWise && shiftInfo) {
                            baseIn = shiftInfo.start_at;
                            baseOut = shiftInfo.end_at;
                        }

                        const daysInMonth = new Date(year, month, 0).getDate();
                        $('#dayCount').text(daysInMonth);
                        let html = '';

                        for (let day = 1; day <= daysInMonth; day++) {
                            const dateObj = new Date(year, month - 1, day);
                            const dateStr = formatDate(dateObj);
                            const dayName = dateObj.toLocaleDateString('en-US', { weekday: 'long' });

                            let inDisplay = "";
                            let outDisplay = "";
                            let status = "Present";
                            let statustag = "<span class='badge bg-danger'>Absent</span>";
                            let isChecked = "";

                            if (existingData[dateStr]) {
                                if(existingData[dateStr].status === "Weekly Holiday") {
                                    inDisplay = "";
                                    outDisplay = "";
                                    status = "Weekly Holiday";
                                    statustag = "<span class='badge bg-warning theme-solid-text p-2'>Weekly Holiday</span>";
                                    isChecked = "checked";
                                } else {
                                    inDisplay = existingData[dateStr].in_time;
                                    outDisplay = existingData[dateStr].out_time;
                                    status = "Present";
                                    statustag = "<span class='badge bg-success theme-solid-text p-2'>Present</span>";
                                    isChecked = "checked";
                                }

                            } else if (dayName === 'Friday') {
                                status = "Weekly Holiday";
                                statustag = "<span class='badge bg-warning theme-solid-text p-2'>Weekly Holiday</span>";
                                inDisplay = "";
                                outDisplay = "";

                            } else {
                                inDisplay = generateRandomTime(dateStr, baseIn);
                                outDisplay = generateRandomTime(dateStr, baseOut);
                                status = "Present";
                                statustag = "<span class='badge bg-danger theme-solid-text p-2'>Absent</span>";
                            }

                            html += `
                                    <tr>
                                        <td><input type="checkbox" name="attendances[${day}][selected]" value="1" class="row-check" ${isChecked}></td>
                                        <td>${empId}</td>
                                        <td>${empName}</td>
                                        <td>${empDesignation}</td>
                                        <td>
                                            ${dateStr}
                                            <input type="hidden" name="attendances[${day}][date]" value="${dateStr}">
                                        </td>
                                        <td><input type="text" name="attendances[${day}][in_time]" class="form-control" value="${inDisplay}"></td>
                                        <td><input type="text" name="attendances[${day}][out_time]" class="form-control" value="${outDisplay}"></td>
                                        <td>
                                            <input type="text" hidden name="attendances[${day}][status]" class="form-control border-0" value="${status}">${statustag}
                                        </td>
                                    </tr>`;
                        }
                        $('#attendanceBody').html(html);
                    }
                });
            });

            // Helper: Random Time Generator (-5 to +5 minutes and random seconds)
            function generateRandomTime(dateStr, timeInput) {
                if (!timeInput || !timeInput.includes(':')) return "";

                const [hours, minutes] = timeInput.split(':').map(Number);

                const offset = Math.floor(Math.random() * 11) - 5;

                let d = new Date();
                d.setHours(hours);
                d.setMinutes(minutes + offset);
                d.setSeconds(Math.floor(Math.random() * 59) + 1); 

                const timePart = d.toTimeString().split(' ')[0]; 
                return `${dateStr} ${timePart}`;
            }

            // Helper: Date Formatter (MM/DD/YYYY)
            function formatDate(date) {
                let d = date.getDate().toString().padStart(2, '0');
                let m = (date.getMonth() + 1).toString().padStart(2, '0');
                let y = date.getFullYear();
                return `${m}/${d}/${y}`;
            }

            // Select All Checkbox Handler
            $('#selectAll').on('change', function () {
                $('.row-check').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
@endsection
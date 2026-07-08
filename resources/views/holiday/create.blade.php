<form action="{{ route('admin.holiday.store') }}" method="POST" id="HrSetUpForm">
    @csrf
    <div class="modal-body text-left p-0">
        <!-- BRANCH FIELD -->
        <div class="form-group mb-3">
            <label for="branch_id"
                class="form-label font-weight-bold text-success small text-uppercase mb-2">Branch</label>
            <div class="form-icon-user position-relative">
                <select class="form-control border-0 px-3 py-2 text-white" name="branch_id" id="branch_id"
                    required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    <option value="" disabled selected>Select Branch</option>
                    @foreach($branches as $id => $branchName)
                        <option value="{{ $id }}">{{ $branchName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- SHIFT FIELD -->
        <div class="form-group mb-3">
            <label for="shift_id"
                class="form-label font-weight-bold text-success small text-uppercase mb-2">Shift</label>
            <div class="form-icon-user position-relative">
                <select class="form-control border-0 px-3 py-2 text-white" name="shift_id" id="shift_id"
                    required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    <option value="" disabled selected>Select Shift</option>
                    @foreach($shifts as $id => $shiftName)
                        <option value="{{ $id }}">{{ $shiftName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- HOLIDAY TYPE FIELD -->
        <div class="form-group mb-3">
            <label for="holidayType"
                class="form-label font-weight-bold text-success small text-uppercase mb-2">Holiday Type</label>
            <div class="form-icon-user position-relative">
                <select class="form-control border-0 px-3 py-2 text-white" name="holidayType" id="holidayType"
                    required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    <option value="" disabled selected>Select Type</option>
                    <option value="Govt">Government Holiday</option>
                    <option value="National">National Holiday</option>
                    <option value="International">International Holiday</option>
                    <option value="Company">Company Holiday</option>
                    <option value="Festival">Festival Holiday</option>
                    <option value="Other">Other Holiday</option>
                </select>
            </div>
        </div>

        <!-- HOLIDAY NAME FIELD -->
        <div class="form-group mb-3">
            <label for="name" class="form-label font-weight-bold text-success small text-uppercase mb-2">Holiday
                Name</label>
            <div class="form-icon-user position-relative">
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control border-0 px-3 py-2 text-white" required style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;" placeholder="e.g. Eid-ul-Fitr">
            </div>
        </div>

        <!-- YEAR FIELD -->
        <div class="form-group mb-3">
            <label for="year"
                class="form-label font-weight-bold text-success small text-uppercase mb-2">Year</label>
            <div class="form-icon-user position-relative">
                <input type="number" name="year" id="year" value="{{ old('year', date('Y')) }}"
                    class="form-control border-0 px-3 py-2 text-white" required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
            </div>
        </div>

        <!-- MONTH FIELD -->
        <div class="form-group mb-3">
            <label for="month"
                class="form-label font-weight-bold text-success small text-uppercase mb-2">Month</label>
            <div class="form-icon-user position-relative">
                <select class="form-control border-0 px-3 py-2 text-white" name="month" id="month" required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    <option value="" disabled selected>Select Month</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- FROM DATE FIELD -->
        <div class="form-group mb-3">
            <label for="from" class="form-label font-weight-bold text-success small text-uppercase mb-2">From
                Date</label>
            <div class="form-icon-user position-relative">
                <input type="date" name="from" id="from" onchange="calculateTotalDays()"
                    class="form-control border-0 px-3 py-2 text-white" required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
            </div>
        </div>

        <!-- TO DATE FIELD -->
        <div class="form-group mb-3">
            <label for="to" class="form-label font-weight-bold text-success small text-uppercase mb-2">To
                Date</label>
            <div class="form-icon-user position-relative">
                <input type="date" name="to" id="to" onchange="calculateTotalDays()"
                    class="form-control border-0 px-3 py-2 text-white" required
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
            </div>
        </div>

        <!-- TOTAL DAY FIELD -->
        <div class="form-group mb-3">
            <label for="total_day"
                class="form-label font-weight-bold text-success small text-uppercase mb-2">Total Days</label>
            <div class="form-icon-user position-relative">
                <input type="number" name="total_day" id="total_day" value="0" readonly required
                    class="form-control border-0 px-3 py-2 text-white"
                    style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem; opacity: 0.8;">
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline" class="custom-control-input" value="active" checked>
                <label class="custom-control-label" for="customRadioInline1">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input" value="inactive">
                <label class="custom-control-label" for="customRadioInline2">Inactive</label>
            </div>
        </div>

    </div>

    <!-- DATE CALCULATION SCRIPT -->
    <script>
        function calculateTotalDays() {
            const fromDateStr = document.getElementById('from').value;
            const toDateStr = document.getElementById('to').value;
            const totalDayField = document.getElementById('total_day');

            if (fromDateStr && toDateStr) {
                const fromDate = new Date(fromDateStr);
                const toDate = new Date(toDateStr);

                if (toDate >= fromDate) {
                    const diffTime = Math.abs(toDate - fromDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    totalDayField.value = diffDays;
                } else {
                    totalDayField.value = 0;
                }
            }
        }
    </script>

    <!-- ACTION BUTTONS -->
    <div class="modal-footer d-flex justify-content-end mb-0 mt-4 pt-3 pb-0 px-0"
        style="border-top: 1px solid var(--input-border); gap: 8px;">
        <input type="button" value="{{ __('Cancel') }}"
            class="btn btn-sm btn-light border-0 text-dark px-3 font-weight-bold" data-bs-dismiss="modal"
            style="background-color: #cbd5e1; height: 34px; border-radius: 5px;">
        <input type="submit" value="{{ __('Create') }}" class="btn btn-sm btn-success px-3"
            style="background-color: #22c55e; border: none; color: #0f172a; font-weight: bold; height: 34px; border-radius: 5px;">
    </div>
</form>
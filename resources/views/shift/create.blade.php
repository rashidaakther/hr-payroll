<form action="{{ route('admin.shift.store') }}" method="POST" id="HrSetUpForm">
    @csrf
    <div class="modal-body text-left p-0">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="form-group mb-3">
                    <label for="branch_id" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Branch
                    </label>
                    <div class="form-icon-user position-relative">
                        <select class="form-control border-0 px-3 py-2 text-white" name="branch_id" id="branch_id"
                            required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                            <option value="" disabled selected>Select Branch</option>
                            @foreach($branches as $id => $branchName)
                                <option value="{{ $id }}">
                                    {{ $branchName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="name" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Shift Name
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="name" id="name"
                            value="{{  old('name') }}"
                            class="form-control border-0 px-3 py-2 text-white" required placeholder="Enter Shift Name"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                    @error('name')
                        <span class="invalid-name d-block mt-1" role="alert">
                            <strong class="text-danger small">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="start_at" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Shift start at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="start_at" id="start_at"
                            value="08:00"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="break_start_at"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Break start at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="break_start_at" id="break_start_at"
                            value="13:00"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="break_end_at"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Break end at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="break_end_at" id="break_end_at"
                            value="14:00"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="end_at" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Shift end at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="end_at" id="end_at"
                            value="17:00"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="total_hours" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Total hours (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="total_hours" id="total_hours"
                            value="8:00"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="general_ot_start_at"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        General ot start at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="general_ot_start_at" id="general_ot_start_at"
                            value="17:01"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="general_ot_end_at"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        General OT end at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="general_ot_end_at" id="general_ot_end_at"
                            value="19:00"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="extra_ot_start_at"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Extra OT start at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="extra_ot_start_at" id="extra_ot_start_at"
                            value="19:01"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="extra_ot_end_at"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Extra OT end at (HH:mm)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="extra_ot_end_at" id="extra_ot_end_at"
                            value="07:59"
                            class="form-control border-0 px-3 py-2 text-white" required
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-end mb-0 mt-4 pt-3 pb-0 px-0"
        style="border-top: 1px solid var(--input-border); gap: 8px;">
        <input type="button" value="{{ __('Cancel') }}"
            class="btn btn-sm btn-light border-0 text-dark px-3 font-weight-bold" data-bs-dismiss="modal"
            style="background-color: #cbd5e1; height: 34px; border-radius: 5px;">
        <input type="submit" value="{{ __('Create') }}" class="btn btn-sm btn-success px-3"
            style="background-color: #22c55e; border: none; color: #0f172a; font-weight: bold; height: 34px; border-radius: 5px;">
    </div>
</form>
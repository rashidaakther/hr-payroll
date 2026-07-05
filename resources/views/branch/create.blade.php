<form action="{{ route('admin.branch.store') }}" method="POST" id="HrSetUpForm">
    @csrf
    <div class="modal-body text-left p-0">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group mb-0">
                    <label for="name" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Name
                    </label>

                    <div class="form-icon-user position-relative">
                        <input type="text" name="name" id="name" value=""
                            class="form-control px-3 py-2 text-white" required="required"
                            placeholder="Enter Branch Name"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                    @error('name')
                        <span class="invalid-name d-block mt-1" role="alert">
                            <strong class="text-danger small">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-end mb-0 mt-4 pt-3 pb-0 px-0"
        style="border-top: 1px solid var(--input-border); gap: 8px;">
        <input type="button" value="{{ __('Cancel') }}"
            class="btn btn-sm btn-light border-0 text-dark px-3 font-weight-bold" data-bs-dismiss="modal"
            style="background-color: #cbd5e1; height: 34px; border-radius: 5px;">
        <input type="submit" value="{{ __('Create') }}"
            class="btn btn-sm btn-success px-3"
            style="background-color: #22c55e; border: none; color: #0f172a; font-weight: bold; height: 34px; border-radius: 5px;">
    </div>

</form>
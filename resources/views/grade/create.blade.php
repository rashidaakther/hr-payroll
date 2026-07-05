<form action="{{ route('admin.grade.store') }}" method="POST" id="HrSetUpForm">
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
                        Grade Name
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control border-0 px-3 py-2 text-white" required="required"
                            placeholder="Enter Grade"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                    @error('name')
                        <span class="invalid-name d-block mt-1" role="alert">
                            <strong class="text-danger small">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="basic_sly" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Basic Salary
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="basic_sly" id="basic_sly" value="{{ old('basic_sly') }}"
                            onkeyup="getTotal()" class="form-control border-0 px-3 py-2 text-white" required="required"
                            placeholder="Enter basic salary"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="house_rent" class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        H.Rent
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="house_rent" id="house_rent" value="{{ old('house_rent') }}"
                            onkeyup="getTotal()" class="form-control border-0 px-3 py-2 text-white" required="required"
                            placeholder="Enter house rent"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="medical_allowance"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        M.A. (Medical Allowance)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="medical_allowance" id="medical_allowance"
                            value="{{ old('medical_allowance') }}" onkeyup="getTotal()"
                            class="form-control border-0 px-3 py-2 text-white" required="required"
                            placeholder="Enter medical allowance"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="transportation_allowance"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        T.A. (Transportation Allowance)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="transportation_allowance" id="transportation_allowance"
                            value="{{ old('transportation_allowance') }}" onkeyup="getTotal()"
                            class="form-control border-0 px-3 py-2 text-white" required="required"
                            placeholder="Enter transportation allowance"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="food_allowance"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        F.A. (Food Allowance)
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="food_allowance" id="food_allowance" value="{{ old('food_allowance') }}"
                            onkeyup="getTotal()" class="form-control border-0 px-3 py-2 text-white" required="required"
                            placeholder="Enter food allowance"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="total_approx_sly"
                        class="form-label font-weight-bold text-success small text-uppercase mb-2">
                        Total
                    </label>
                    <div class="form-icon-user position-relative">
                        <input type="text" name="total_approx_sly" id="total_approx_sly"
                            value="{{ old('total_approx_sly') }}" readonly required="required"
                            class="form-control border-0 px-3 py-2 text-white"
                            style="background-color: var(--bg-input); border: 1px solid var(--input-border) !important; border-radius: 6px; font-size: 0.95rem; opacity: 0.8;">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function getTotal() {

            const inputs = ['basic_sly', 'house_rent', 'medical_allowance', 'transportation_allowance', 'food_allowance'];
            const totalField = document.getElementById('total_approx_sly');

            inputs.forEach(id => {
                const input = document.getElementById(id);

                input.addEventListener('input', function () {
                    let total = 0;

                    inputs.forEach(fieldId => {
                        const value = parseFloat(document.getElementById(fieldId).value);

                        if (!isNaN(value)) {
                            total += value;
                        }
                    });

                    totalField.value = total.toFixed(2);
                });
            });
        };
    </script>

    <div class="modal-footer d-flex justify-content-end mb-0 mt-4 pt-3 pb-0 px-0"
        style="border-top: 1px solid var(--input-border); gap: 8px;">
        <input type="button" value="{{ __('Cancel') }}"
            class="btn btn-sm btn-light border-0 text-dark px-3 font-weight-bold" data-bs-dismiss="modal"
            style="background-color: #cbd5e1; height: 34px; border-radius: 5px;">
        <input type="submit" value="{{ __('Create') }}" class="btn btn-sm btn-success px-3"
            style="background-color: #22c55e; border: none; color: #0f172a; font-weight: bold; height: 34px; border-radius: 5px;">
    </div>

</form>
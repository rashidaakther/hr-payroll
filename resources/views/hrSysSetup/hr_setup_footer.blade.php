<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"
            style="background-color: var(--bg-card); color: var(--text-main); border: 1px solid var(--input-border);">

            <div class="modal-header d-flex justify-content-between align-items-center"
                style="border-bottom: 1px solid var(--input-border); padding: 15px 20px;">
                <h5 class="modal-title font-weight-bold text-success mb-0" id="commonModalLabel">Operations</h5>

                <button type="button" class="btn-close-custom text-white border-0 bg-transparent"
                    data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"
                    style="font-size: 1.25rem; line-height: 1; cursor: pointer;">
                    <span aria-hidden="true" style="color: var(--text-main); pointer-events: none;">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="commonModalBody" style="padding: 20px;">
                <div class="text-center py-4"><i class="fa-solid fa-spinner fa-spin fa-2xl text-success"></i></div>
            </div>

        </div>
    </div>
</div>

@section('custom-js-page')
    <script>
        $(document).ready(function () {
            // Handle AJAX popup trigger
            $('[data-ajax-popup="true"]').on('click', function (e) {
                e.preventDefault();
                var url = $(this).data('url');
                var title = $(this).data('title');

                // Show the modal
                $('#commonModal').modal('show');
                $('#commonModalLabel').text(title);
                $('#commonModalBody').html('<div class="text-center py-4"><i class="fa-solid fa-spinner fa-spin fa-2xl text-success"></i></div>');

                // Load content via AJAX
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        $('#commonModalBody').html(response);
                    },
                    error: function (xhr) {
                        $('#commonModalBody').html('<div class="text-danger text-center py-4">An error occurred while loading the content.</div>');
                    }
                });
            });
        });

        // Universal Programmatic Close Fallback with Active Focus Reset
        $(document).on('click', '[data-bs-dismiss="modal"], [data-dismiss="modal"]', function () {
            var modalElement = $('#commonModal');

            // 1. Explicitly remove focus from the button to stop ARIA logs immediately
            if (document.activeElement) {
                document.activeElement.blur();
            }

            // 2. Hide modal based on Bootstrap availability
            if (typeof modalElement.modal === 'function') {
                modalElement.modal('hide');
            } else {
                modalElement.removeClass('show');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }

            // 3. Force browser focus to safe body context after close animation finish
            setTimeout(function () {
                $('body').focus();
            }, 150);
        });

        // Extra Guard: Reset focus whenever ANY modal finishes hiding
        $(document).on('hidden.bs.modal', '#commonModal', function () {
            if (document.activeElement) {
                document.activeElement.blur();
            }
            $('body').focus();
        });

        // Universal Global Dynamic Form Submission Handler Object Pipeline
        $(document).on('submit', '#HrSetUpForm', function (e) {
            e.preventDefault(); // Stop default browser hard-reloads rules matrix

            var currentForm = $(this);
            var submitBtn = currentForm.find('input[type="submit"], button[type="submit"]');
            var originalBtnText = submitBtn.is('input') ? submitBtn.val() : submitBtn.html();

            // Dynamic Form Data Capture Constraints Layer
            var targetEndpoint = currentForm.attr('action');
            var runtimeMethod = currentForm.attr('method') || 'POST';
            var payloadData = new FormData(this); // Automatic attachments multi-part file handle mapping support

            // 1. UI UX State Optimization: Loading Spinner Active Form Constraints
            if (submitBtn.is('input')) {
                submitBtn.val('Processing...').prop('disabled', true);
            } else {
                submitBtn.html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Saving...').prop('disabled', true);
            }

            // 2. Core Execution Network Pipeline Request Processing Matrix
            $.ajax({
                url: targetEndpoint,
                type: runtimeMethod,
                data: payloadData,
                processData: false, // Strict rules for multipart data payload configurations
                contentType: false, // Strict headers injection security configuration block
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Auto verification security pass token
                },
                success: function (response) {
                    if (response.success) {
                        // Modal safe close reset layout
                        $('#commonModal').modal('hide');

                        // Automatic soft notification standard console flush (SweetAlert or Direct Fallback Alert Engine)
                        alert(response.message || 'Operation processed successfully!');

                        // Refresh standard view datatable records matrix
                        window.location.reload();
                    }
                },
                error: function (xhr) {
                    // Processing validation constraints map fields tracking system
                    if (xhr.status === 422) {
                        var errorObject = xhr.responseJSON.errors;
                        // Standard alert logic wrapper
                        alert('Validation Mapping Error: ' + Object.values(errorObject)[0][0]);
                    } else {
                        alert('Execution framework runtime failed. Please cross check server log file.');
                    }
                },
                complete: function () {
                    // 3. UI State Reset Trigger Pipeline Parameters
                    if (submitBtn.is('input')) {
                        submitBtn.val(originalBtnText).prop('disabled', false);
                    } else {
                        submitBtn.html(originalBtnText).prop('disabled', false);
                    }
                }
            });
        });

        $(document).ready(function () {

            // 1. Define the default global state configuration matrix
            let datatableState = {
                search: '',
                per_page: 10,
                sort_by: 'id',
                sort_order: 'desc',
                page: 1
            };

            /**
             * Core AJAX function to pull data from backend API and inject into DOM
             */
            function fetchDatatableRecords(container) {
                let fetchUrl = container.data('fetch-url');
                if (!fetchUrl) return;

                // Visual feedback state management (Loading overlay)
                let tableWrapper = container.find('.responsive-table-overflow-wrapper');
                tableWrapper.css('opacity', '0.5');

                $.ajax({
                    url: fetchUrl,
                    type: 'GET',
                    data: datatableState,
                    dataType: 'json',
                    success: function (response) {
                        // Handle raw JSON string strings gracefully or direct objects
                        let data = (typeof response === 'string') ? JSON.parse(response) : response;

                        if (data.success) {
                            // Injecting clean server-side pre-rendered HTML chunks safely
                            container.find('tbody').html(data.html);
                            container.find('.table-entries-summary-counter-label').html(data.summary);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Datatable fetch execution failed:', error);
                    },
                    complete: function () {
                        // Restore full clear visibility once network stream completes
                        tableWrapper.css('opacity', '1');
                    }
                });
            }

            /**
             * A. INITIAL LOAD AUTOMATION ROUTINE
             * Triggers immediately on webpage ready event for all active containers
             */
            $('.data-table-card-container').each(function () {
                fetchDatatableRecords($(this));
            });

            /**
             * B. PAGINATION PER PAGE CONTROLLER EVENT
             * Listens for item selection drops (10, 50, 100, 200, all)
             */
            $(document).on('change', '.dark-themed-select-box', function () {
                let container = $(this).closest('.data-table-card-container');
                datatableState.per_page = $(this).val();
                datatableState.page = 1; // Always reset pagination slice pointer back to page 1
                fetchDatatableRecords(container);
            });

            /**
             * C. DEBOUNCED LIVE SEARCH INPUT MONITOR
             * Waits 300ms after you stop typing before hitting your database
             */
            let searchDebounceTimer;
            $(document).on('keyup', '.dark-themed-search-input', function () {
                let container = $(this).closest('.data-table-card-container');
                clearTimeout(searchDebounceTimer);

                datatableState.search = $(this).val();
                datatableState.page = 1; // Reset to page 1 for searching matching rules

                searchDebounceTimer = setTimeout(function () {
                    fetchDatatableRecords(container);
                }, 300);
            });

            /**
             * D. INTERACTIVE COLUMN SORT MECHANISM
             * Monitors layout headers targeted via explicit [data-sort] mappings
             */
            $(document).on('click', '.core-structured-dark-table th[data-sort]', function () {
                let container = $(this).closest('.data-table-card-container');
                let targetColumn = $(this).data('sort');

                // Toggle rules sequence validation check logic
                if (datatableState.sort_by === targetColumn) {
                    datatableState.sort_order = datatableState.sort_order === 'asc' ? 'desc' : 'asc';
                } else {
                    datatableState.sort_by = targetColumn;
                    datatableState.sort_order = 'asc';
                }

                // Reset all header sort icons to default state first
                container.find('.sort-indicator-caret-icon')
                    .attr('class', 'fa-solid fa-sort sort-indicator-caret-icon');

                // Target active header icon element and switch tracking caret vector
                let currentCaret = $(this).find('.sort-indicator-caret-icon');
                if (datatableState.sort_order === 'asc') {
                    currentCaret.attr('class', 'fa-solid fa-sort-up sort-indicator-caret-icon');
                } else {
                    currentCaret.attr('class', 'fa-solid fa-sort-down sort-indicator-caret-icon');
                }

                fetchDatatableRecords(container);
            });
        });
    </script>
@endsection
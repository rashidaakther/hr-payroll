        <div class="card border-0 rounded-lg p-2 mb-4 shadow-sm" style="background-color: var(--bg-card);">
            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                <a href="{{ url('admin/branch') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/branch') ? 'active-sub-nav' : '' }}">Branch</a>
                <a href="{{ url('admin/department') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/department') ? 'active-sub-nav' : '' }}">Department</a>
                <a href="{{ url('admin/designation') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/designation') ? 'active-sub-nav' : '' }}">Designation</a>
                <a href="{{ url('admin/shift') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/shift') ? 'active-sub-nav' : '' }}">shift</a>
                <a href="{{ url('admin/unit') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/unit') ? 'active-sub-nav' : '' }}">Unit</a>
                <a href="{{ url('admin/section_line') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/section_line') ? 'active-sub-nav' : '' }}">Section
                    / Line</a>
                <a href="{{ url('admin/grade') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/grade') ? 'active-sub-nav' : '' }}">Grade</a>
                <a href="{{ url('admin/religion') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/religion') ? 'active-sub-nav' : '' }}">Religion</a>
                <a href="{{ url('admin/holiday') }}"
                    class="btn px-3 font-weight-bold global-sub-nav-link border {{ request()->is('admin/holiday') ? 'active-sub-nav' : '' }}">Holiday</a>
            </div>
        </div>
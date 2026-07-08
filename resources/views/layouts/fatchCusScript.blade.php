@section('custom-js-page')
<script>
    $(document).ready(function () {
        // ১. ইনিশিয়াল ভেরিয়েবল সেটআপ
        const $container = $('.data-table-card-container');
        const fetchUrl = $container.data('fetch-url');

        let currentPage = 1;
        let perPage = $container.find('.dark-themed-select-box').val() || 10;
        let searchQuery = '';
        let sortBy = 'id';
        let sortOrder = 'desc';

        // ✨ মূল ফাংশন: AJAX দিয়ে ডাটা ফেচ করা
        function fetchEmployeeTableData() {
            // ডাটা লোড হওয়ার সময় টেবিল বডিতে একটা স্মুথ ফেড-ইন ইফেক্ট
            $container.find('tbody').css('opacity', '0.6');

            $.ajax({
                url: fetchUrl,
                type: 'GET',
                data: {
                    page: currentPage,
                    per_page: perPage,
                    search: searchQuery,
                    sort_by: sortBy,
                    sort_order: sortOrder
                },
                success: function (response) {
                    if (response.success) {
                        // টেবিল বডি এবং নিচে এন্ট্রি কাউন্টার সামারি আপডেট
                        $container.find('tbody').html(response.html).css('opacity', '1');
                        $container.find('.table-entries-summary-counter-label').text(response.summary);

                        // বুটস্ট্রাপ টুলটিপ রি-ইনিশিয়াজ করা (অ্যাকশন বাটনের জন্য)
                        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                            tooltipTriggerList.map(function (tooltipTriggerEl) {
                                return new bootstrap.Tooltip(tooltipTriggerEl);
                            });
                        }
                    }
                },
                error: function (xhr) {
                    console.error("Data fetching failed:", xhr);
                    $container.find('tbody').html('<tr><td colspan="7" class="text-center text-danger py-4">Failed to load data. Please try again.</td></tr>').css('opacity', '1');
                }
            });
        }

        // ২. ইভেন্ট লিসেনার: প্রতি পেজে কতটি এন্ট্রি দেখাবে (Dropdown Change)
        $container.on('change', '.dark-themed-select-box', function () {
            perPage = $(this).val();
            currentPage = 1; // ড্রপডাউন চেঞ্জ হলে প্রথম পেজ থেকে শুরু হবে
            fetchEmployeeTableData();
        });

        // ৩. ইভেন্ট লিসেনার: লাইভ সার্চ (Input typing with debounce)
        let searchTimer;
        $container.on('keyup input', '.dark-themed-search-input', function () {
            clearTimeout(searchTimer);
            searchQuery = $(this).val();
            currentPage = 1;

            // টাইপিং শেষ হওয়ার ৩০০ মিলি-সেকেন্ড পর কুয়েরি পাঠাবে (সার্ভার লোড কমানোর জন্য)
            searchTimer = setTimeout(function () {
                fetchEmployeeTableData();
            }, 300);
        });

        // ৪. ইভेंट লিসেনার: কলাম হেডার সর্টিং (Sorting Click)
        $container.on('click', 'th[data-sort]', function () {
            const clickedSort = $(this).data('sort');

            // একই কলামে আবার ক্লিক করলে অর্ডার টগল হবে (asc <-> desc)
            if (sortBy === clickedSort) {
                sortOrder = (sortOrder === 'desc') ? 'asc' : 'desc';
            } else {
                sortBy = clickedSort;
                sortOrder = 'asc'; // নতুন কলাম হলে ডিফল্ট asc
            }

            // সব কেয়ারেট আইকন রিসেট করে শুধুমাত্র অ্যাক্টিভ কলামের আইকন চেঞ্জ করা
            $container.find('th i.sort-indicator-caret-icon')
                .removeClass('fa-sort-up fa-sort-down')
                .addClass('fa-sort');

            const currentCaret = $(this).find('i.sort-indicator-caret-icon');
            if (sortOrder === 'asc') {
                currentCaret.removeClass('fa-sort').addClass('fa-sort-up');
            } else {
                currentCaret.removeClass('fa-sort').addClass('fa-sort-down');
            }

            fetchEmployeeTableData();
        });

        // ৫. পেজিনেশন ক্লিকের হ্যান্ডলার (যদি আপনার গ্লোবাল স্ক্রিপ্ট জেনারেট করে)
        $container.on('click', '.pagination a', function (e) {
            e.preventDefault();
            const pageUrl = $(this).attr('href');
            if (pageUrl) {
                // ইউআরএল থেকে পেজ নাম্বার এক্সট্রাক্ট করা
                const pageMatch = pageUrl.match(/page=(\d+)/);
                if (pageMatch) {
                    currentPage = pageMatch[1];
                    fetchEmployeeTableData();
                }
            }
        });

        // 🚀 পেজ লোড হওয়ার সাথে সাথে প্রথমবার ডাটা কল করা
        fetchEmployeeTableData();
    });
</script>
@endsection
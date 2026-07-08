<div class="system-platform-footer-baseline mt-auto">
    © 2026 Laravel
</div>

<!-- ফ্ল্যাশ মেসেজ কন্টেইনার (স্ক্রিনের নিচে ডান কোনায় ফিক্সড থাকবে) -->
<div class="position-fixed p-3" style="z-index: 9999; right:0; top: 85vh;">

    <!-- ১. Success মেসেজ -->
    @if(session('success'))
        <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true" id="flash-toast">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-5"></i> <!-- ফন্ট-অসাম আইকন -->
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- ২. Error বা Danger মেসেজ -->
    @if(session('error'))
        <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true" id="flash-toast">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2 fs-5"></i>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- ৩. Warning মেসেজ (ঐচ্ছিক) -->
    @if(session('warning'))
        <div class="toast align-items-center text-dark bg-warning border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true" id="flash-toast">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                    <div>{{ session('warning') }}</div>
                </div>
                <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>

<!-- ৪. অটো-হাইড করার জন্য জাভাস্ক্রিপ্ট (jQuery ছাড়া স্ট্যান্ডার্ড JS) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flashToast = document.getElementById('flash-toast');
        if (flashToast) {
            // ৫ সেকেন্ড (৫০০০ মিলিমেকেন্ড) পর মেসেজটি সুন্দরভাবে ফেড আউট হয়ে রিমুভ হবে
            setTimeout(function () {
                flashToast.style.transition = "opacity 0.5s ease-out";
                flashToast.style.opacity = "0";
                
                // অ্যানিমেশন শেষ হলে ডম (DOM) থেকে রিমুভ করে দেবে
                setTimeout(function() {
                    flashToast.remove();
                }, 500);
            }, 5000); 
        }
    });
</script>
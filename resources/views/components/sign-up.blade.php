<style>
    .zoom-scroll {
        opacity: 0;
        transform: scale(0.9);
        transition: all 0.6s ease-in-out;
    }

    .zoom-scroll.show {
        opacity: 1;
        transform: scale(1);
    }
</style>

<div class="container mx-auto py-12 mb-3">
    <!-- Section Header -->
    <div class="flex flex-col items-center justify-center space-y-2 mb-12 zoom-scroll">
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">How to use?</p>
        <p class="font-bold text-3xl lg:text-3xl text-center">
            3 simple steps to use the site
        </p>
    </div>

    <!-- Steps -->
    <div class="flex flex-col lg:flex-row justify-center lg:justify-between gap-8 zoom-scroll">

        <!-- Step 1 -->
        <div class="flex flex-col items-center text-center flex-1 space-y-4">
            <img src="/storage/images/login.png" width="265" height="264" loading="lazy" style="color:transparent">
            <div class="space-y-1">
                <p class="font-bold text-lg">Register an Account</p>
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm">
                    Provide your basic information and<br> create a strong password.
                </p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="flex flex-col items-center text-center flex-1 space-y-4">
            <img src="/storage/images/edit.png" width="265" height="264" loading="lazy" style="color:transparent">
            <div class="space-y-1">
                <p class="font-bold text-lg">Edit Profile</p>
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm">
                    Provide all your information to<br> create your record.
                </p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="flex flex-col items-center text-center flex-1 space-y-4">
            <img src="/storage/images/browse.png" width="265" height="264" loading="lazy" style="color:transparent">
            <div class="space-y-1">
                <p class="font-bold text-lg">Browse</p>
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm">
                    Once registered, you can now<br> browse different services.
                </p>
            </div>
        </div>

    </div>
</div>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    });

    document.querySelectorAll('.zoom-scroll').forEach((el) => {
        observer.observe(el);
    });
</script>
<style>
    .animate-left,
    .animate-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.8s ease-out;
    }

    .animate-left {
        transform: translateX(-50px);
    }

    .animate-left.visible,
    .animate-right.visible {
        opacity: 1;
        transform: translateX(0);
    }
</style>

<div class="flex flex-col items-center justify-center w-full bg-neutral-50 mb-3">
    <!-- Section Header -->
    <div class="flex flex-col items-center justify-center space-y-2 py-8">
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Our Key Features</p>
        <p class="font-bold text-2xl lg:text-3xl text-center">Discover Our Key Features</p>
    </div>

    <!-- First Feature Block -->
    <main
        class="flex flex-col-reverse lg:flex-row w-full max-w-4xl items-center lg:items-stretch mx-auto gap-x-8 text-center mb-12">
        <div class="flex-1 flex flex-col justify-center text-[#1b1b18] dark:text-[#EDEDEC] animate-left px-4 lg:px-0">
            <h1 class="mb-2 font-bold text-base">Citizen-Centric Platform</h1>
            <h3 class="mb-2 font-semibold text-sm text-gray-700">Designed Around the Needs of Every Citizen</h3>
            <p class="mt-2 text-[#706f6c] dark:text-[#A1A09A] text-sm sm:text-base">
                Prioritize the needs and convenience of the public.<br>
                It simplifies access to services, ensures transparency, and
                enables easy communication between citizens and staff.
            </p>
        </div>

        <div class="flex-1 flex items-center justify-center animate-right px-4 lg:px-0">
            <img src="/storage/images/login.png" width="300" height="300" style="color:transparent"
                fetchpriority="high">
        </div>
    </main>

    <!-- Second Feature Block -->
    <main class="flex flex-col lg:flex-row w-full max-w-4xl items-center lg:items-stretch mx-auto gap-x-8 text-center">
        <div class="flex-1 flex items-center justify-center animate-left px-4 lg:px-0">
            <img src="/storage/images/edit.png" width="300" height="300" style="color:transparent" fetchpriority="high">
        </div>

        <div class="flex-1 flex flex-col justify-center text-[#1b1b18] dark:text-[#EDEDEC] animate-right px-4 lg:px-0">
            <h1 class="mb-2 font-bold text-base">Streamlined Barangay Transactions</h1>
            <h3 class="mb-2 font-semibold text-sm text-gray-700">Efficient, Transparent, and Citizen-Friendly Services
            </h3>
            <p class="mt-2 text-[#706f6c] dark:text-[#A1A09A] text-sm sm:text-base">
                Simplified the access to local services, making processes faster and more transparent.
                It reduces paperwork, minimizes waiting times, and allows citizens to complete requests with
                ease.
            </p>
        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const elements = document.querySelectorAll(".animate-left, .animate-right");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        }, { threshold: 0.2 });

        elements.forEach(el => observer.observe(el));
    });
</script>
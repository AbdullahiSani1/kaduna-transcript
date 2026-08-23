{{-- Global loading overlay: shows a spinner on link navigation and form submits --}}
<div id="global-loader" class="fixed inset-0 z-[60] bg-white/80 backdrop-blur-sm flex items-center justify-center hidden">
    <svg class="animate-spin h-10 w-10 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
    </svg>
</div>

<script>
    (function () {
        var loader = document.getElementById('global-loader');
        if (!loader) return;

        function showLoader() {
            loader.classList.remove('hidden');
        }

        // Show spinner when clicking a same-page link that navigates away
        document.addEventListener('click', function (e) {
            var link = e.target.closest('a');
            if (!link) return;
            if (link.target === '_blank') return;
            if (link.hasAttribute('download')) return;
            var href = link.getAttribute('href');
            if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
            showLoader();
        });

        // Show spinner on any form submit (login, register, requests, etc.)
        document.addEventListener('submit', function () {
            showLoader();
        });

        // Hide spinner if the page is restored from back/forward cache
        window.addEventListener('pageshow', function () {
            loader.classList.add('hidden');
        });
    })();
</script>
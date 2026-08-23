@if (session('success') || session('error'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-4 left-4 right-4 md:left-auto md:right-4 md:max-w-sm z-50 md:w-full"
        style="margin-top: env(safe-area-inset-top);"
    >
        <div class="rounded-xl shadow-lg px-4 py-3 flex items-start gap-3 {{ session('success') ? 'bg-green-600' : 'bg-red-600' }} text-white">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if (session('success'))
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                @endif
            </svg>
            <p class="text-sm font-medium">{{ session('success') ?? session('error') }}</p>
            <button @click="show = false" class="ml-auto shrink-0 tap-scale">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif
@php
    $isStudent = auth()->user()->role === 'student';
@endphp

{{-- Floating Action Button: New Request (students only) --}}
@if ($isStudent && !request()->routeIs('student.transcript.create'))
    <a href="{{ route('student.transcript.create') }}"
        class="md:hidden fixed right-4 z-40 tap-scale bg-primary-600 hover:bg-primary-700 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center"
        style="bottom: calc(5rem + env(safe-area-inset-bottom));"
        aria-label="New Transcript Request">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
    </a>
@endif

{{-- Bottom Navigation Bar --}}
<nav class="md:hidden fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-gray-200"
    style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="grid grid-cols-4 h-16">
        @if ($isStudent)
            <a href="{{ route('student.dashboard') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('student.dashboard') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>
            <a href="{{ route('student.transcript.create') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('student.transcript.create') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-xs font-medium">New</span>
            </a>
            <a href="{{ route('student.transcript.requests') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('student.transcript.requests') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
                <span class="text-xs font-medium">Requests</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('profile.edit') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-medium">Profile</span>
            </a>
        @else
            <a href="{{ route('admin.dashboard') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('admin.dashboard') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>
            <a href="{{ route('admin.transcript-requests.index') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('admin.transcript-requests.*') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-xs font-medium">Requests</span>
            </a>
            <a href="{{ route('admin.courses.index') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('admin.courses.*') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="text-xs font-medium">Courses</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="tap-scale flex flex-col items-center justify-center gap-1 {{ request()->routeIs('profile.edit') ? 'text-primary-600' : 'text-gray-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-medium">Profile</span>
            </a>
        @endif
    </div>
</nav>